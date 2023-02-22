<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Strain;
use App\Models\Harvest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\EmployeesFlowerExport;
use App\Exports\EmployeesLarfExport;
use Excel;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $harvest=NULL;
        $strains=NULL;
        $employees=NULL;
        $harvests=Harvest::orderBy('name', 'ASC')->get();
        if (!is_null(request('harvest_id'))) {
            if (!is_null(request('start')) && !is_null(request('end'))) {
                $between=[date('Y-m-d H:i:s', strtotime(request('start').' 00:00:00')), date('Y-m-d H:i:s', strtotime(request('end').' 23:59:59'))];
                $harvest=Harvest::with(['stages' => function($query) use ($between) {
                    $query->whereBetween('created_at', $between);
                }])->where('slug', request('harvest_id'))->first();
                if (!is_null($harvest)) {
                    $strains=Strain::with(['stages' => function($query) use ($harvest, $between) {
                        $query->where('harvest_id', $harvest->id)->whereBetween('created_at', $between);
                    }])->get();

                    $employees=User::has('stages')->with(['stages' => function($query) use ($harvest, $between) {
                        $query->where('harvest_id', $harvest->id)->whereBetween('created_at', $between);
                    }])->get();
                }
            } else {
                if (!is_null(request('start')) && is_null(request('end'))) {
                    $harvest=Harvest::with(['stages' => function($query) use ($harvest) {
                        $query->where('created_at', '>=', date('Y-m-d', strtotime(request('start'))));
                    }])->where('slug', request('harvest_id'))->first();
                    if (!is_null($harvest)) {
                        $strains=Strain::with(['stages' => function($query) use ($harvest) {
                            $query->where([['created_at', '>=', date('Y-m-d', strtotime(request('start')))], ['harvest_id', $harvest->id]]);
                        }])->get();

                        $employees=User::has('stages')->with(['stages' => function($query) use ($harvest) {
                            $query->where([['created_at', '>=', date('Y-m-d', strtotime(request('start')))], ['harvest_id', $harvest->id]]);
                        }])->get();
                    }
                } elseif (is_null(request('start')) && !is_null(request('end'))) {
                    $harvest=Harvest::with(['stages' => function($query) use ($harvest) {
                        $query->where('created_at', '<=', date('Y-m-d H:i:s', strtotime(request('end').' 23:59:59')));
                    }])->where('slug', request('harvest_id'))->first();

                    if (!is_null($harvest)) {
                        $strains=Strain::with(['stages' => function($query) use ($harvest) {
                            $query->where([['created_at', '<=', date('Y-m-d H:i:s', strtotime(request('end').' 23:59:59'))], ['harvest_id', $harvest->id]]);
                        }])->get();

                        $employees=User::has('stages')->with(['stages' => function($query) use ($harvest) {
                            $query->where([['created_at', '<=', date('Y-m-d H:i:s', strtotime(request('end').' 23:59:59'))], ['harvest_id', $harvest->id]]);
                        }])->get();
                    }
                } else {
                    $harvest=Harvest::with(['stages'])->where('slug', request('harvest_id'))->first();
                    if (!is_null($harvest)) {
                        $strains=Strain::with(['stages' => function($query) use ($harvest) {
                            $query->where('harvest_id', $harvest->id);
                        }])->get();

                        $employees=User::has('stages')->with(['stages' => function($query) use ($harvest) {
                            $query->where('harvest_id', $harvest->id);
                        }])->get();
                    }
                }
            }
        }
        return view('admin.statistics.index', compact('harvests', 'harvest', 'strains', 'employees'));
    }

    public function pdfHarvest($slug) {
        $harvest=Harvest::with(['stages.plants', 'stages.container', 'stages.strain'])->where('slug', $slug)->firstOrFail();
        $stages=$harvest['stages']->where('type', 'Curado');
        $pdf=PDF::setOptions(['isPhpEnabled' => true]);
        $pdf=PDF::loadView('admin.pdfs.harvest', compact('harvest', 'stages'));

        return $pdf->stream('cosecha.pdf');
    }

    public function excelEmployeesFlower(Request $request, $harvest, $strain) {
        $dates=[];
        $harvest=Harvest::where('slug', $harvest)->firstOrFail();
        $strain=Strain::with(['stages' => function($query) use ($harvest) {
            $query->where([['type', '2'], ['harvest_id', $harvest->id]]);
        }])->where('slug', $strain)->firstOrFail();

        if (is_null(request('start')) || is_null(request('end')) || (!is_null(request('start')) && !request('end')) && request('end')<request('start')) {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Error', 'msg' => 'Selecciona un rango de fechas valido.'])->withInput();
        }

        $between=[date('Y-m-d H:i:s', strtotime(request('start').' 00:00:00')), date('Y-m-d H:i:s', strtotime(request('end').' 23:59:59'))];
        $employees=User::has('stages')->with(['stages' => function($query) use ($strain, $harvest, $between) {
            $query->where([['type', '2'], ['strain_id', $strain->id], ['harvest_id', $harvest->id]])->whereBetween('created_at', $between);
        }])->get();

        if (date('d-m-Y', strtotime(request('start')))==date('d-m-Y', strtotime(request('end')))) {
            $dates[0]=date('d-m-Y', strtotime(request('start')));
        } else {
            $date=date('d-m-Y', strtotime(request('start')));
            $dates[0]=$date;
            $days=calcDays(request('start'), request('end'));
            for ($i=1; $i<=$days; $i++) {
                $date=date('d-m-Y', strtotime($date.'+ 1 days'));
                $dates[$i]=$date;
            }
        }

        return Excel::download(new EmployeesFlowerExport($strain, $dates, $employees), 'trabajadores_flor.xlsx');
    }

    public function excelEmployeesLarf(Request $request, $harvest, $strain) {
        $dates=[];
        $harvest=Harvest::where('slug', $harvest)->firstOrFail();
        $strain=Strain::with(['stages' => function($query) use ($harvest) {
            $query->where([['type', '2'], ['harvest_id', $harvest->id]]);
        }])->where('slug', $strain)->firstOrFail();

        if (is_null(request('start')) || is_null(request('end')) || (!is_null(request('start')) && !request('end')) && request('end')<request('start')) {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Error', 'msg' => 'Selecciona un rango de fechas valido.'])->withInput();
        }

        $between=[date('Y-m-d H:i:s', strtotime(request('start').' 00:00:00')), date('Y-m-d H:i:s', strtotime(request('end').' 23:59:59'))];
        $employees=User::has('stages')->with(['stages' => function($query) use ($strain, $harvest, $between) {
            $query->where([['type', '2'], ['strain_id', $strain->id], ['harvest_id', $harvest->id]])->whereBetween('created_at', $between);
        }])->get();

        if (date('d-m-Y', strtotime(request('start')))==date('d-m-Y', strtotime(request('end')))) {
            $dates[0]=date('d-m-Y', strtotime(request('start')));
        } else {
            $date=date('d-m-Y', strtotime(request('start')));
            $dates[0]=$date;
            $days=calcDays(request('start'), request('end'));
            for ($i=1; $i<=$days; $i++) {
                $date=date('d-m-Y', strtotime($date.'+ 1 days'));
                $dates[$i]=$date;
            }
        }

        return Excel::download(new EmployeesLarfExport($strain, $dates, $employees), 'trabajadores_larf.xlsx');
    }
}

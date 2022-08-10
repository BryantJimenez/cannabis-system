<?php

namespace App\Http\Controllers;

use App\Models\Strain;
use App\Models\Harvest;
use App\Http\Requests\Harvest\HarvestStoreRequest;
use App\Http\Requests\Harvest\HarvestUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HarvestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $harvests=Harvest::orderBy('id', 'DESC')->get();
        return view('admin.harvests.index', compact('harvests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.harvests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HarvestStoreRequest $request) {
        $harvest=Harvest::create(['name' => request('name')]);
        if ($harvest) {
            return redirect()->route('harvests.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La cosecha ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('harvests.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Harvest $harvest) {
        $strains=Strain::with(['stages' => function($query) use ($harvest) {
            $query->where('harvest_id', $harvest->id);
        }])->get();
        return view('admin.harvests.show', compact('harvest', 'strains'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Harvest $harvest) {
        return view('admin.harvests.edit', compact('harvest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HarvestUpdateRequest $request, Harvest $harvest) {
        $harvest->fill(['name' => request('name')])->save();
        if ($harvest) {
            return redirect()->route('harvests.edit', ['harvest' => $harvest->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La cosecha ha sido editada exitosamente.']);
        } else {
            return redirect()->route('harvests.edit', ['harvest' => $harvest->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Harvest $harvest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Harvest $harvest) {
        $harvest->delete();
        if ($harvest) {
            return redirect()->route('harvests.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La cosecha ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('harvests.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, Harvest $harvest) {
        $harvest->fill(['state' => "0"])->save();
        if ($harvest) {
            return redirect()->route('harvests.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La cosecha ha sido desactivada exitosamente.']);
        } else {
            return redirect()->route('harvests.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, Harvest $harvest) {
        $harvest->fill(['state' => "1"])->save();
        if ($harvest) {
            return redirect()->route('harvests.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La cosecha ha sido activada exitosamente.']);
        } else {
            return redirect()->route('harvests.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}

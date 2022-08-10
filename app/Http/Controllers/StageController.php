<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Stage;
use App\Models\Plant;
use App\Models\Strain;
use App\Models\Setting;
use App\Models\Harvest;
use App\Models\Container;
use App\Models\PlantStage;
use App\Http\Requests\Stage\StageCuredStoreRequest;
use App\Http\Requests\Stage\StageTrimmedStoreRequest;
use Illuminate\Http\Request;
use Auth;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function curedIndex() {
    	if (Auth::user()->hasRole(['Trabajador'])) {
    		$stages=Stage::where([['type', '1'], ['state', '0'], ['user_id', Auth::id()]])->orderBy('id', 'DESC')->get();
    	} else {
    		$stages=Stage::where([['type', '1'], ['state', '0']])->orderBy('id', 'DESC')->get();
    	}
        return view('admin.stages.cured.index', compact('stages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function curedCreate() {
        $setting=Setting::where('id', '1')->firstOrFail();
        $rooms=Room::where('state', '1')->orderBy('name', 'ASC')->get();
        $strains=Strain::where('state', '1')->orderBy('name', 'ASC')->get();
        $harvests=Harvest::where('state', '1')->orderBy('name', 'ASC')->get();
        $containers=Container::where([['use', '<', $setting->qty_plants], ['state', '1']])->orderByRaw('LENGTH(name)', 'ASC')->orderBy('name', 'ASC')->get();
        return view('admin.stages.cured.create', compact('setting', 'rooms', 'strains', 'harvests', 'containers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function curedStore(StageCuredStoreRequest $request) {
        $room=Room::where('slug', request('room_id'))->firstOrFail();
        $strain=Strain::where('slug', request('strain_id'))->firstOrFail();
        $harvest=Harvest::where('slug', request('harvest_id'))->firstOrFail();
        $container=Container::where('slug', request('container_id'))->firstOrFail();

        $stage=Stage::where([['type', '1'], ['state', '0'], ['container_id', $container->id]])->first();
        if (!is_null($stage)) {
        	$stage->fill(['flower' => request('flower'), 'waste' => request('waste'), 'note' => request('note'), 'strain_id' => $strain->id, 'room_id' => $room->id, 'harvest_id' => $harvest->id, 'container_id' => $container->id, 'user_id' => Auth::id()])->save();
        	if ($stage) {
        		PlantStage::where('stage_id', $stage->id)->whereIn('plant_id', $stage['plants']->pluck('id'))->delete();
        	}
        } else {
        	$stage=Stage::create(['type' => '1', 'flower' => request('flower'), 'larf' => NULL, 'trim' => NULL, 'waste' => request('waste'), 'note' => request('note'), 'state' => '0', 'strain_id' => $strain->id, 'room_id' => $room->id, 'harvest_id' => $harvest->id, 'container_id' => $container->id, 'user_id' => Auth::id()]);
        }
        
        if ($stage) {
            $i=0;
            if (!is_null(request('plants')) && !empty(request('plants'))) {
                foreach (request('plants') as $value) {
                    if (!is_null($value) && !empty($value)) {
                        $plant=Plant::where('code', $value)->first();
                        if (!is_null($plant)) {
                            PlantStage::create(['plant_id' => $plant->id, 'stage_id' => $stage->id]);
                        } else {
                            $plant=Plant::create(['code' => $value]);
                            PlantStage::create(['plant_id' => $plant->id, 'stage_id' => $stage->id]);
                        }
                        $i++;
                    }
                }
            }
            $container->fill(['use' => $i])->save();
            $stage->fill(['plants_count' => $i])->save();
            
            return redirect()->route('stages.cured.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El curado ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('stages.cured.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function curedShow(Stage $stage) {
    	if (Auth::user()->hasRole(['Trabajador']) && $stage->user_id!=Auth::id()) {
    		return redirect()->route('stages.cured.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Acceso Denegado', 'msg' => 'No tienes permiso de ver esta página.']);
    	}
        return view('admin.stages.cured.show', compact('stage'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trimmedIndex() {
        if (Auth::user()->hasRole(['Trabajador'])) {
    		$stages=Stage::where([['type', '2'], ['state', '0'], ['user_id', Auth::id()]])->orderBy('id', 'DESC')->get();
    	} else {
    		$stages=Stage::where([['type', '2'], ['state', '0']])->orderBy('id', 'DESC')->get();
    	}
        return view('admin.stages.trimmed.index', compact('stages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trimmedCreate() {
        $setting=Setting::where('id', '1')->firstOrFail();
        $rooms=Room::where('state', '1')->orderBy('name', 'ASC')->get();
        $strains=Strain::where('state', '1')->orderBy('name', 'ASC')->get();
        $harvests=Harvest::where('state', '1')->orderBy('name', 'ASC')->get();
        $containers=Container::where([['use', '>', 0], ['state', '1']])->orderBy('name', 'ASC')->get();
        return view('admin.stages.trimmed.create', compact('setting', 'rooms', 'strains', 'harvests', 'containers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function trimmedStore(StageTrimmedStoreRequest $request) {
        $room=Room::where('slug', request('room_id'))->firstOrFail();
        $strain=Strain::where('slug', request('strain_id'))->firstOrFail();
        $harvest=Harvest::where('slug', request('harvest_id'))->firstOrFail();
        $container=Container::where('slug', request('container_id'))->firstOrFail();
        $stage=Stage::create(['type' => '2', 'plants_count' => $container->use, 'flower' => request('flower'), 'larf' => request('larf'), 'trim' => request('trim'), 'waste' => request('waste'), 'note' => request('note'), 'state' => '0', 'strain_id' => $strain->id, 'room_id' => $room->id, 'harvest_id' => $harvest->id, 'container_id' => $container->id, 'user_id' => Auth::id()]);
        if ($stage) {
            $cured=Stage::with(['plants'])->where([['type', '1'], ['state', '0'], ['room_id', $room->id], ['strain_id', $strain->id], ['harvest_id', $harvest->id], ['container_id', $container->id]])->first();
            if (!is_null($cured)) {
                $cured->fill(['state' => '1'])->save();
                foreach ($cured['plants'] as $plant) {
                    PlantStage::create(['plant_id' => $plant->id, 'stage_id' => $stage->id]);
                }
            }
            return redirect()->route('stages.trimmed.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El trimmiado ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('stages.trimmed.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trimmedShow(Stage $stage) {
    	if (Auth::user()->hasRole(['Trabajador']) && $stage->user_id!=Auth::id()) {
    		return redirect()->route('stages.trimmed.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Acceso Denegado', 'msg' => 'No tienes permiso de ver esta página.']);
    	}
        return view('admin.stages.trimmed.show', compact('stage'));
    }

    public function empty(Request $request, Stage $stage) {
        if ($stage->type=='Curado') {
            return redirect()->route('stages.trimmed.index')->with(['alert' => 'lobibox', 'type' => 'warning', 'title' => 'Edición fallida', 'msg' => 'Este recipiente se encuentra en la fase de curado, no lo puedes vaciar.']);
        }

        if ($stage->state=='1') {
            return redirect()->route('stages.trimmed.index')->with(['alert' => 'lobibox', 'type' => 'warning', 'title' => 'Edición fallida', 'msg' => 'Este recipiente ya ha sido vaciado.']);
        }

        if ($stage->state=='0') {
            $stage->fill(['state' => '1'])->save();
        }

        $container=$stage['container']->fill(['use' => "0"])->save();
        if ($container) {
            return redirect()->route('stages.trimmed.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El recipiente ha sido vaciado exitosamente.']);
        } else {
            return redirect()->route('stages.trimmed.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}

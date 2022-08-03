<?php

namespace App\Http\Controllers;

use App\Models\Strain;
use App\Http\Requests\Strain\StrainStoreRequest;
use App\Http\Requests\Strain\StrainUpdateRequest;
use Illuminate\Http\Request;

class StrainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $strains=Strain::orderBy('id', 'DESC')->get();
        return view('admin.strains.index', compact('strains'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.strains.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StrainStoreRequest $request) {
        $strain=Strain::create(['name' => request('name')]);
        if ($strain) {
            return redirect()->route('strains.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La cepa ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('strains.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Strain $strain) {
        return view('admin.strains.edit', compact('strain'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StrainUpdateRequest $request, Strain $strain) {
        $strain->fill(['name' => request('name')])->save();
        if ($strain) {
            return redirect()->route('strains.edit', ['strain' => $strain->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La cepa ha sido editada exitosamente.']);
        } else {
            return redirect()->route('strains.edit', ['strain' => $strain->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Strain $strain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Strain $strain) {
        $strain->delete();
        if ($strain) {
            return redirect()->route('strains.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La cepa ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('strains.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, Strain $strain) {
        $strain->fill(['state' => "0"])->save();
        if ($strain) {
            return redirect()->route('strains.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La cepa ha sido desactivada exitosamente.']);
        } else {
            return redirect()->route('strains.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, Strain $strain) {
        $strain->fill(['state' => "1"])->save();
        if ($strain) {
            return redirect()->route('strains.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La cepa ha sido activada exitosamente.']);
        } else {
            return redirect()->route('strains.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}

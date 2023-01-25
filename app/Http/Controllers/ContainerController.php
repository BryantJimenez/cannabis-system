<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Container;
use App\Http\Requests\Container\ContainerStoreRequest;
use App\Http\Requests\Container\ContainerUpdateRequest;
use Illuminate\Http\Request;

class ContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $setting=Setting::where('id', '1')->firstOrFail();
        $containers=Container::orderBy('id', 'DESC')->get();
        return view('admin.containers.index', compact('setting', 'containers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.containers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContainerStoreRequest $request) {
        $container=Container::create(['name' => request('name')]);
        if ($container) {
            return redirect()->route('containers.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El compartimento ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('containers.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Container $container) {
        return view('admin.containers.edit', compact('container'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContainerUpdateRequest $request, Container $contain) {
        $contain->fill(['name' => request('name')])->save();
        if ($contain) {
            return redirect()->route('containers.edit', ['container' => $contain->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El compartimento ha sido editado exitosamente.']);
        } else {
            return redirect()->route('containers.edit', ['container' => $contain->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Container $container
     * @return \Illuminate\Http\Response
     */
    public function destroy(Container $container) {
        if ($container->use>0) {
            return redirect()->route('containers.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'No puedes eliminar este contenedor si esta en uso.']);
        }

        $container->delete();
        if ($container) {
            return redirect()->route('containers.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El compartimento ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('containers.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, Container $container) {
        $container->fill(['state' => "0"])->save();
        if ($container) {
            return redirect()->route('containers.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El compartimento ha sido desactivado exitosamente.']);
        } else {
            return redirect()->route('containers.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, Container $container) {
        $container->fill(['state' => "1"])->save();
        if ($container) {
            return redirect()->route('containers.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El compartimento ha sido activado exitosamente.']);
        } else {
            return redirect()->route('containers.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}

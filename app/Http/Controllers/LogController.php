<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $logs=Log::orderBy('id', 'DESC')->get();
        return view('admin.logs.index', compact('logs'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Log $log
     * @return \Illuminate\Http\Response
     */
    public function destroy(Log $log) {
        $log->delete();
        if ($log) {
            return redirect()->route('logs.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El registro de actividad ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('logs.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}

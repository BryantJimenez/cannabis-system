<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;
use Auth;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function curedIndex() {
    	if (Auth::user()->hasRole(['Trabajador'])) {
    		$stages=Stage::where([['type', '1'], ['user_id', Auth::id()]])->orderBy('id', 'DESC')->get();
    	} else {
    		$stages=Stage::where('type', '1')->orderBy('id', 'DESC')->get();
    	}
        return view('admin.records.cured.index', compact('stages'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function curedShow(Stage $stage) {
    	if (Auth::user()->hasRole(['Trabajador']) && $stage->user_id!=Auth::id()) {
    		return redirect()->route('records.cured.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Acceso Denegado', 'msg' => 'No tienes permiso de ver esta página.']);
    	}
        return view('admin.records.cured.show', compact('stage'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trimmedIndex() {
        if (Auth::user()->hasRole(['Trabajador'])) {
    		$stages=Stage::where([['type', '2'], ['user_id', Auth::id()]])->orderBy('id', 'DESC')->get();
    	} else {
    		$stages=Stage::where('type', '2')->orderBy('id', 'DESC')->get();
    	}
        return view('admin.records.trimmed.index', compact('stages'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trimmedShow(Stage $stage) {
    	if (Auth::user()->hasRole(['Trabajador']) && $stage->user_id!=Auth::id()) {
    		return redirect()->route('records.trimmed.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Acceso Denegado', 'msg' => 'No tienes permiso de ver esta página.']);
    	}
        return view('admin.records.trimmed.show', compact('stage'));
    }
}

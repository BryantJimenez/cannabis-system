<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Requests\Setting\SettingUpdateRequest;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit() {
        $setting=Setting::where('id', '1')->firstOrFail();
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(SettingUpdateRequest $request) {
        $setting=Setting::where('id', '1')->firstOrFail();
        $setting->fill(['qty_plants' => request('qty_plants')])->save();
        if ($setting) {
            return redirect()->route('settings.edit')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'Los ajustes han sido editados exitosamente.']);
        } else {
            return redirect()->route('settings.edit')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}

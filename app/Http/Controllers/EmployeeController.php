<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Employee\EmployeeStoreRequest;
use App\Http\Requests\Employee\EmployeeUpdateRequest;
use Illuminate\Http\Request;
use App\Jobs\SendEmailRegister;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $employees=User::role(['Trabajador'])->with(['roles'])->orderBy('id', 'DESC')->get();
        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeStoreRequest $request) {
        $data=array('name' => request('name'), 'lastname' => request('lastname'), 'phone' => request('phone'), 'birthday' => request('birthday'), 'license' => request('license'), 'email' => request('email'), 'password' => Hash::make(request('password')));
        $employee=User::create($data);

        if ($employee) {
            $employee->assignRole('Trabajador');

            // Mover imagen a carpeta users y extraer nombre
            if ($request->hasFile('photo')) {
                $file=$request->file('photo');
                $photo=store_files($file, $employee->slug, '/admins/img/users/');
                $employee->fill(['photo' => $photo])->save();
            }

            try {
                SendEmailRegister::dispatch($employee->slug);
            } catch (Exception $e) {
                Log::error('Register Email Error: '.$e);
            }
            return redirect()->route('employees.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El trabajador ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('employees.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $employee) {
        return view('admin.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $employee) {
        $roles=Role::all()->pluck('name');
        return view('admin.employees.edit', compact('employee', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeUpdateRequest $request, User $employee) {
        $data=array('name' => request('name'), 'lastname' => request('lastname'), 'phone' => request('phone'), 'birthday' => request('birthday'), 'license' => request('license'), 'state' => request('state'));
        $employee->fill($data)->save();        

        if ($employee) {
            $employee->syncRoles([request('type')]);

            // Mover imagen a carpeta users y extraer nombre
            if ($request->hasFile('photo')) {
                $file=$request->file('photo');
                $photo=store_files($file, $employee->slug, '/admins/img/users/');
                $employee->fill(['photo' => $photo])->save();
            }

            return redirect()->route('employees.edit', ['employee' => $employee->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El trabajador ha sido editado exitosamente.']);
        } else {
            return redirect()->route('employees.edit', ['employee' => $employee->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $employee)
    {
        $employee->delete();
        if ($employee) {
            return redirect()->route('employees.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El trabajador ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('employees.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, User $employee) {
        $employee->fill(['state' => "0"])->save();
        if ($employee) {
            return redirect()->route('employees.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El trabajador ha sido desactivado exitosamente.']);
        } else {
            return redirect()->route('employees.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, User $employee) {
        $employee->fill(['state' => "1"])->save();
        if ($employee) {
            return redirect()->route('employees.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El trabajador ha sido activado exitosamente.']);
        } else {
            return redirect()->route('employees.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}

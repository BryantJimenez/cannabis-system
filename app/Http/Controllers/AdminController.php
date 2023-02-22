<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Room;
use App\Models\Plant;
use App\Models\Stage;
use App\Models\Strain;
use App\Models\Setting;
use App\Models\Harvest;
use App\Models\Container;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Hash;
use Auth;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $users=User::role(['Super Admin', 'Administrador', 'Supervisor'])->count();
        $employees=User::role(['Trabajador'])->count();
        $rooms=Room::count();
        $strains=Strain::count();
        $containers=Container::count();
        return view('admin.home', compact('users', 'employees', 'rooms', 'strains', 'containers'));
    }

    public function profile() {
        return view('admin.profile');
    }

    public function profileEdit() {
        return view('admin.edit');
    }

    public function profileUpdate(ProfileUpdateRequest $request) {
        $user=User::where('slug', Auth::user()->slug)->firstOrFail();
        $data=array('name' => request('name'), 'lastname' => request('lastname'), 'phone' => request('phone'));
        if (Auth::user()->hasRole(['Trabajador'])) {
        	$data['birthday']=request('birthday');
        	$data['license']=request('license');
        }

        if (!is_null(request('password'))) {
            $data['password']=Hash::make(request('password'));
        }

        $user->fill($data)->save();

        if ($user) {
            // Mover imagen a carpeta users y extraer nombre
            if ($request->hasFile('photo')) {
                $file=$request->file('photo');
                $photo=store_files($file, $user->slug, '/admins/img/users/');
                $user->fill(['photo' => $photo])->save();
                Auth::user()->photo=$photo;
            }
            Auth::user()->slug=$user->slug;
            Auth::user()->name=request('name');
            Auth::user()->lastname=request('lastname');
            Auth::user()->phone=request('phone');
            if (Auth::user()->hasRole(['Trabajador'])) {
            	Auth::user()->birthday=$user->birthday;
            	Auth::user()->license=request('license');
            }
            if (!is_null(request('password'))) {
                Auth::user()->password=Hash::make(request('password'));
            }
            return redirect()->route('profile.edit')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El perfil ha sido editado exitosamente.']);
        } else {
            return redirect()->route('profile.edit')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInput();
        }
    }

    public function emailVerifyAdmin(Request $request)
    {
        $count=User::where('email', request('email'))->count();
        if ($count>0) {
            return "false";
        } else {
            return "true";
        }
    }

    public function codeVerifyPlant(Request $request, $container=NULL)
    {
        $code=(is_array(request('plants')) && isset(request('plants')[0])) ? request('plants')[0] : request('plants');
        $container=Container::where('slug', $container)->first();
        if (!is_null($container)) {
            $stage=Stage::with(['plants'])->where([['type', '1'], ['state', '0'], ['container_id', $container->id]])->first();
            if (!is_null($stage)) {
                $count=Plant::where('code', $code)->count();
                $exist=$stage['plants']->where('code', $code)->count();
                if (($count>0 && $exist>0) || $count==0) {
                    return "true";
                } else {
                    return "false";
                }
            }
        }

        $count=Plant::where('code', $code)->count();
        if ($count>0) {
            return "false";
        } else {
            return "true";
        }
    }

    public function containerCured(Request $request)
    {
        $setting=Setting::where('id', '1')->first();
        $container=Container::where('slug', request('container'))->first();

        if (!is_null($setting) && !is_null($container)) {
            $cured=Stage::with(['plants'])->where([['type', '1'], ['state', '0'], ['container_id', $container->id]])->get();
            $trimmed=Stage::with(['plants'])->where([['type', '2'], ['state', '0'], ['container_id', $container->id]])->first();
            if ($cured->count()>0 && is_null($trimmed)) {
            	return response()->json(['state' => true, 'setting' => ['qty_plants' => $setting->qty_plants], 'count_plants' => $cured->pluck('plants')->collapse()->count()], 200);
            } elseif ($cured->count()==0 && is_null($trimmed)) {
                return response()->json(['state' => true, 'setting' => ['qty_plants' => $setting->qty_plants], 'count_plants' => 0], 200);
            }
        }

        return response()->json(['state' => false], 500);
    }

    public function containersCured(Request $request)
    {
        $setting=Setting::where('id', '1')->first();
        $room=Room::where('slug', request('room'))->first();
        $strain=Strain::where('slug', request('strain'))->first();
        $harvest=Harvest::where('slug', request('harvest'))->first();

        if (!is_null($setting) && !is_null($room) && !is_null($strain) && !is_null($harvest)) {
            $stages=Stage::where([['type', '1'], ['state', '0'], ['room_id', $room->id], ['strain_id', $strain->id], ['harvest_id', $harvest->id]])->get()->pluck('container_id');
            $data=Container::where('use', '>', 0)->whereIn('id', $stages)->orderByRaw('LENGTH(name)', 'ASC')->orderBy('name', 'ASC')->get();
            return response()->json(['state' => true, 'setting' => ['qty_plants' => $setting->qty_plants], 'data' => $data], 200);
        }

        return response()->json(['state' => false], 500);
    }
}

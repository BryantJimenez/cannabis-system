<?php

namespace App\Http\Requests\Stage;

use App\Models\Room;
use App\Models\Stage;
use App\Models\Strain;
use App\Models\Setting;
use App\Models\Harvest;
use App\Models\Container;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StageCuredStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $setting=Setting::where('id', '1')->firstOrFail();
        $rooms=Room::where('state', '1')->get()->pluck('slug');
        $strains=Strain::where('state', '1')->get()->pluck('slug');
        $harvests=Harvest::where('state', '1')->get()->pluck('slug');
        $containers=Container::where([['use', '<', $setting->qty_plants], ['state', '1']])->get()->pluck('slug');

        $unique='';
        $plants=[];
        $container=Container::where('slug', $this->container_id)->first();
        if (!is_null($container)) {
            $stage=Stage::with(['plants'])->where([['type', '1'], ['state', '0'], ['container_id', $container->id]])->first();
            if (!is_null($stage)) {
                $plants=$stage['plants']->pluck('id');
            }
        }
        
        if (count($plants)>0) {
            $unique=Rule::unique('plants', 'id')->where(function($query) use ($plants) {
                return $query->whereNotIn('id', $plants);
            });
        }

        return [
            'strain_id' => 'required|'.Rule::in($strains),
            'room_id' => 'required|'.Rule::in($rooms),
            'harvest_id' => 'required|'.Rule::in($harvests),
            'container_id' => 'required|'.Rule::in($containers),
            'plants' => 'required|array',
            'plants.*' => ['nullable', 'string', 'min:2', 'max:191', $unique],
            'plants.0' => ['required', 'string', 'min:2', 'max:191', $unique],
            'flower' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0|confirmed',
            'waste' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0|confirmed',
            'note' => 'nullable|string|min:1|max:1000'
        ];
    }
}

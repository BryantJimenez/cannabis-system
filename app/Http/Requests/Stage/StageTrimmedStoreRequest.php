<?php

namespace App\Http\Requests\Stage;

use App\Models\Room;
use App\Models\Stage;
use App\Models\Strain;
use App\Models\Harvest;
use App\Models\Container;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StageTrimmedStoreRequest extends FormRequest
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
        $rooms=Room::where('state', '1')->get()->pluck('slug');
        $strains=Strain::where('state', '1')->get()->pluck('slug');
        $harvests=Harvest::where('state', '1')->get()->pluck('slug');

        $containers=[];
        $room=Room::where('slug', $this->room_id)->first();
        $strain=Strain::where('slug', $this->strain_id)->first();
        $harvest=Harvest::where('slug', $this->harvest_id)->first();
        if (!is_null($room) && !is_null($strain) && !is_null($harvest)) {
            $stages=Stage::where([['type', '1'], ['state', '0'], ['room_id', $room->id], ['strain_id', $strain->id], ['harvest_id', $harvest->id]])->get()->pluck('container_id');
            $containers=Container::where('use', '>', 0)->whereIn('id', $stages)->pluck('slug');
        }
        return [
            'strain_id' => 'required|'.Rule::in($strains),
            'room_id' => 'required|'.Rule::in($rooms),
            'harvest_id' => 'required|'.Rule::in($harvests),
            'container_id' => 'required|'.Rule::in($containers),
            'flower' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0|confirmed',
            'larf' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0|confirmed',
            'trim' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0|confirmed',
            'waste' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0|confirmed',
            'note' => 'nullable|string|min:1|max:1000'
        ];
    }
}

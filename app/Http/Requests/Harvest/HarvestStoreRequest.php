<?php

namespace App\Http\Requests\Harvest;

use Illuminate\Foundation\Http\FormRequest;

class HarvestStoreRequest extends FormRequest
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
        return [
            'name' => 'required|string|min:4|regex:/^[A-Z][0-9]{1,2}.[0-9]{1,}$/'
        ];
    }
}

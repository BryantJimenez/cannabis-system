<?php

namespace App\Http\Requests\Employee;

use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeeUpdateRequest extends FormRequest
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
        $roles=Role::all()->pluck('name');
        return [
            'photo' => 'nullable|file|mimetypes:image/*',
            'name' => 'required|string|min:2|max:191',
            'lastname' => 'required|string|min:2|max:191',
            'phone' => 'required|string|min:5|max:15',
            'birthday' => 'required|date_format:d-m-Y',
            'license' => 'required|min:11|regex:/^[A-Z]{2}-[0-9]{4}-[0-9]{3,}$/',
            'type' => 'required|'.Rule::in($roles),
            'state' => 'required|'.Rule::in(['0', '1'])
        ];
    }
}

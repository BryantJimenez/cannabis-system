<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
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
      'photo' => 'nullable|file|mimetypes:image/*',
      'name' => 'required|string|min:2|max:191',
      'lastname' => 'required|string|min:2|max:191',
      'birthday' => 'required|date_format:d-m-Y',
      'license' => 'required|min:11|regex:/^[A-Z]{2}-[0-9]{4}-[0-9]{3,}$/',
      'email' => 'required|string|email|max:191|unique:users,email',
      'password' => 'required|string|min:8|confirmed'
    ];
  }
}

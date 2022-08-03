<?php

namespace App\Http\Requests\User;

use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
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
    $roles=Role::where('name', '!=', 'Trabajador')->get()->pluck('name');
    return [
      'photo' => 'nullable|file|mimetypes:image/*',
      'name' => 'required|string|min:2|max:191',
      'lastname' => 'required|string|min:2|max:191',
      'type' => 'required|'.Rule::in($roles),
      'email' => 'required|string|email|max:191|unique:users,email',
      'password' => 'required|string|min:8|confirmed'
    ];
  }
}
<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;

class ProfileUpdateRequest extends FormRequest
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
  	$employee=(Auth::user()->hasRole(['Trabajador'])) ? true : false;
    return [
      'photo' => 'nullable|file|mimetypes:image/*',
      'name' => 'required|string|min:2|max:191',
      'lastname' => 'required|string|min:2|max:191',
      'phone' => 'required|string|min:5|max:15',
      'birthday' => Rule::requiredIf($employee).'|date_format:d-m-Y',
      'license' => Rule::requiredIf($employee).'|min:11|regex:/^[A-Z]{2}-[0-9]{4}-[0-9]{3,}$/',
      'password' => 'nullable|string|min:8|confirmed'
    ];
  }
}

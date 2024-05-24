<?php

namespace App\Http\Requests\users;

use App\Models\BacklistedStakeholder;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class updateRequest extends FormRequest
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
   * @return array<string, mixed>
   */
  public function rules()
  {

    $rules['email'] = ['required', 'email', Rule::unique('users')->ignore($this->input('Userid'))];
    $rules['name'] = ['required'];
    $rules['mobile_no'] = ['required'];


    if (!$this->input('password') && !$this->input('password_confirmation')) {
      unset($rules['password']);
    }

    return $rules;
  }

  public function messages()
  {
  }

  public function withValidator($validator)
  {
  }
  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array
   */
  // public function messages()
  // {
  //     return (new User())->ruleMessages;
  // }
}

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

        $rules = (new User())->rules;
        $rules['email'] = ['required', 'email', Rule::unique('users')->ignore($this->input('Userid'))];
        $rules['cnic'] = ['required', Rule::unique('users')->ignore($this->input('Userid'))];

        if (! $this->input('password') && ! $this->input('password_confirmation')) {
            unset($rules['password']);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'mailing.country.gt' => 'Mailing Country name is Required.',
            'mailing.state.gt' => 'Mailing State name is Required.',
            'mailing.city.gt' => 'Mailing City name is Required.',
            'residential.country.gt' => 'Residential Country name is Required.',
            'residential.state.gt' => 'Residential State name is Required.',
            'residential.city.gt' => 'Residential City name is Required.',

        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $blacklisted = BacklistedStakeholder::where('cnic', $this->input('cnic'))->first();
            if ($blacklisted) {
                $validator->errors()->add('cnic', 'CNIC is BlackListed.');
            }
        });
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

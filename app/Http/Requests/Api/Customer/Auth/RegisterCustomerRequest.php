<?php

namespace Tasawk\Http\Requests\Api\Customer\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Tasawk\Rules\KSAPhoneRule;

class RegisterCustomerRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'full_name' => ['required', 'string', 'min:3', 'max:40'],
            'phone' => [
                'required',
                'unique:users',
                new KSAPhoneRule()
            ],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
            ],
            'password_confirmation' => ['required', 'same:password'],
            'device_token' => ['required']

        ];
    }
}

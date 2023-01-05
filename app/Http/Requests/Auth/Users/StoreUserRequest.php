<?php

namespace App\Http\Requests\Auth\Users;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        $email = $this->email;
        //$arr_rules['email']             = 'required|email|max:255|unique:users';
        $arr_rules['first_name']         = 'required';
		 $arr_rules['last_name']         = 'required';
		
        // $arr_rules['user_name']          = 'required|alpha_dash|unique:users,user_name';
        $arr_rules['email']             = ['required','email','max:255',
                                            Rule::unique("users")->where(function ($query) use ($email) {
                                                return $query->where("email", $email)->where("is_deleted", 0);
                                            })];
        $arr_rules['phone_number']      = 'required|min:10';
        $arr_rules['password']          = 'required|min:6|confirmed';
        return $arr_rules;
    }
    public function messages()
    {
        return [
                'email.required'             => 'Please enter Email Address',
                'first_name.required'        => 'Please enter First name',
				'last_name.required'         => 'Please enter Last name',
                // 'user_name.required'         => 'Please enter User name',
				'phone_number.required'      => 'Please enter Phone Number',
                'password.required'          => 'Please enter Password',
                'password.min'               => 'Password must be at least 6 characters',
                'password.confirmed'         => 'Password confirmation does not match',
                // 'user_name.unique'           => 'username already taken 😳',

                
        ];
    }
}

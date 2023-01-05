<?php

namespace App\Http\Requests\Admin\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
        //return false;
    }
    public function rules()
    {
        $arr_rules['email']           = 'required|unique:users,email,'.$this->id;//'required';
        $arr_rules['displayName']     = 'required';
        //$arr_rules['username']        = 'required|alpha_dash|unique:users,username,'.$this->id;//'required';
        $arr_rules['password']        = 'min:6|confirmed';
        //  $arr_rules['phoneNumber']     = 'required|min:10';
        return $arr_rules;
    }
    public function messages()
    {
        return [
                'email.required'             => 'Please enter Email Address',
                'displayName.required'       => 'Please enter name',
               // 'phoneNumber.required'       => 'Please enter Phone number',
                'username.required'          => 'Please enter Username',
        ];
    }
}

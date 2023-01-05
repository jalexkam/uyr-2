<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
        $arr_rules = [];
        if ($this->input('role_id') == 3 || $this->input('role_id') == 2) {
            $arr_rules['displayName']   = 'required';
            $arr_rules['email']         = 'required|email';
            $arr_rules['phoneNumber']   = 'required|min:10';
        }
        return $arr_rules;
    }
}

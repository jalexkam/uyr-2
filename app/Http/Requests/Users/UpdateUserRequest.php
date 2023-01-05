<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
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
		$email = $this->email;
        $arr_rules = [];
       // if ($this->input('role_id') == 3 || $this->input('role_id') == 2) {
            $arr_rules['first_name']  	= 'required';
			 $arr_rules['email']             = ['required','email','max:255',
                                            Rule::unique("users")->where(function ($query) use ($email) {
                                                return $query->where("email", $email)
												->where("is_deleted", 0)->where('id','!=',$this->id);
                                            })];
											
            //$arr_rules['email']   		= 'required|email';
			 
            $arr_rules['phone_number']  = 'required|min:10';
			$arr_rules['last_name']   	= 'required';
			//$arr_rules['user_name']   	= 'required';
       // }
        return $arr_rules;
    }
}

<?php
namespace App\Http\Requests\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StorePatientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules(Request $request)
    {   
       $arr_rules = [];
       $formData    = json_decode($request->input('formData'));
        if($formData->first_name =='')  $arr_rules['first_name']  = 'required';
        if($formData->last_name =='')   $arr_rules['last_name']   = 'required';
        if($formData->email =='')       $arr_rules['email'] = 'required';
        if($formData->phone_number =='')$arr_rules['phone_number']  = 'required|min:10';
       
        // if($formData->password =='' )   
        //  $arr_rules['password'] = 'required|min:6|confirmed';

        //  if($formData->password_confirmation =='' )   
        //  $arr_rules['password_confirmation'] = 'required|min:6|confirmed';

         //if(!empty($formData->password)  &&  !empty($formData->password_confirmation)  && $formData->password !=$formData->password_confirmation)   
         //$arr_rules['password'] = 'confirmed';

        if($formData->gender =='')      $arr_rules['gender']  = 'required';
       // if($formData->age =='')         $arr_rules['age']   = 'required';
       //dd($formData->password,$formData->password_confirmation );
        //$arr_rules['full_address']      = 'required';
        if($formData->address =='')     $arr_rules['address']  = 'required';
        //if($formData->address2 =='')    $arr_rules['address2'] = 'required';
       // if($formData->area =='')        $arr_rules['area']     = 'required';
        if($formData->city =='')        $arr_rules['city']     = 'required';
        if($formData->country =='')     $arr_rules['country']  = 'required';
        //if($formData->state =='')       $arr_rules['state']    = 'required';
       // if($formData->zip_code =='')     $arr_rules['zip_code']   = 'required';
        
      
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
                'gender'                     => 'Please Select gender',
              //  'age'                        => 'Please Enter your age',
                'full_address.required'      => 'Please enter Full Address',
                'address.required'           => 'Please enter Address',
               // 'address2.required'          => 'Please enter Address2',
                'area.required'              => 'Please enter Area',
                'city.required'              => 'Please enter City',
                'country.required'           => 'Please enter Country'
        ];
    }
}

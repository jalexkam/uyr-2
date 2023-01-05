<?php
namespace App\Http\Requests\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdatePatientRequest extends FormRequest
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

    public function rules(Request $request)
    {   
       $arr_rules = [];
       $formData    = json_decode($request->input('formData'));
      
       if($formData->first_name =='')  $arr_rules['first_name']  = 'required';
        if($formData->last_name =='')   $arr_rules['last_name']   = 'required';
       
        if($formData->phone_number =='')$arr_rules['phone_number']  = 'required|min:10';
        // if($formData->gender =='')      $arr_rules['gender']  = 'required';
        if($formData->date_of_birth =='')$arr_rules['date_of_birth']   = 'required';
       if($formData->address =='')     $arr_rules['address']  = 'required';
        if($formData->city =='')        $arr_rules['city']     = 'required';
        if($formData->country =='')     $arr_rules['country']  = 'required';
        //if($formData->state =='')       $arr_rules['state']    = 'required';
        //if($formData->zip_code =='')    $arr_rules['zip_code'] = 'required';
        if($formData->email =='')       $arr_rules['email']    = ['required','email','max:255',
                                            Rule::unique("users")->where(function ($query) use ($email) {
                                                return $query->where("email", $formData->email)
                                                ->where("is_deleted", 0)->where('id','!=',$this->id);
                                            })];
      
        return $arr_rules;
    }
     public function messages()
    {
        return [
                'email.required'             => 'Please enter Email Address',
                'first_name.required'        => 'Please enter First name',
                'last_name.required'         => 'Please enter Last name',
                //'user_name.required'         => 'Please enter User name',
                'phone_number.required'      => 'Please enter Phone Number',
                'gender'                     => 'Please Select gender',
                //'age'                        => 'Please Enter your age',
                'full_address.required'      => 'Please enter Full Address',
                'address.required'           => 'Please enter Address',
                'area.required'              => 'Please enter Area',
                'city.required'              => 'Please enter City',
                'country.required'           => 'Please enter Country'
        ];
    }
    
}

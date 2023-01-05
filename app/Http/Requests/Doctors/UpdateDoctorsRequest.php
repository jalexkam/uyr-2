<?php
namespace App\Http\Requests\Doctors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateDoctorsRequest extends FormRequest
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
       $email = $this->email;
       if($formData->first_name =='')  $arr_rules['first_name']  = 'required';
        if($formData->last_name =='')   $arr_rules['last_name']   = 'required';
        //if($formData->user_name =='')   $arr_rules['user_name'] = 'required|alpha_dash|unique:users,user_name';

        //if($formData->email =='')       $arr_rules['email'] = 'required';
        if($formData->phone_number =='')$arr_rules['phone_number']  = 'required|min:10';
       // if($formData->gender =='')      $arr_rules['gender']  = 'required';
        // if($formData->age =='')         $arr_rules['age']   = 'required';

        //$arr_rules['full_address']      = 'required';
        if($formData->address =='')     $arr_rules['address']  = 'required';
        //if($formData->address2 =='')    $arr_rules['address2'] = 'required';

       // if($formData->area =='')        $arr_rules['area']     = 'required';
        if($formData->city =='')        $arr_rules['city']     = 'required';
        if($formData->country =='')     $arr_rules['country']  = 'required';
        //if($formData->state =='')       $arr_rules['state']    = 'required';
       // if($formData->zip_code =='')    $arr_rules['zip_code'] = 'required';
        if($formData->email =='')       $arr_rules['email']    = ['required','email','max:255',
                                            Rule::unique("users")->where(function ($query) use ($email) {
                                                return $query->where("email", $formData->email)
												->where("is_deleted", 0)->where('id','!=',$this->id);
                                            })];
        if($formData->medical_license_number =='')  $arr_rules['medical_license_number'] = 'required';
        if($formData->date_of_registration =='')    $arr_rules['date_of_registration'] = 'required';
        if($formData->registration_no =='')         $arr_rules['registration_no']   = 'required';
        if($formData->experience =='')              $arr_rules['experience']  = 'required';
        //if($formData->willing_to_serve_as =='' && $formData->dr_type != 1) $arr_rules['willing_to_serve_as'] = 'required';

        return $arr_rules;
    }
     public function messages()
    {
        return [
                'email.required'             => 'Please enter Email Address',
                'first_name.required'        => 'Please enter First name',
                'last_name.required'         => 'Please enter Last name',
                'user_name.required'         => 'Please enter User name',
                'phone_number.required'      => 'Please enter Phone Number',
                'password.confirmed'         => 'Password confirmation does not match',
                'user_name.unique'           => 'username already taken 😳',
                'gender'                     => 'Please Select gender',
                'age'                        => 'Please Enter your age',
               
                'full_address.required'      => 'Please enter Full Address',
                'address.required'           => 'Please enter Address',
                'address2.required'          => 'Please enter Address2',
                'area.required'              => 'Please enter Area',
                'city.required'              => 'Please enter City',
                'country.required'           => 'Please enter Country',
                'latitude.required'          => 'Please enter latitude',

                // 'type.required'              => 'Please select type',
                'certificate_awarding_university.required'=> 'Please upload Certificate awarding University',
                'speciality_diploma.required'       => 'Please upload Copy of specialty diploma',
                'medical_license_number.required'   => 'Please Enter your medical license number',
                'current_clinic_hospital.required'  => 'Please Enter Current Clinic/hospital of work',
                'date_of_registration.required'     => 'Please enter Date of registration',
                'registration_no.required'          => 'Please enter Registration No',
                'experience.required'               => 'Please Enter Years of experience',
                'willing_to_serve_as.required'      => 'Please enter Willing to serve as',


        ];
    }
    
}

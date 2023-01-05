<?php
namespace App\Http\Requests\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreSuggestDoctorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules(Request $request)
    {   
        $arr_rules = [];
        $formData    = json_decode($request->input('formData'));
        if($formData->date_of_suggest =='')  $arr_rules['date_of_suggest']  = 'required';
        if($formData->to_time =='')  $arr_rules['to_time']   = 'required';
        if($formData->from_time =='')  $arr_rules['from_time'] = 'required';
        return $arr_rules;
    }
    public function messages()
    {
        return [
                'date_of_suggest.required' => 'Please Select Date',
                'to_time.required'         => 'Please Select To time',
				'from_time.required'       => 'Please Select From time'
        ];
    }
}

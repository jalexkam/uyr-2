<?php

namespace App\Http\Requests\Faq;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class StoreFaqRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        $arr_rules = [];
        $arr_rules['question']         = 'required';
        $arr_rules['answer']           = 'required';

        return $arr_rules;
    }
    public function messages()
    {
        return [
                'question.required'             => 'Please enter Question',
                'answer.required'               => 'Please enter Answer',


        ];
    }
}

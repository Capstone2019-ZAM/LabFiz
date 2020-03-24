<?php

namespace App\Http\Requests\Issue;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'id' => array('required','int'),
            'title' => array('required', 'regex:/^[\s\w!-@#$^_:,.]*$/', 'max:250'),
            'room' => array('required', 'string'),
            'assigned_to' => array('required', 'int'),
            'severity' => array('required', 'string'),
            'description' => array('required', 'regex:/^[\s\w!-@#$^_:,.]*$/', 'max:250'),
            'due_date' =>array('required' ,'date'),
            
        ];
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
                'status' => '422 (Unprocessable Entity)',
                'message' => $validator->errors(),
                'data' => ''
            ],
            422)
        );
    }
}

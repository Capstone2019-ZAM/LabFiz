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
            'title' => array('required', 'regex:/^[\s\w-]*$/'),
            'room' => array('required', 'numeric'),
            'assigned_to' => array('required', 'numeric'),
            'severity' => array('required', 'regex:/^[\s\w-]*$/'),
            'description' => array('required', 'regex:/^[\s\w!-@#$^_:,.]*$/', 'max:250'),
            'comments' => array('required', 'regex:/^[\s\w!-@#$^_:,.]*$/', 'max:250'),
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

<?php

namespace App\Http\Requests\Report;

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
            //'id' => array('required', 'int'),
            'title' => array('sometimes', 'regex:/^[\s\w-]*$/'),
            'lab' => array('required', 'string'),
            'template_id' => array('required', 'int'),
            'assigned_to' => array('required', 'int'),
            'due_date' => array('required', 'date'),
            'status' => array('sometimes', 'regex: /Submitted|Pending|Overdue|In Review|Complete/'),
             'sections.*' => array('sometimes','nullable','array'),
            // 'sections.*.template_id' => array('required', 'int'),
            // 'sections.*.qs' => array('required_with:sections.*', 'array'),
            // 'sections.*.qs.*' => array('required_with:sections.qs', 'array'),
            // 'sections.*.qs.*.template_id' => array('required', 'int'),
             'sections.*.qs.*.answer' => array('required', 'int'),
             'sections.*.qs.*.description' => array('sometimes', 'regex:/^[\s\w!-@#$^_:,.]*$/', 'max:250'),
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

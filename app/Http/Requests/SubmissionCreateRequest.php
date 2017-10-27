<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubmissionCreateRequest extends FormRequest
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
        $rules = [
            'andProcess' => 'required|boolean',
        ];

        if ($this->request->has('assessment')) {
            $rules['assessment.assessment_date'] = 'required|date';
            $rules['assessment.assessor_name'] = 'required';
            $rules['assessment.homeowner_name'] = 'required';
            $rules['assessment.homeowner_email'] = 'nullable|email';
            //$rules['assessment.homeowner_phone'] = 'required';
            $rules['assessment.homeowner_address'] = 'required';

            $rules['assessment.homeowner_uniqueid'] = 'required|unique:assessments,homeowner_uniqueid,';
        }

        return $rules;
    }

    /**
     * Custom messages
     */
    public function messages()
    {
         return [
            'required' => 'This field is required.',
            'date' => 'This is not a valid date.',
            'unique' => 'The unique identifier is not unique.',
         ];
    }

    /**
     * Return JSON object error messages
     */
    public function response(array $errors)
    {
        return new JsonResponse($errors, 422);
    }
}

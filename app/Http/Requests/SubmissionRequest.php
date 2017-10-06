<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubmissionRequest extends FormRequest
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
        }

        if ($this->request->has('improvements')) {
            foreach($this->request->get('improvements') as $key => $imp) {
                if (isset($imp['value'])) {
                    $rules['improvements.'.$key.'.value'] = Rule::in(['have', 'need']);
                }
            }
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
            'date' => 'This is not a valid date.'
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
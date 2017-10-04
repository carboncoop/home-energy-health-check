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
            'andProcess' => 'boolean',
            'assessment.assessment_date' => 'required|date',
        ];
        foreach($this->request->get('improvements') as $key => $imp) {
            if (isset($imp['value'])) {
                $rules['improvements.'.$key.'.value'] = Rule::in(['have', 'need']);
            }
        }
        return $rules;
    }

    public function messages()
    {
         return [
            'required' => 'The :attribute field is required, I\'m afraid.',
         ];
    }
}

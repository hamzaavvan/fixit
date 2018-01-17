<?php

namespace Fixit\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IssueFormRequest extends FormRequest
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
            'projectname' => 'required|min:4',
            'title' => 'required|min:4',
            'description' => 'required|min:4'
        ];
    }
}

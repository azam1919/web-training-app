<?php

namespace App\Http\Requests\web_training\heading;

use Illuminate\Foundation\Http\FormRequest;

class store extends FormRequest
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
        $allRules = [];
        $allRules['heading'] = 'required|unique:web_trainings,heading|string';
        $allRules['status'] = 'required|integer';
        return $allRules;
    }
}

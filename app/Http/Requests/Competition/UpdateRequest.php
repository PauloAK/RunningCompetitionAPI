<?php

namespace App\Http\Requests\Competition;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'type'      => 'required|string|max:45|in:3,5,10,21,42',
            'date'      => 'required|date|after:yesterday'
        ];
    }
}

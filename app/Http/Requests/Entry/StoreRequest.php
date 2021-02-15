<?php

namespace App\Http\Requests\Entry;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueEntryOnDay;

class StoreRequest extends FormRequest
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
            'competitor_id'     => 'bail|required|exists:competitors,id',
            'competition_id'    => ['bail', 'required', 'exists:competitions,id', new UniqueEntryOnDay( $this->input('competitor_id') ) ],
            'start'             => 'required|date',
            'finish'            => 'required|date'
        ];
    }
}

<?php

namespace App\Http\Requests\Modules\Library;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
        if(!$this->isMethod('post')) {
            return [];
        }


        return [
            'author_id' => 'sometimes|nullable|exists:authors,author_id',
            'author_name' => 'required|string|max:255',
            'author_birthday' => 'nullable|date'
        ];
    }
}

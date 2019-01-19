<?php

namespace App\Http\Requests\Modules\Library;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'book_id' => 'sometimes|nullable|exists:books,book_id',
            'book_name' => 'required|string|max:255',
            'book_publisher' => 'required|string|max:255',
            'book_year' => 'nullable|string|max:255',
            'book_language' => 'nullable|string|max:255',
            'book_pages' => 'nullable|numeric|digits_between:0,10000'
        ];
    }
}

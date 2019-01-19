<?php

namespace App\Http\Requests\Modules\Library;

use Illuminate\Foundation\Http\FormRequest;

class DailyRequest extends FormRequest
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
            'daily_id' => 'sometimes|nullable|exists:dailies,daily_id',
            'book_id' => 'required|integer|exists:books,book_id',
            'daily_description' => 'string',
            'daily_time_start' => 'required|string',
            'daily_time_end' => 'string'
        ];
    }
}

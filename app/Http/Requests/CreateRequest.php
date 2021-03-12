<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'published_at' => 'required|date|after:now',
            'content' => 'required|string',
            #'published' => 'required|integer',
            'user_id' => 'required|integer',
        ];
    }
}

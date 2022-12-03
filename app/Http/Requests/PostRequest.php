<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'event.event_year' => 'required|numeric',
            'event.event_name' => 'required|string|max:100',
            'event.tag' => 'string|max:100',
            'event.title' => 'required|string|max:100',
            'event.text' => 'required|string'
        ];
    }
}

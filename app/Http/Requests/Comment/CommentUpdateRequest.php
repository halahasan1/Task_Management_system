<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentUpdateRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this reques
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('comment'));
    }

    
    /**
     * Get the validation rules that apply to the request
     */
    public function rules(): array
    {
        return [
            'content'   => ['required', 'string', 'max:1000'],
        ];
    }

    /**
     * Get the custom messages for validator errors
     */
    public function messages(): array
    {
        return [
            'content.required' => 'Content is required to update the comment.',
            'content.string'   => 'Content should be a string.',
            'content.max'      => 'Content cannot exceed 1000 characters.',
        ];
    }
}

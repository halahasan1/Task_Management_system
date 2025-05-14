<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', \App\Models\Comment::class);
    }

    /**
     * Get the validation rules that apply to the request
     */
    public function rules(): array
    {
        return [
            'content'   => ['required', 'string', 'max:1000'],
            'task_id'   => ['required', 'exists:tasks,id'],
        ];
    }

    /**
     * Get the custom messages for validator errors
     */
    public function messages(): array
    {
        return [
            'content.required' => 'Content is required for the comment.',
            'content.string'   => 'Content should be a string.',
            'content.max'      => 'Content cannot exceed 1000 characters.',
            'task_id.required' => 'A task is required to associate the comment with.',
            'task_id.exists'   => 'The selected task does not exist.',
        ];
    }
}

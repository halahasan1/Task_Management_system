<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('task'));
    }

    
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title'        => ['sometimes', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'status_id'    => ['sometimes', 'exists:statuses,id'],
            'assigned_to'  => ['sometimes', 'exists:users,id'],
            'priority'     => ['nullable', 'in:low,medium,high'],
        ];
    }


    /**
     * Get custom error messages for validation rules
     */
    public function messages(): array
    {
        return [
            'title.string'         => 'The title must be a string.',
            'title.max'            => 'The title may not be greater than 255 characters.',

            'description.string'   => 'The description must be a string.',

            'status_id.exists'     => 'The selected status does not exist.',

            'assigned_to.exists'   => 'The assigned user does not exist.',

            'priority.in'          => 'The priority must be one of: low, medium, or high.',
        ];
    }
}

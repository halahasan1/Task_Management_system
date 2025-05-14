<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', \App\Models\Task::class);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'status_id'    => 'required|exists:statuses,id',
            'assigned_to'  => 'required|exists:users,id|different:created_by',
            'priority'     => 'nullable|in:low,medium,high',
        ];
    }

    /**
     * Get custom error messages for validation rules
     */
    public function messages(): array
    {
        return [
            'title.required'       => 'The task title is required.',
            'title.string'         => 'The title must be a string.',
            'title.max'            => 'The title may not be greater than 255 characters.',

            'description.string'   => 'The description must be a string.',

            'status_id.required'   => 'A status must be selected.',
            'status_id.exists'     => 'The selected status does not exist.',

            'assigned_to.required' => 'You must assign this task to a user.',
            'assigned_to.exists'   => 'The assigned user does not exist.',
            'assigned_to.different'=> 'The assigned user must be different from the creator.',

            'priority.in'          => 'The priority must be one of: low, medium, or high.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if (! $this->has('created_by')) {
            $this->merge([
                'created_by' => $this->user()->id(),
            ]);
        }
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusUpdateRequest extends FormRequest
{
    /**
     * Authorize only users who can manage statuses
     */
    public function authorize(): bool
    {
        return $this->user()->can('manage-statuses');
    }

    /**
     * Validation rules for updating a status
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:statuses,name,' . $this->route('status')->id],
        ];
    }

    /**
     * Custom error messages
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The status name is required.',
            'name.string'   => 'The status name must be a string.',
            'name.max'      => 'The status name may not be greater than 255 characters.',
            'name.unique'   => 'This status name is already taken.',
        ];
    }
}

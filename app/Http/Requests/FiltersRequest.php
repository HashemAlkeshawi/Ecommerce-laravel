<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

    class FiltersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // 'search_username' => 'min:5',
            'NameFilter' => 'nullable|string',
            // 'search_first_name' => 'min:3|max:15',
            // 'search_last_name' => 'min:3|max:15',
            // 'search_is_admin' => 'in:0,1',
            // 'seasrch_is_active' => 'in:0,1',
        ];
    }
}

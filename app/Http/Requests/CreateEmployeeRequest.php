<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'email' => 'string|email|required',
            'company_id' => 'numeric|required',
            'phone' => 'string|required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'social_media_accounts' => 'array|required',
            'social_media_accounts.*' => 'url',
        ];
    }
}

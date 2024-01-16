<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateMembershipValidation extends FormRequest
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
            'name'=> 'string|max:255',
            'description'=>'string|max:255',
            'price'=>'numeric|gt:0|decimal:2',
            'membership_type' => 'string|in:daily,weekly,monthly,annual',
        ];
    }
}

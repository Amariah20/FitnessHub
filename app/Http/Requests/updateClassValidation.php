<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateClassValidation extends FormRequest
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
            'location'=>'string|max:255',
            'description'=>'string|max:255',
            'schedule'=> 'string|max:255',
            'capacity'=>'numeric|gt:0',
            'duration'=>'numeric|gt:0',
            'price'=>'numeric|gt:0',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//used this for guidance: https://laravel.com/docs/10.x/validation  
class MembershipValidation extends FormRequest
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
            'name'=> 'required|string|max:255',
            'price'=>'required|numeric',
            'description'=>'required|string|max:255',
            'membership_type'=> 'required|in:daily,weekly,monthly,annual',

        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateGymValidation extends FormRequest
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
            'name'=> 'string|max:255|regex:/^[a-zA-Z]+[a-zA-Z\s\-\.\&]*$/', //name has to start with a letter. after first letter, there can be letters, space (\s), -,.,$
            'location'=>'string',
            'opening_hours'=>'string',
            'phone_number'=>'numeric|gt:0',
            'email'=>'email',
            'instagram'=>'nullable|string',
            'facebook'=>'nullable|string',
            'description'=>'string',
            'general_location' => 'string|in:north,east,south,west,central',
            'logo'=>'image|mimes:jpg,png,jpeg',
            'banner'=> 'image|mimes:jpg,png,jpeg',
            'extra_image'=> 'image|mimes:jpg,png,jpeg'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//used this for guidance: https://laravel.com/docs/10.x/validation 

class GymValidation extends FormRequest
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
            'location'=>'required|string',
            'opening_hours'=>'required|string',
            'phone_number'=>'required|numeric|gt:0',
            'email'=>'required|email',
            'instagram'=>'nullable|string',
            'facebook'=>'nullable|string',
            'description'=>'required|string',
            'general_location' => 'required|in:north,east,south,west,central',
            'logo'=>'image|mimes:jpg,png,jpeg',
            'banner'=> 'image|mimes:jpg,png,jpeg',
            'extra_image'=> 'image|mimes:jpg,png,jpeg'
        ];
    }
}

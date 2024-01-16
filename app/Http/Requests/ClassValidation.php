<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//used this for guidance: https://laravel.com/docs/10.x/validation  
class ClassValidation extends FormRequest
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
            'location'=>'required|string|max:255',
            'description'=>'required|string|max:255',
            'schedule'=> 'required|string|max:255',
            'capacity'=>'required|numeric',
            'duration'=>'required|numeric',
            'price'=>'required|numeric|gt:0|decimal:2',
            

        ];
    }
}

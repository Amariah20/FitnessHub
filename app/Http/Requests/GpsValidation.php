<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GpsValidation extends FormRequest
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
            'latitude'=> 'required|numeric|between: -90.0000000,90.0000000', //lat has to be between these values. we also enforced constraints when defining database table
            'longitude'=>'required|numeric|between: -180.0000000,180.0000000'
        ];
    }
}

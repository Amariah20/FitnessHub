<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use ConsoleTVs\Profanity\Facades\Profanity;


//used this for guidance: https://laravel.com/docs/10.x/validation 
//used this for regular expression for name: https://stackoverflow.com/questions/5231683/javascript-regular-expression-for-english-numeric-characters-only 

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
        
            //'name'=> 'required|string|max:255|regex:/^[a-zA-Z]+[a-zA-Z\s\-\.\&]*$/', //name has to start with a letter. after first letter, there can be letters, space (\s), -,.,$
            'name'=>'required|string|', //I dont think the regex is a good idea. what if some gyms have a unique name that starts with a number
            'location'=>'required|string',
            'opening_hours'=>'required|string',
            'phone_number'=>'required|numeric|gt:0|digits_between:1,20',
            'email'=>'required|email',
            'instagram'=>'nullable|string',
            'facebook'=>'nullable|string',
            'description'=>'required|string',
            'general_location' => 'required|in:north,east,south,west,central',
            'logo'=>'required|image|mimes:jpg,png,jpeg', //dimensions:width=height nope
            'banner'=> 'required|image|mimes:jpg,png,jpeg|dimensions:min_width=1920,min_height=1080',
            'extra_image'=> 'required|image|mimes:jpg,png,jpeg'

        ];
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gym;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\redirect;
use App\Http\Controllers\view;


//I used this for guidance for most of my controllers: https://www.youtube.com/watch?v=GAPzqFMSxVY&t=933s
//need to allow admins to add more than one gym 
class GymController extends Controller
{
      //for showing one gym
      public function show($Gym_id){
        $gym = Gym::where('Gym_id', $Gym_id)->first();
        return view('gymIndividual', compact('gym')); //compact ('gym') is passing the variable gym to the view
    }

    
    //for showing all gyms 
    public function list(){
        return view ('/gymAll', array('gyms'=>Gym::all()) );
    }
    


    function createGym(){
        return view('registerGym.addGym');
    }

    function storeGym(Request $req){
        $gymName= $req-> name; 
        $gymDescription= $req-> description;
        $gymLocation= $req-> location;
        $gymOpeningHours= $req-> opening_hours;
        $gymNumber= $req-> phone_number;
        $gymEmail= $req-> email;
        $gymInstagram= $req->instagram;
        $gymFacebook= $req->facebook;
        $userId = $req->user()->id;
        
        $NewGym= new \App\Models\Gym;
        $NewGym-> name = $gymName;
        $NewGym-> description= $gymDescription;
        $NewGym-> location = $gymLocation;
        $NewGym-> phone_number = $gymNumber;
        $NewGym-> email =  $gymEmail;
        $NewGym-> instagram =  $gymInstagram;
        $NewGym-> facebook =  $gymFacebook;
        $NewGym -> opening_hours =  $gymOpeningHours;
        $NewGym->user_id = $userId;
        

        $NewGym-> save();
        
        return redirect()->route('membership.create')->with('success', 'Membership successfully added');


       


        


    }
}

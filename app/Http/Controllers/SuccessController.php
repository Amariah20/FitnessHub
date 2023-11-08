<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gym;
use Illuminate\Support\Facades\Auth;

class SuccessController extends Controller
{
    public function message(){

        $user = Auth::user(); // Get the logged in user
               
        $gym = $user->gym; // Retrieve the gyms associated with the user
        
                
                return view('registerGym.successGym', compact('gym'));
        
    }

    public function display(Request $req){
        
        $Gym_id= $req-> SelectedGymID;
        
        //duplicated code. this is same as function show in GymController
        $gym = Gym::where('Gym_id', $Gym_id)->first();
        return view('gymIndividual', compact('gym'));
       


    }
}

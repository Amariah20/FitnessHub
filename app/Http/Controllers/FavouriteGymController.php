<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Gym;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FavouriteGymController extends Controller
{
    
    public function storeFavGym(Request $req){


        if(!Auth::check()){
            return redirect()->back()->withErrors(['error' => 'You must log in to bookmark a gym.']);
        }

        $user_id= Auth::id();
        $gym_id=$req->gym_id;

        $NewFavGym = new \App\Models\FavouriteGym;
        $NewFavGym->user_id = $user_id;
        $NewFavGym->gym_id= $gym_id;

        $NewFavGym->save();

        return redirect()->back()->with('success','Gym saved as favourite!');

    }


}

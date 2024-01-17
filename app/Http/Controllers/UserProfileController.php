<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FavouriteGym;
use Illuminate\Support\Facades\Auth;
use App\Models\Gym;


class UserProfileController extends Controller
{
    public function userProfile(){

        if(!Auth::check()){
           // return redirect()->back()->withErrors(['error' => 'You must log in.']);//redirect to log in page??
           return redirect()->route('login');
        }

        $user= Auth::user();
        $user_id = $user->id;
        
        $favGyms_Ids = FavouriteGym::where('user_id', $user_id)->pluck('gym_id')->toArray();

        if(!empty($favGyms_Ids)){
            $favGyms= Gym::whereIn('Gym_id', $favGyms_Ids)->orderBy('name', 'asc')->get(); //whereIn is giving me all gyms, but where was showing only the first one
    
        } else{
            $favGyms = null;
        }

        return view ('userProfile', compact('favGyms'));
        


    }
}

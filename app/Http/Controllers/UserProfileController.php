<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FavouriteGym;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Gym;


class UserProfileController extends Controller
{
    public function userProfile(){

        if(!Auth::check()){
           // return redirect()->back()->withErrors(['error' => 'You must log in.']);//redirect to log in page??
           Session::put('url.intended', route('userProfile'));
           return redirect()->route('login'); // i want to take them to user profile after they logged in tho, if they were redirected to log after trying to access user profile
        }


        $user= Auth::user();
        $user_id = $user->id;

        
        
        $favGyms_Ids = FavouriteGym::where('user_id', $user_id)->pluck('gym_id')->toArray();

        if(!empty($favGyms_Ids)){
            $favGyms= Gym::whereIn('Gym_id', $favGyms_Ids)->orderBy('name', 'asc')->get(); //whereIn is giving me all gyms, but where was showing only the first one
    
        } else{
            $favGyms = null;
        }

        return view ('userProfile', compact('favGyms', 'user'));

    }

    public function editUserDetails(Request $req){ //change this. we dont want to pass the user id as parameter. use hidden
        // $gym = Gym::find($Gym_id);

        //dd($req->all());
        $user_id = $req->user_id;
        $user = User::where('id', $user_id)->first();
        //dd($user);
         return view ('editUserDetails', compact('user'));
 
     }

    public function UpdateUser(Request $req){
        $name = $req->name;
        $email= $req->email;
        $DOB= $req->date_of_birth;
        $address= $req->address;
        $user_id = $req->user_id;

        $user= User::where('id', $user_id)->first();
        $user->name= $name;
        $user->date_of_birth=$DOB;
        $user->address= $address;

       /* $stored_password = $user->password;
        //dd($stored_password);
        $entered_password = $req->password;
        $hased_entered_password= Hash::make($entered_password);
        dd($stored_password,$hased_entered_password);
       // if ($req->password =) */
        $user->update(); 
        
        return redirect()->route('userProfile')->with('success', 'Details Successfully Updated');
        
        
    }
}

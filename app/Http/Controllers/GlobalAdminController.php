<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rating;
use App\Models\Gym;
use ConsoleTVs\Profanity\Facades\Profanity;

class GlobalAdminController extends Controller
{
    public function listUsers()
    {
        $users = User::all();

        return view('GlobalAdmin.AdminAccess', compact('users'));//compact ('users') is passing the variable users to the view
    }

    public function grantAdminAccess(Request $request, User $user)
    {
        $user->is_admin = true; //sets is_admin column in database to true. so now, user has access to admin pages
        $user->save();

        return redirect()->route('allUsers')->with('success', 'Admin access granted successfully.');
            


        //return('Admin access granted successfully.');
        
    }

    public function revokeAdminAccess(User $user)
    {
        $user->is_admin = false;
        $user->save();

        return redirect()->route('allUsers')->with('success', 'Admin access revoked successfully.');
        //return ('Admin access revoked successfully.');
    }

    //lines 46 to 48 of globalAdminGyms function was written with the help of AI. AI helped me debug this part. My original solution has been commented out.
    public function globalAdminGyms(){
        //$gyms=Gym::with('ratings')->all();
       // $pendingCount= Rating::where('approved', 'awaiting approval')->count(); //number of ratings with pending approval
        $gyms= Gym::with(['ratings'=>function($x){
            $x->where('approved','awaiting approval');
        }])->get();
        /**
         * for above code. retrieving gyms with their related ratings. " $x->where('approved','awaiting approval')" 
         * is a filter. loading gyms, and for each gym, load the ratings where approved = awaiting approval. 
         */

        //$ratings_count= $gyms->ratings->count();
        //dd($ratings_count);
        
        
        $sortFunction= function($gym){
            //counting num of ratings thats waiting for approval for each gym. also leveraging the rela in models between gym and ratings
            return $gym->ratings->where('approved', 'awaiting approval')->count();
        };

        //sorting them in descending order 
        $sortedGyms= $gyms->sortByDesc($sortFunction);
      
        $gyms= $sortedGyms;

      

    
        return view('GlobalAdmin.globalAdminGyms', compact('gyms'));

    }
}

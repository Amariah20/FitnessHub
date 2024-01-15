<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rating;
use App\Models\Gym;

class GlobalAdminController extends Controller
{
    public function listUsers()
    {
        $users = User::all();

        return view('AdminAccess', compact('users'));//compact ('users') is passing the variable users to the view
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
        
        

        $gyms= $gyms->sortByDesc(function($gym){
            return $gym->ratings->where('approved', 'awaiting approval')->count();
        });

        /**
         * sortbyDesc will sort gyms in descending order accordingto  a key or a function.
         * function ($gym){} is calculating the sorting value for each gym here
         * $gym = each gym in the gyms collection. 
         * filtering the ratings that has not yet been approved, and counting them
         * 
         */

    
        return view('globalAdminGyms', compact('gyms'));

    }
}

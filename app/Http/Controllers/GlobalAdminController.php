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
        $gyms=Gym::all();
        
        return view('globalAdminGyms', compact('gyms'));

    }
}

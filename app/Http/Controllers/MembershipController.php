<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gym;
use App\Models\Membership;
use Illuminate\Support\Facades\Auth;

//I used this for guidance for most of my controllers: https://www.youtube.com/watch?v=GAPzqFMSxVY&t=933s
class MembershipController extends Controller
{
    public function createMembership(){
/*Go through gyms table, see what gyms are associated with the user id (the user that is logged in). 
display these in a drop down and let them select which gym they want the membership to apply to*/

        $user = Auth::user(); // Get the logged in user
       
        $gym = $user->gym; // Retrieve the gyms associated with the user

        
        return view('registerGym.addMembership', compact('gym'));
    }

    public function storeMembership(Request $req)
        {
            $CurrentUser = Auth::user();
            
         
            // Checking if user has a gym
            if (!$CurrentUser->gyms) { //there's a rela between gym and user in models.
               return 'You must create a gym first, before adding memberships.';
            }

            if (empty($SelectedGymID)) {
                return 'Please select a gym before adding a membership.';
            }

           

            
 
            $MembershipName = $req-> name;
            $MembershipPrice= $req->price;
            $MembershipDescription = $req-> description;
            $SelectedGymID= $req -> SelectedGymID;

          

            $NewMembership = new \App\Models\Membership();
            $NewMembership->name = $MembershipName;
            $NewMembership->price = $MembershipPrice;
            $NewMembership->description =  $MembershipDescription;
            $NewMembership->gym_id = $SelectedGymID;

            $NewMembership->save();
            





        }
}

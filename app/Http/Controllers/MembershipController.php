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
        return view('registerGym.addMembership'); 
    }

    public function storeMembership(Request $req)
        {
            $CurrentUser = Auth::user();
            
        
            // Checking if user has a gym
            if (!$CurrentUser->gym) { //there's a rela between gym and user in modelS. NEED TO ADD THIS IN USER MODEL TOO??
               return 'You must create a gym first, before adding memberships.';
            }

           

            
 
            $MembershipName = $req-> name;
            $MembershipPrice= $req->price;
            $MembershipDescription = $req-> description;

            $NewMembership = new \App\Models\Membership();
            $NewMembership->name = $MembershipName;
            $NewMembership->price = $MembershipPrice;
            $NewMembership->description =  $MembershipDescription;
            $NewMembership->gym_id = $CurrentUser-> gym->Gym_id; 

            $NewMembership->save();
            





        }
}

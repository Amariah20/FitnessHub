<?php

namespace App\Http\Controllers;

use App\Http\Requests\MembershipValidation;
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

    public function storeMembership(MembershipValidation $req)
        {
            try{
            $CurrentUser = Auth::user();
            
             
            // Checking if user has a gym
            if ($CurrentUser->gym->isEmpty()) { //there's a rela between gym and user in models.
             // return 'You must create a gym first, before adding memberships.';
              //return redirect()->back()->with('error', 'You must create a gym first, before adding memberships.');
              return redirect()->back()->withErrors(['error' => 'You must create a gym first, before adding memberships.']);
            }
            

           
            if (($req->SelectedGymID== "Select Gym")) {
                //return 'Please select a gym before adding a membership.';
                return redirect()->back()->withErrors(['error' => 'Please select a gym before adding a membership.']);
           }
            
           $validate = $req->validated();
           
           if ($validate ==true){
            $MembershipName = $req-> name;
            $MembershipPrice= $req->price;
            $MembershipDescription = $req-> description;
            $SelectedGymID= $req -> SelectedGymID;
           }

            
          

            $NewMembership = new \App\Models\Membership();
            $NewMembership->name = $MembershipName;
            $NewMembership->price = $MembershipPrice;
            $NewMembership->description =  $MembershipDescription;
            $NewMembership->gym_id = $SelectedGymID;

            $NewMembership->save();
            return redirect()->route('membership.create')->with('success_membership', 'Membership successfully added. You may add more or move to the next section.');
            
        } catch (\Exception $e){
            $error= "An error occured:". $e->getMessage();
            //return view ('gymIndividual', compact('error'));
            return redirect()->back()->withErrors(['error'=>$error]);
        }




        }
}

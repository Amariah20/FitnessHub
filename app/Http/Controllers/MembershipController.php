<?php

namespace App\Http\Controllers;

use App\Http\Requests\MembershipValidation;
use Illuminate\Http\Request;
use App\Models\Gym;
use App\Models\Membership;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Log;
use Illuminate\Support\Facades\DB;


//I used this for guidance for most of my controllers: https://www.youtube.com/watch?v=GAPzqFMSxVY&t=933s
class MembershipController extends Controller
{
    public function membershipCreate(){

//find gym related to user by going through gym table. use the rela between gym and user to find it. allow users to choose which gym to assign the membership to

        $currentUser = Auth::user(); // Get the logged in user
       
        $gym = $currentUser->gym; // Retrieve the gyms associated with the user

        
        return view('registerGym.addMembership', compact('gym'));
    }

    public function membershipStore(MembershipValidation $req)
        {
            try{
            $user = Auth::user();
            
             
            //  does user have a gym??
            if ($user->gym->isEmpty()) { //using rela betweeen gyms and users set up in model and database.
            
              //return redirect()->back()->with('error', 'You must create a gym first, before adding memberships.');
              return redirect()->back()->withErrors(['error' => 'You must create a gym before adding memberships.']);
            }
            

           
            if (($req->SelectedGymID== "Select Gym")) {
                //return 'Please select a gym before adding a membership.';
                return redirect()->back()->withErrors(['error' => 'Please select a gym before adding memberships.']);
           }
            
           $validated = $req->validated();
           
           if ($validated == true){
            $membership_Name = $req-> name;
            $membership_Price= $req->price;
            $membership_Description = $req-> description;
            $membership_Type= $req->membership_type;
            $Gym_ID= $req -> SelectedGymID;

           }

            
          

            $new_Membership = new \App\Models\Membership();
            $new_Membership->name = $membership_Name;
            $new_Membership->price = $membership_Price;
            $new_Membership->description =  $membership_Description;
            $new_Membership->membership_type = $membership_Type;
            $new_Membership->gym_id = $Gym_ID;

            
            

            $new_Membership->save();
          
             return redirect()->route('memberships.create')->with('success_membership', 'Membership successfully added. You may add more or move to the next section.');

        
          
            
            
        } catch (\Exception $exception){
            $error= "There has been an error:". $exception->getMessage();
            //return view ('gymIndividual', compact('error'));
            //return redirect()->back()->with('error', $error);
            return redirect()->back()->withErrors(['error'=>$error]);
        }
        }
}

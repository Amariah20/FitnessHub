<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gym;
use App\Models\Offerings;
use Illuminate\Support\Facades\Auth;

//I used this for guidance for most of my controllers: https://www.youtube.com/watch?v=GAPzqFMSxVY&t=933s
class OfferingController extends Controller
{
    public function createOffering(){
        /*Go through gyms table, see what gyms are associated with the user id (the user that is logged in). 
        display these in a drop down and let them select which gym they want the membership to apply to*/
        
                $user = Auth::user(); // Get the logged in user
               
                $gym = $user->gym; // Retrieve the gyms associated with the user
        
                
                return view('registerGym.addOffering', compact('gym'));
            }

            public function storeOffering(Request $req)
        {

            try{
            $CurrentUser = Auth::user();
            
             
            // Checking if user has a gym
            if ($CurrentUser->gym->isEmpty()) { //there's a rela between gym and user in models.
             // return 'You must create a gym first, before adding memberships.';
              //return redirect()->back()->with('error', 'You must create a gym first, before adding memberships.');
              return redirect()->back()->withErrors(['error' => 'You must create a gym first, before adding an offering.']);
            }
            

           
            if (($req->SelectedGymID== "Select Gym")) {
                //return 'Please select a gym before adding a membership.';
                return redirect()->back()->withErrors(['error' => 'Please select a gym before adding an offering.']);
           }
                     
            $OfferingName = $req-> name;
            $OfferingPrice= $req->price;
            $OfferingDescription = $req-> description;
            $SelectedGymID= $req -> SelectedGymID;

            
          

            $NewOffering = new \App\Models\Offerings();
            $NewOffering->name = $OfferingName;
            $NewOffering->price = $OfferingPrice;
            $NewOffering->description =  $OfferingDescription;
            $NewOffering->gym_id = $SelectedGymID;

            $NewOffering->save();
            return redirect()->route('offering.create')->with('success_offering', 'Item successfully added. You may add more or move to the next section.');
        } catch (\Exception $e){
            $error= "An error occured:". $e->getMessage();
            //return view ('gymIndividual', compact('error'));
            return redirect()->back()->withErrors(['error'=>$error]);
        }  

      }
      public function show($Offering_id){
        $offering= Offerings::where('offerings_id', $Offering_id)->first();
       
        return view ('offeringShow', compact('offering'));


    }
}

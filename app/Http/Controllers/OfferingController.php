<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferingValidation;
use Illuminate\Http\Request;
use App\Models\Gym;
use App\Models\Offerings;
use Illuminate\Support\Facades\Auth;
use ConsoleTVs\Profanity\Facades\Profanity;

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

            public function storeOffering(OfferingValidation $req)
            {
          

            try{

                
            $CurrentUser = Auth::user();
            
             
            // Checking if user has a gym
            if ($CurrentUser->gym->isEmpty()) { //there's a rela between gym and user in models.
            
              return redirect()->back()->withErrors(['error' => 'You must create a gym first, before adding a service.']);
            }
            

           
            if (($req->SelectedGymID== "Select Gym")) {
                
                return redirect()->back()->withErrors(['error' => 'Please select a gym before adding  a service.'])->withInput();
           }


            /**put all input values ($req->all()) into an array.  iterate over it. as long as coun<array.length, 
         * input the value into profitanity checker. test if clear()==true, if so, check next array value. else, stop the loop and
         * throw an exception
        **/    

        $allInput= $req->all();
        foreach($allInput as $value){
            //dd($value);
            $clean =Profanity::blocker($value)->clean();
            if($clean==false){
        return redirect()->back()->withErrors(['Error','Inappropriate language detected in input. Please change ' .$value])->withInput();
        
            }
            
        }
           
            
           $validate = $req->validated();
           if ($validate ==true){
            $OfferingName = $req-> name;
            $OfferingPrice= $req->price;
            $OfferingDescription = $req-> description;
            $SelectedGymID= $req -> SelectedGymID;
           }

        

            
          

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
            return redirect()->back()->withErrors(['error'=>$error])->withInput();
        }  

      }
      public function show($Offering_id){
        $offering= Offerings::where('offerings_id', $Offering_id)->first();
       
        return view ('offeringShow', compact('offering'));


    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentValidation;
use Illuminate\Http\Request;
use App\Models\Gym;
use App\Models\Equipment;
use Illuminate\Support\Facades\Auth;
use ConsoleTVs\Profanity\Facades\Profanity;


class EquipmentController extends Controller
{
    public function createEquipment(){
        /*Go through gyms table, see what gyms are associated with the user id (the user that is logged in). 
        display these in a drop down and let them select which gym they want the membership to apply to*/
        
                $user = Auth::user(); // Get the logged in user
               
                $gym = $user->gym; // Retrieve the gyms associated with the user
        
                
                return view('registerGym.addEquipment', compact('gym'));
            }

        public function storeEquipment(EquipmentValidation $req)
        {
            try{
            $CurrentUser = Auth::user();
            
             
            // Checking if user has a gym
            if ($CurrentUser->gym->isEmpty()) { //there's a rela between gym and user in models.
             // return 'You must create a gym first, before adding memberships.';
              //return redirect()->back()->with('error', 'You must create a gym first, before adding memberships.');
              return redirect()->back()->withErrors(['error' => 'You must create a gym first, before adding equipments.']);
            }
            

           
            if (($req->SelectedGymID== "Select Gym")) {
                //return 'Please select a gym before adding a membership.';
                return redirect()->back()->withErrors(['error' => 'Please select a gym before adding equipments.'])->withInput();
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
           if ($validate==true){
            $EquipmentName = $req-> name;
          
            $EquipmentDescription = $req-> description;
            $SelectedGymID= $req -> SelectedGymID;
           }

           
          

            $NewEquipment = new \App\Models\Equipment();
            $NewEquipment->name =  $EquipmentName;

            $NewEquipment->description =  $EquipmentDescription;
            $NewEquipment->gym_id = $SelectedGymID;

            $NewEquipment->save();
            return redirect()->route('equipment.create')->with('success_equipment', 'Equipment successfully added. You may add more or move to the next section.');
        } catch (\Exception $e){
            $error= "An error occured:". $e->getMessage();
            //return view ('gymIndividual', compact('error'));
            return redirect()->back()->withErrors(['error'=>$error])->withInput();
        }     

      }
      public function show($Equipment_id){
        $equipment= Equipment::where('equipment_id', $Equipment_id)->first();
       
        return view ('equipmentShow', compact('equipment'));


    }
}

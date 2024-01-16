<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gym;
use App\Models\Classes;
use App\Models\Offerings;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ClassValidation;
use ConsoleTVs\Profanity\Facades\Profanity;

//I used this for guidance for most of my controllers: https://www.youtube.com/watch?v=GAPzqFMSxVY&t=933s
class ClassesController extends Controller
{
    public function createClass(){
        /*Go through gyms table, see what gyms are associated with the user id (the user that is logged in). 
        display these in a drop down and let them select which gym they want the membership to apply to*/
        
                $user = Auth::user(); // Get the logged in user
               
                $gym = $user->gym; // Retrieve the gyms associated with the user
        
                
                return view('registerGym.addClass', compact('gym'));
            }

            public function storeClass(ClassValidation $req)
            {

                try{



                $CurrentUser = Auth::user();
                
                 
                // Checking if user has a gym
                if ($CurrentUser->gym->isEmpty()) { //there's a rela between gym and user in models.
               
                  return redirect()->back()->withErrors(['error' => 'You must create a gym first, before adding classes.']);
                }
                
    
               
                if (($req->SelectedGymID== "Select Gym")) {
                    
                    return redirect()->back()->withErrors(['error' => 'Please select a gym before adding a class.']);
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
        return redirect()->back()->withErrors(['Error','Inappropriate language detected in input. Please change ' .$value]);
        
            }
            
        }
               
               $validate = $req->validated();
                if ($validate ==true){
                    $ClassName = $req-> name;
                    $ClassLocation= $req-> location;
                    $ClassPrice= $req->price;
                    $ClassDescription = $req-> description;
                    $ClassCapacity= $req-> capacity;
                    $ClassDuration= $req-> duration;
                    $ClassSchedule= $req-> schedule;
                    $SelectedGymID= $req -> SelectedGymID;
                }
    
                
              
    
                $NewClass = new \App\Models\Classes();
                $NewClass->name = $ClassName;
                $NewClass->price = $ClassPrice;
                $NewClass->description = $ClassDescription;
                $NewClass->gym_id = $SelectedGymID;
                $NewClass-> capacity= $ClassCapacity;
                $NewClass->duration=  $ClassDuration;
                $NewClass->location=  $ClassLocation;
                $NewClass->schedule= $ClassSchedule;
    
                $NewClass->save();
                return redirect()->route('class.create')->with('success_class', 'Class successfully added. You may add more or move to the next section.');
                   
            } catch (\Exception $e){
                $error= "An error occured:". $e->getMessage();
                //return view ('gymIndividual', compact('error'));
                return redirect()->back()->withErrors(['error'=>$error]);
            }
            }

            public function show($Class_id){
                $class= Classes::where('Class_id', $Class_id)->first();
                //$class= Classes::find($Class_id);
                return view ('classShow', compact('class'));


            }

           
}

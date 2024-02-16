<?php

namespace App\Http\Controllers;

use App\Http\Requests\GpsValidation;
use Illuminate\Http\Request;
use App\Models\gps;
use App\Models\Gym;
use Illuminate\Support\Facades\Auth;

class GpsController extends Controller
{
    public function createGps(){

        $user = Auth::user(); // Get the logged in user
               
        $gym = $user->gym; // Retrieve the gyms associated with the user

        return view ('registerGym.inputGps', compact('gym'));
    }

    public function storeGps(GpsValidation $req){
        try{

            //dd('work');

            //$name = $req->name; //retrieve from gym_id
            $SelectedGymID= $req -> SelectedGymID;

           if(!empty(gps::where('gym_id', $SelectedGymID)->first())){
                return redirect()->back()->withErrors(['error'=>'Each gym can have only one GPS coordinates. Coordinates can be updated in the admin panel.'])->withInput();
           }

           $validate = $req->validated();
           if ($validate ==true){


            $gym = Gym::where('Gym_id',  $SelectedGymID)->first();
            
            $lat = $req->latitude;
            $lng = $req-> longitude;
           
           
            $name= $gym->name;

            $gps = new \App\Models\gps();
            $gps->name = $name;
            $gps->latitude=$lat;
            $gps->longitude = $lng;
            $gps->gym_id = $SelectedGymID;

            $gps->save();

            return redirect()->back()->with('success', 'Gps coordinates successfully added!');

           }

        }catch (\Exception $e){
            $error= "An error occured:". $e->getMessage();
            
            return redirect()->back()->withErrors(['error'=>$error])->withInput();
        }  

    }

    public function displayMaps(){
        $locations = gps::all();
        //dd($locations);

        return view ('maps', compact('locations'));
    }

    public function locations(){
        $locations = gps::all();
        return response()->json ($locations); //this goes to map.js

    }
}

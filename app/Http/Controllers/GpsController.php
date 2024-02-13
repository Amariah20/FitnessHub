<?php

namespace App\Http\Controllers;

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

    public function storeGps(Request $req){
        try{

            //dd('work');

            //$name = $req->name; //retrieve from gym_id
            $lat = $req->latitude;
            $lng = $req-> longitude;
            $SelectedGymID= $req -> SelectedGymID;
            $gym = Gym::where('Gym_id',  $SelectedGymID)->first();
            $name= $gym->name;

            $gps = new \App\Models\gps();
            $gps->name = $name;
            $gps->latitude=$lat;
            $gps->longitude = $lng;
            $gps->gym_id = $SelectedGymID;

            $gps->save();

            return redirect()->back()->with('success', 'Gps coordinates successfully added!');



        }catch (\Exception $e){
            $error= "An error occured:". $e->getMessage();
            
            return redirect()->back()->withErrors(['error'=>$error]);
        }  

    }

    public function displayMaps(){
        $locations = gps::all();
        //dd($locations);

        return view ('maps', compact('locations'));
    }

    public function locations(){
        $locations = gps::all();
        return response()->json ($locations);

    }
}

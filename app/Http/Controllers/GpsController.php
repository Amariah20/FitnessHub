<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\gps;

class GpsController extends Controller
{
    public function createGps(){
        return view ('inputGps');
    }

    public function storeGps(Request $req){
        try{

            //dd('work');

            $name = $req->name;
            $lat = $req->latitude;
            $lng = $req-> longitude;

            $gps = new \App\Models\gps();
            $gps->name = $name;
            $gps->latitude=$lat;
            $gps->longitude = $lng;

            $gps->save();

            return redirect()->back()->with('success', 'Gps coordinates successfully added!');



        }catch (\Exception $e){
            $error= "An error occured:". $e->getMessage();
            
            return redirect()->back()->withErrors(['error'=>$error]);
        }  

    }
}

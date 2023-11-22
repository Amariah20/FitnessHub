<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gym;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\redirect;
use App\Http\Controllers\view;
use App\Models\Classes;
use App\Models\Membership;
use App\Models\Offerings;
use Illuminate\Support\Facades\Auth;

class AdminPanelController extends Controller
{


   /* public function AdminFirst(Request $req)
    {
        $user = Auth::user();
        $gym = $user->gym;
        $selectedGymID = $req->SelectedGymID;

        dd($selectedGymID);
        // Pass the selectedGymID as a parameter when redirecting to AdminWelcome
        return redirect()->route('AdminWelcome', ['selectedGymID' => $selectedGymID]);
    }*/




   public function AdminFirst(Request $req){
        $user = Auth::user(); // Get the logged in user
       
        $gym = $user->gym; // Retrieve the gyms associated with the user

        $Gym_Id= $req->SelectedGymID;
       
        
      //  return view('AdminWelcome', compact('gym', 'Gym_Id'));
      //return view("{{route('AdminWelcome', ['Gym_id'=>$Gym_Id])}}" , compact('gym', 'Gym_Id'));
     // return redirect()->route('AdminWelcome', ['Gym_id'=>$Gym_Id]);
     //return redirect()->route('AdminWelcome/{$Gym_Id}');
     return view ('AdminInterface.adminFirst', compact ('gym'));
    }

    public function AdminWelcome(Request $req)
    {
        $Gym_id= $req->SelectedGymID;
        $gym = Gym::where('Gym_id', $Gym_id)->first();
        $classes = Classes::where('gym_id', $Gym_id)->get();
        $offerings =  Offerings::where('gym_id',$Gym_id)->get();
        $memberships= Membership::where('gym_id', $Gym_id)->get();


       
       // return redirect()->route('AdminInterface.adminWelcome',compact('Gym_id' ));
        //return view('AdminInterface.adminWelcome', compact('Gym_id'));
        return view('AdminInterface.adminWelcome', compact('Gym_id', 'gym', 'classes', 'offerings','memberships'));
    }

    public function AdminClass(Request $req, $Gym_id)
    {
        //dd($Gym_id);
        
        $classes = Classes::where('Gym_id', $Gym_id)->get();
 
    
        return view('AdminInterface.adminClass', compact('Gym_id','classes'));
    }
   
    public function AdminOffering (Request $req, $Gym_id){
        $offerings= Offerings::where('Gym_id', $Gym_id)->get();

        return view('AdminInterface.adminOffering', compact ('Gym_id', 'offerings'));
    }

    public function AdminMembership (Request $req, $Gym_id){
        $memberships= Membership::where('Gym_id', $Gym_id)->get();

        return view('AdminInterface.adminMembership', compact ('Gym_id', 'memberships'));
    }



   
}

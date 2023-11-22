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
     return view ('AdminInterface.adminFirst', compact ('gym', 'user'));
    }

    public function AdminWelcome(Request $req)
    {
        $user = Auth::user(); 
        $Gym_id= $req->SelectedGymID;
      //  $Gym_id = $req->Gym_id;
        $gym = Gym::where('Gym_id', $Gym_id)->first();
        $classes = Classes::where('gym_id', $Gym_id)->get();
        $offerings =  Offerings::where('gym_id',$Gym_id)->get();
        $memberships= Membership::where('gym_id', $Gym_id)->get();


       
       // return redirect()->route('AdminInterface.adminWelcome',compact('Gym_id' ));
        //return view('AdminInterface.adminWelcome', compact('Gym_id'));
        return view('AdminInterface.adminWelcome', compact('Gym_id', 'gym', 'classes', 'offerings','memberships', 'user'));
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

    //I used this for help with updating: https://www.fundaofwebit.com/laravel-8/how-to-edit-update-data-in-laravel 

    public function EditGym($Gym_id){
       // $gym = Gym::find($Gym_id);
       $gym = Gym::where('Gym_id', $Gym_id)->first();
        return view ('AdminInterface.editGym', compact('gym'));

    }

    public function UpdateGym(Request $req,$Gym_id){

       

        $gym = Gym::where('Gym_id', $Gym_id)->first();    
        //$gym->Gym_id= $Gym_id;
       // $gym->name= $req->name;
        $gym->description= $req-> description;
        $gym->location= $req-> location;
        $gym->opening_hours= $req-> opening_hours;
        $gym->phone_number= $req-> phone_number;
        $gym->email= $req-> email;
        $gym->instagram= $req->instagram;
        $gym->facebook= $req->facebook;
        $gym->user_id = $req->user()->id; 
        $gymFolder = 'public/images/uploaded/gym_' .  $gym->user_id. $gym->name; //gym Id has not been created yet. 

            // checking that subfolder exists, and if not, create it
            if (!file_exists($gymFolder)) {
                mkdir($gymFolder, 0755, true);
            }
           
           if($req->hasfile('logo')){
            $pic=$req->file('logo');
            $extension= $pic->getClientOriginalExtension();
            $logo= time().'._logo.'.$extension;
            $pic->move($gymFolder, $logo);
            $gym->logo=$logo;
           }

           if($req->hasfile('banner')){
            $pic=$req->file('banner');
            $extension= $pic->getClientOriginalExtension();
            $banner= time().'._banner.'.$extension;
            $pic->move($gymFolder, $banner);
            $gym->banner= $banner;
           }
           if($req->hasfile('extra_image')){
            $pic=$req->file('extra_image');
            $extension= $pic->getClientOriginalExtension();
            $extra= time().'._extra_image.'.$extension;
            $pic->move($gymFolder, $extra);
            $gym->extra_image=$extra;
           }

       
        $gym->update();
        //return('done');
        //return redirect()->route('AdminWelcome', compact('Gym_id', 'gym'))->with('Success','Gym Updated Successfully');
        //return redirect()->route('AdminWelcome', compact('Gym_id'))->with('Success','Gym Updated Successfully');
        return redirect()->route('AdminWelcome', ['SelectedGymID' => $Gym_id])->with('Success', 'Gym Updated Successfully');

    }

    public function EditClass($Class_id){
        // $gym = Gym::find($Gym_id);
        //$gym = Gym::where('Gym_id', $Gym_id)->first();
        $class= Classes::where('Class_id', $Class_id)->first();
         return view ('AdminInterface.editClass', compact('class'));
 
     }

     public function UpdateClass(Request $req,$Class_id){

        $class= Classes::where('Class_id', $Class_id)->first();
        $class->name = $req-> name;
        $class->price = $req->price;
        $class->description =  $req-> description;
        $class-> capacity= $req-> capacity;
        $class->duration=  $req-> duration;
        $class->location=  $req-> location;
        $class->schedule= $req-> schedule;

        $class->update();
        return redirect()->route('AdminClass', ['Gym_id' => $class->gym_id])->with('Success', 'Class Updated Successfully');

     }

    }

   


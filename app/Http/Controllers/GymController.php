<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gym;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\redirect;
use App\Http\Controllers\view;
use App\Http\Requests\GymValidation;
use App\Models\Classes;
//use App\Models\Images;
use App\Models\Membership;
use App\Models\Offerings;
use App\Models\Equipment;



//I used this for guidance for most of my controllers: https://www.youtube.com/watch?v=GAPzqFMSxVY&t=933s
//need to allow admins to add more than one gym 
class GymController extends Controller
{
      //for showing one gym
      public function show($Gym_id){

      try{
        $gym = Gym::where('Gym_id', $Gym_id)->first();
       // return view('gymIndividual', compact('gym')); //compact ('gym') is passing the variable gym to the view

       // Retrieve last images entered in database associated with the gym
       //$images = Images::where('gym_id', $Gym_id)->latest()->first();
       $memberships= Membership::where('gym_id', $Gym_id)->get();
       $numOfclasses= Classes::where('gym_id', $Gym_id)->count();
       $numOfofferings= Offerings::where('gym_id',$Gym_id)->count();
       $count= $numOfclasses + $numOfofferings;
       $numequipment = Equipment::where('gym_id', $Gym_id)->count();
       

       return view('gymIndividual', compact('gym', 'memberships', 'count', 'numOfclasses','numOfofferings', 'numequipment'));
    } catch (\Exception $e){
        $error= "An error occured:". $e->getMessage();
        //return view ('gymIndividual', compact('error'));
        return redirect()->back()->withErrors(['error'=>$error]);
    }
}

  

    //to display all classes and offerings in that gym
    public function showOfferings($Gym_id){
        $gym = Gym::where('Gym_id', $Gym_id)->first();
        $classes = Classes::where('gym_id', $Gym_id)->get();
        $offerings =  Offerings::where('gym_id',$Gym_id)->get();

        return view('classesOfferings',  compact('gym', 'classes', 'offerings'));
    }


    public function showEquipments($Gym_id){
        $gym = Gym::where('Gym_id', $Gym_id)->first();
        $equipments = Equipment::where('gym_id', $Gym_id)->get();
        return view('equipments', compact('gym', 'equipments'));

    }

    
    //for showing all gyms 
    public function list(){
        return view ('/gymAll', array('gyms'=>Gym::all()) );
        
    }
    


    function createGym(){
        return view('registerGym.addGym');
    }

    function storeGym(GymValidation $req) {

    try{
      
            
        $validate = $req->validated();
        if ($validate==true){
            $gymName= $req-> name; 
            $gymDescription= $req-> description;
            $gymLocation= $req-> location;
            $gymOpeningHours= $req-> opening_hours;
            $gymNumber= $req-> phone_number;
            $gymEmail= $req-> email;
            $gymInstagram=$req->instagram;
            $gymFacebook =$req->facebook;
            $userId = $req->user()->id;
        }


        
        
        $NewGym= new \App\Models\Gym;
        $NewGym-> name = $gymName;
        $NewGym-> description= $gymDescription;
        $NewGym-> location = $gymLocation;
        $NewGym-> phone_number = $gymNumber;
        $NewGym-> email =  $gymEmail;
        $NewGym-> instagram =  $gymInstagram;
        $NewGym-> facebook =  $gymFacebook;
        $NewGym -> opening_hours =  $gymOpeningHours;
        $NewGym->user_id = $userId;
        //dd($NewGym->Gym_id);
        //$gymFolder = 'public/images/uploaded/gym_' .$NewGym->Gym_id;
        $gymFolder = 'public/images/uploaded/gym_' . $userId.$gymName; //gym Id has not been created yet

            // checking that subfolder exists, and if not, create it
            if (!file_exists($gymFolder)) {
                mkdir($gymFolder, 0755, true);
            }
           
           if($req->hasfile('logo')){
            $pic=$req->file('logo');
            $extension= $pic->getClientOriginalExtension();
            $logo= time().'._logo.'.$extension;
            $pic->move($gymFolder, $logo);
            $NewGym->logo=$logo;
           }

           if($req->hasfile('banner')){
            $pic=$req->file('banner');
            $extension= $pic->getClientOriginalExtension();
            $banner= time().'._banner.'.$extension;
            $pic->move($gymFolder, $banner);
            $NewGym->banner= $banner;
           }
           if($req->hasfile('extra_image')){
            $pic=$req->file('extra_image');
            $extension= $pic->getClientOriginalExtension();
            $extra= time().'._extra_image.'.$extension;
            $pic->move($gymFolder, $extra);
            $NewGym->extra_image=$extra;
           }

           

        

        

        $NewGym-> save();
        
        return redirect()->route('membership.create')->with('success', 'successfully added');
    } catch (\Exception $e){
        $error= "An error occured:". $e->getMessage();
        //return view ('gymIndividual', compact('error'));
        return redirect()->back()->withErrors(['error'=>$error]);
    }

        
    }


    
}

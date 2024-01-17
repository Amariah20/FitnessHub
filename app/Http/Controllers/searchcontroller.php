<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Gym;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\redirect;
use App\Http\Controllers\view;
use App\Models\Classes;
use App\Models\Equipment;
use App\Models\Membership;
use App\Models\Offerings;
use Laravel\Ui\Presets\React;
use App\Models\User;

//I used these for help:  https://laracasts.com/series/laravel-8-from-scratch/episodes/37 and https://www.youtube.com/watch?v=aPYEOVDTV6E, https://stackoverflow.com/questions/39321570/laravel-wherein-or-wheren-with-where#:~:text=Note%3A%20where%20will%20compare%20with,compare%20evey%20index%20of%20array. 
    //I found information about pluck method here: https://laravel.com/docs/10.x/collections

class searchcontroller extends Controller
{


 
public function search(Request $req){
    $searchitems= $req->search;
  //  $gyms= Gym::all();
   // $classes= Classes::all();

    
    $gyms= Gym::query()->where(function($query) use ($searchitems){
         $query->where('name', 'like', '%'.$searchitems. '%')
         ->orWhere(function($query) use ($searchitems){
            $query ->where('description', 'like','%'.$searchitems. '%')
         ->orWhere('location', 'like', '%'.$searchitems. '%')
         ->orWhere('general_location', 'like', '%'.$searchitems. '%')
        ->orWhere('instagram', 'like','%'.$searchitems. '%')
        ->orWhere('facebook', 'like', '%'.$searchitems. '%');
         });
    })->get();

    
              
        $classes=Classes::query()->where(function($query) use ($searchitems){
            $query->where('name',  'like','%'.$searchitems. '%');
            })->get();

             if($classes->isNotEmpty()){
        

                 $gym_Ids=$classes->pluck('gym_id')->toArray(); //pluck gets the gym ids of each class. these are put in an array
                 $gyms= $gyms->merge(Gym::whereIn('Gym_id', $gym_Ids)->get());  // where will compare with just first value of array or just one single value. and whereIn will compare evey index of array.
        //combining gyms that matches something in gym table AND in class table
                
             } 




            $offerings=Offerings::query()->where(function($query) use ($searchitems){
                $query->where('name',  'like','%'.$searchitems. '%');
                })->get();
            if($offerings->isNotEmpty()){

            $gym_Ids= $offerings->pluck('gym_id')->toArray(); //pluck gets the gym ids of each class. these are put in an array
            $gyms=  $gyms->merge(Gym::whereIn('Gym_id', $gym_Ids)->get());  // where will compare with just first value of array or just one single value. and whereIn will compare evey index of array.
  
             }  

            $equipments =Equipment::query()->where(function($query) use ($searchitems){
                $query->where('name',  'like','%'.$searchitems. '%');
                })->get();

            if($equipments->isNotEmpty()){

            $gym_Ids= $equipments->pluck('gym_id')->toArray(); //pluck gets the gym ids of each class. these are put in an array
            $gyms= $gyms->merge( Gym::whereIn('Gym_id', $gym_Ids)->get());  // where will compare with just first value of array or just one single value. and whereIn will compare evey index of array.//whereIn is giving me all gyms, but where was showing only the first one
            }  

            if($gyms->isEmpty())
            {
                return redirect('gymAll')->with('no_result', 'No Results maching your search were found');
            }
            
            return view('gymAll', compact('gyms'));
    }

    public function searchClass(Request $req, $Gym_id){
        $searchitems = $req->search;
        

        $classes= Classes::where('gym_id', $Gym_id)
        ->where('name',  'like','%'.$searchitems. '%')->get(); 

        return view('AdminInterface.adminClass', compact('classes', 'Gym_id'));

    }

    
    public function searchEquipment(Request $req, $Gym_id){
        $searchitems = $req->search;
        

        $equipments= Equipment::where('gym_id', $Gym_id)
        ->where('name',  'like','%'.$searchitems. '%')->get(); 

        return view('AdminInterface.adminEquipment', compact('equipments', 'Gym_id'));

    }

       
    public function searchOffering(Request $req, $Gym_id){
        $searchitems = $req->search;
        

        $offering= Offerings::where('gym_id', $Gym_id)
        ->where('name',  'like','%'.$searchitems. '%')->get(); 

        return view('AdminInterface.adminOffering', compact('offering', 'Gym_id'));

    }

    public function searchMembership(Request $req, $Gym_id){
        $searchitems = $req->search;
        

        $memberships= Membership::where('gym_id', $Gym_id)
        ->where('name',  'like','%'.$searchitems. '%')->get(); 

        return view('AdminInterface.adminMembership', compact('memberships', 'Gym_id'));

    }

    public function searchUser(Request $req){
        $searchitems = $req->search;

        $users= User::where('name', 'like','%'.$searchitems. '%')
        ->orWhere('email',  'like','%'.$searchitems. '%')->get();

        return view('AdminAccess', compact('users'));


    }


}




    
  

        //if($gyms->isEmpty()){

            /*
            //RETURNS ONLY ONE RESULT. NEED TO COMBINE WITH THE ONE ABOVE INTO ONE FUNCTION
            public function search(Request $req){
                $searchitems= $req->search;
            

        $classes= Classes::query()->where(function($query) use ($searchitems){
        $query->where('name',  'like','%'.$searchitems. '%');
        })->get();

        
        
        //$gyms=[];
        $gyms =collect();

        //if(!$classes->isEmpty()){

            foreach($classes as $class){
                //$gym_Ids[]= $class->gym_id;
              //  $gyms[]= Gym::where('Gym_id', $class->gym_id)->get();
                //$gyms[]= Gym::where('Gym_id', $class->gym_id)->first();
               // $gyms= Gym::where('Gym_id', $class->gym_id)->get();
               $gyms =$gyms->merge(Gym::where('Gym_id', $class->gym_id)->get());
            //  dd($gyms);
          //  }

       // $gym_id= $classes->gym_id;
       //$gyms = Gym::where('Gym_id', $gym_Ids )->get();
        
        //$gyms= Gym::where('Gym_id', $gym_id)->get();
       
        //$gyms= collect($gyms)->flatten(); //flatten coverts the array into a flat list of gyms.

        return view('gymAll', compact('gyms'));
        } */


        



    

   


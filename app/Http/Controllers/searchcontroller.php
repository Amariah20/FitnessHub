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
            ->orWhere('instagram', 'like','%'.$searchitems. '%')
            ->orWhere('facebook', 'like', '%'.$searchitems. '%');
             });
        })->get();

        if ($gyms->isNotEmpty()){

            return view('gymAll', compact('gyms'));
        } else {
                    
   
            
            $classes=Classes::query()->where(function($query) use ($searchitems){
                $query->where('name',  'like','%'.$searchitems. '%');
                })->get();
            if($classes->isNotEmpty()){

            $gym_Ids=$classes->pluck('gym_id')->toArray(); //pluck gets the gym ids of each class. these are put in an array
            $gyms= Gym::whereIn('Gym_id', $gym_Ids)->get();  // where will compare with just first value of array or just one single value. and whereIn will compare evey index of array.
            
            return view('gymAll', compact('gyms'));

            } else{

                $offerings=Offerings::query()->where(function($query) use ($searchitems){
                    $query->where('name',  'like','%'.$searchitems. '%');
                    })->get();
                if($offerings->isNotEmpty()){
    
                $gym_Ids= $offerings->pluck('gym_id')->toArray(); //pluck gets the gym ids of each class. these are put in an array
                $gyms= Gym::whereIn('Gym_id', $gym_Ids)->get();  // where will compare with just first value of array or just one single value. and whereIn will compare evey index of array.
                
                return view('gymAll', compact('gyms'));

            }  else{

                $equipments =Equipment::query()->where(function($query) use ($searchitems){
                    $query->where('name',  'like','%'.$searchitems. '%');
                    })->get();
                if($equipments->isNotEmpty()){
    
                $gym_Ids= $equipments->pluck('gym_id')->toArray(); //pluck gets the gym ids of each class. these are put in an array
                $gyms= Gym::whereIn('Gym_id', $gym_Ids)->get();  // where will compare with just first value of array or just one single value. and whereIn will compare evey index of array.
                
                return view('gymAll', compact('gyms'));

            }  
        }
    }
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


        }



    

   


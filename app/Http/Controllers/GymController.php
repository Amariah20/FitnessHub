<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gym;
use Illuminate\Support\Facades\Storage;
use Illumintate\Database\Eloquent\Model;
use App\Http\Controllers\redirect;
use App\Http\Controllers\view;
use App\Http\Requests\GymValidation;
use App\Models\Classes;
//use App\Models\Images;
use App\Models\Membership;
use App\Models\Offerings;
use App\Models\Equipment;
use App\Models\Rating;
use ConsoleTVs\Profanity\Facades\Profanity;
use App\Models\FavouriteGym;
use Illuminate\Support\Facades\Auth;



//using this profanity filter: https://github.com/ConsoleTVs/Profanity everywhere
//I used this for guidance for most of my controllers: https://www.youtube.com/watch?v=GAPzqFMSxVY&t=933s
//I used this to paginate the collection and to display 3 gyms per pages: https://gist.github.com/simonhamp/549e8821946e2c40a617c85d2cf5af5e 

class GymController extends Controller
{
      //for showing one gym
     // public function show (Gym $gym){
      public function show($Gym_id){
        ///public function show($slug){

      try{

    
      
      $gym = Gym::where('Gym_id', $Gym_id)->first();
      // $gym = Gym::where('slug', $slug)->first();
       // return view('gymIndividual', compact('gym')); //compact ('gym') is passing the variable gym to the view

       // Retrieve last images entered in database associated with the gym
       //$images = Images::where('gym_id', $Gym_id)->latest()->first();
     
     
      $memberships= Membership::where('gym_id', $Gym_id)->get();
      $numOfclasses= Classes::where('gym_id', $Gym_id)->count();
      $numOfofferings= Offerings::where('gym_id',$Gym_id)->count();
      $count= $numOfclasses + $numOfofferings;
      $numequipment = Equipment::where('gym_id', $Gym_id)->count();
      $ratings = Rating:: with('user')->where('gym_id', $Gym_id) //this is getting the details of user that entered the review
      ->where('approved', 'approved')
      ->get();
    
      //$numOfratings= Rating::where('gym_id', $Gym_id)
     // ->where('approved', 'approved')->count();
      //$ratingsTotal=  Rating::where('gym_id', $Gym_id)
      //->where('approved', 'approved') ->sum('ratings');
      //$ratingsAverage= $ratingsTotal/$numOfratings;
      //dd($numOfratings, $ratingsTotal);
       //dd($ratings);

       //put an if, to not calculate if there is no approved!
       //selecting values in rating table that maches the gym id and where rating has been approved. we pass rating column as a parameter to avg() to find the average of records that meet the criteria
       $ratingsAverage=  Rating::where('gym_id', $Gym_id)->where('approved', 'approved')->avg('rating');
       //dd($ratingsAverage);

       return view('gymIndividual', compact('gym', 'memberships', 'count', 'numOfclasses','numOfofferings', 'numequipment', 'ratings', 'ratingsAverage'));
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
    public function list(){ //controller method must accept route parameter. 
        
     if(Auth::check()){  //if user is logged in
       // $gyms=Gym::all();
       $user= Auth::user();
       $user_id = $user->id;
       //dd($user_id);
       $favGyms_Ids = FavouriteGym::where('user_id', $user_id)->pluck('gym_id')->toArray(); //pluck gets the gym ids of each gym. these are put in an array
       //dd($favGyms_Ids);
       
       if(!empty($favGyms_Ids)){
        $favGyms= Gym::whereIn('Gym_id', $favGyms_Ids)->orderBy('name', 'asc')->get(); //whereIn is giving me all gyms, but where was showing only the first one
        //$ordered_fav_gyms = $favGyms::orderBy('name', 'asc');
        //dd($favGyms);

       }

    }

      
       $all_gyms= Gym::orderBy('name', 'asc')->get();

       //$all_gyms= Gym::orderBy('name', 'asc');

       if (!empty($favGyms)){
       //$gyms = merge($all_gyms, $favGyms);
       //$gyms=$all_gyms->merge($favGyms); 
       //$not_fav_gyms = $all_gyms->whereNotIn('Gym_id', $favGyms_Ids)->By('name', 'asc');
       $gyms= $favGyms->concat($all_gyms);  //The concat method appends the given array or collection's values onto the end of another collection
      

       } else{
        $gyms = $all_gyms;
       }

       //$gyms=collect($gyms)->paginate(3); 
      // collect($gyms)->paginate(3); //tried to use this package from github, and it did not work:https://github.com/spatie/laravel-collection-macros/#paginate UNINSTALL IT
      //$gyms= $gyms->chunk(3);
      $gyms= $gyms->paginate(5); //I used this to paginate the collection and to display 3 gyms per pages: https://gist.github.com/simonhamp/549e8821946e2c40a617c85d2cf5af5e 


        return view ('/gymAll', compact('gyms'));
        
    }
    


    function createGym(){
        return view('registerGym.addGym');
    }

    function storeGym(GymValidation $req) {

    try{
      
        
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
     

        if ($validate==true ){
            $gymName= $req-> name; 
            $gymDescription= $req-> description;
            $gymLocation= $req-> location;
            $gymOpeningHours= $req-> opening_hours;
            $gymNumber= $req-> phone_number;
            $gymEmail= $req-> email;
            $gymInstagram=$req->instagram;
            $gymFacebook =$req->facebook;
            $gymGeneralLocation= $req->general_location;
            $userId = $req->user()->id;


        


        
        
        $NewGym= new \App\Models\Gym;
        $NewGym-> name = $gymName;
        $NewGym-> description= $gymDescription;
        $NewGym-> location = $gymLocation;
        $NewGym-> phone_number = $gymNumber;
        $NewGym-> email =  $gymEmail;
        $NewGym-> instagram =  $gymInstagram;
        $NewGym-> facebook =  $gymFacebook;
        $NewGym -> opening_hours =  $gymOpeningHours;
        $NewGym->general_location=  $gymGeneralLocation;
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

        }
           

        

        

        $NewGym-> save();

        $Gym_id= $NewGym->Gym_id;
        
        return redirect()->route('memberships.create')->with('success', 'successfully added');
    } catch (\Exception $e){
        $error= "An error occured:". $e->getMessage();
        //return view ('gymIndividual', compact('error'));
        return redirect()->back()->withErrors(['error'=>$error]);
    }

        
    }


    
}

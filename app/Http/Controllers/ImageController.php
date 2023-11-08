<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gym;
use App\Models\Images;
use Illuminate\Support\Facades\Auth;

//I used this for help: https://www.youtube.com/watch?v=Xel-0xPJECc


class ImageController extends Controller
{
    public function createImage(){
        /*Go through gyms table, see what gyms are associated with the user id (the user that is logged in). 
        display these in a drop down and let them select which gym they want the membership to apply to*/
        
                $user = Auth::user(); // Get the logged in user
               
                $gym = $user->gym; // Retrieve the gyms associated with the user
        
                
                return view('registerGym.addImages', compact('gym'));
    }

    public function storeImage(Request $req){

        $CurrentUser = Auth::user();
            
             
            // Checking if user has a gym
            if ($CurrentUser->gym->isEmpty()) { //there's a rela between gym and user in models.
             
              return redirect()->back()->withErrors(['error' => 'You must create a gym first, before adding images.']);
            }
            

           
            if (($req->SelectedGymID== "Select Gym")) {
                
                return redirect()->back()->withErrors(['error' => 'Please select a gym before adding images.']);
           }

           $newImage= new \App\Models\Images();
           $SelectedGymID= $req -> SelectedGymID;
           $newImage->gym_id = $SelectedGymID;
           
           if($req->hasfile('logo')){
            $file=$req->file('logo');
            $extention= $file->getClientOriginalExtension();
            $logo= time().'.'.$extention;
            $file->move('public/images/uploaded/', $logo);
            $newImage->logo=$logo;
           }

           if($req->hasfile('banner')){
            $file=$req->file('banner');
            $extention= $file->getClientOriginalExtension();
            $banner= time().'._banner.'.$extention;
            $file->move('public/images/uploaded/', $banner);
            $newImage->banner= $banner;
           }
           if($req->hasfile('extra_image')){
            $file=$req->file('extra_image');
            $extention= $file->getClientOriginalExtension();
            $extra= time().'._extra_image.'.$extention;
            $file->move('public/images/uploaded/', $extra);
            $newImage->extra_image=$extra;
           }

           

           $newImage->save();

    }
        
    
}

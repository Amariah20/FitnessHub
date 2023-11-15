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

             // Create a subfolder based on the gym's id so that the images for each gym is in its own folder
            $gymFolder = 'public/images/uploaded/gym_' . $SelectedGymID;

            // checking that subfolder exists, and if not, create it
            if (!file_exists($gymFolder)) {
                mkdir($gymFolder, 0755, true);
            }
           
           if($req->hasfile('logo')){
            $pic=$req->file('logo');
            $extension= $pic->getClientOriginalExtension();
            $logo= time().'.'.$extension;
            $pic->move($gymFolder, $logo);
            $newImage->logo=$logo;
           }

           if($req->hasfile('banner')){
            $pic=$req->file('banner');
            $extension= $pic->getClientOriginalExtension();
            $banner= time().'._banner.'.$extension;
            $pic->move($gymFolder, $banner);
            $newImage->banner= $banner;
           }
           if($req->hasfile('extra_image')){
            $pic=$req->file('extra_image');
            $extension= $pic->getClientOriginalExtension();
            $extra= time().'._extra_image.'.$extension;
            $pic->move($gymFolder, $extra);
            $newImage->extra_image=$extra;
           }

           

           $newImage->save();
           


           //This view doesn't work. need to fix it
          return redirect()->route('sucessGym');
    }

    public function displayImage(){
        
    }
        
    
}

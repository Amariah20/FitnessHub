<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rating;
use App\Models\Gym;
use ConsoleTVs\Profanity\Facades\Profanity;

class RatingController extends Controller
{
    public function storeRating(Request $req){
        //we need gym_id, user_id, stars and writing. writing is not essential though
        if(!Auth::check()){
            return redirect()->back()->withErrors(['error' => 'You must log in to leave a review.']);
        }

        $user_id= Auth::id();
        $gym_id=$req->gym_id;
        $review = $req->review;
        $rate= $req->rate;
    
        if($rate==null){
            return redirect()->back()->withErrors(['error' => 'Please add at least one star rating for this gym.']);
        }
        /* on one hand, it's a good idea to block this because then it prevents people from leaving multiple hate/good reviews
        on the other hand, what if someone initially had a good experience but then had a bad experience or visa versa and wants to change their review?
         $count_rating = Rating::where(['user_id'=> $user_id, 'gym_id'=>$gym_id])->count();
        
        if($count_rating>0){
            return redirect()->back()->withErrors(['error' => 'You have already left a review for that gym.']);

        }
        */

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
       
  
        
        $newRating = new \App\Models\Rating();
        $newRating->user_id= $user_id;
        $newRating->gym_id=$gym_id;
        $newRating->review=$review;
        $newRating->rating=$rate;
        $newRating->approved= 'awaiting approval';

        $newRating->save();

        return redirect()->back()->with('success','Thank you for the review!');

    }
    
    //global admin accesses this page to see all reviews, and to change review status. if approved, the review is posted on the gym's page
    public function reviewStatus($Gym_id){
        $ratings = Rating::where('gym_id', $Gym_id)->orderBy('created_at', 'desc')->get();
        $gym= Gym::where('Gym_id', $Gym_id)->first();

        
        return view ('GlobalAdmin.gymRatings', compact('ratings', 'gym'));

    }

    public function approveStatus(Request $req){

        
        $rating_id= $req->rating_id;

        $rating= Rating::where('rating_id', $rating_id)->first();
       
        $rating->approved= $req->approved;
       //dd($rating, $req->approved);
        $rating->save();

        return redirect()->back()->with('success','Review Status successfully updated!');


    }

   
}
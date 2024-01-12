<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rating;

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
    
        
        $newRating = new \App\Models\Rating();
        $newRating->user_id= $user_id;
        $newRating->gym_id=$gym_id;
        $newRating->review=$review;
        $newRating->rating=$rate;

        $newRating->save();

        return redirect()->back()->with('success','Thank you for the review!');

    }
}
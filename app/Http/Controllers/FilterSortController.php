<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\Gym;
use App\Models\Rating;
use ConsoleTVs\Profanity\Facades\Profanity;

class FilterSortController extends Controller
{
    public function sortMembershipPrice(Request $req){

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
        $sort=$req->sort;
        
        if ($sort=="monthly-low"){
           
            $memberships=Membership::where('membership_type','monthly')->get();
            $sortedMemberships= $memberships->sortBy('price'); //sortBy sorts in ascending order
            //dd($sortedMemberships);

            $gym_ids=$sortedMemberships->pluck('gym_id')->toArray(); //copied from searchController
           // dd($gym_ids);
            $gyms=Gym::whereIn('Gym_id',$gym_ids)->get();
           // dd($gyms);
            // $gym_ids=$memberships->pluck('gym_id')->toArray();
           // $gyms= Gym::whereIn('Gym_id', $gym_ids)->orderBy($memberships->price, 'asc')->get();
           // ->orderByRaw("FIELD(Gym_id),".implode(',',$gym_ids).")")
            //->get(); 
             
            $sortedGyms=collect([]); //creating a collection of ordered gyms based on the order of memberships

            /**go through sorted memberships as it stores the memberships in the proper order. 
             * go through gyms has it has the gyms associated with the memberships.
             * find the gym whose id matches the gym id of the first membership in the sorted list
             * check that the gym actually exists, and add it to the collection of sorted gyms
             * repeat the process. now it will go to the next gym in the ordered membership list
             * */ 
            foreach($sortedMemberships as $sortedMembership){
                $gym=$gyms->where('Gym_id', $sortedMembership->gym_id)->first();
                if($gym){
                    $sortedGyms->push($gym); //push adds an item to the end of the collection. 
                }
            }
            $gyms=$sortedGyms;
            //must call paginate before calling gymAll route, all ways
            $gyms= $gyms->paginate(5); //I used this to paginate the collection and to display 3 gyms per pages: https://gist.github.com/simonhamp/549e8821946e2c40a617c85d2cf5af5e 

            return view ("/gymAll",compact('gyms'));


        } else if ($sort=="monthly-high"){

            $memberships=Membership::where('membership_type','monthly')->get();

            $sortedMemberships= $memberships->sortByDesc('price'); //sorts in descending order

            $gym_ids=$sortedMemberships->pluck('gym_id')->toArray(); 

            $gyms=Gym::whereIn('Gym_id',$gym_ids)->get();

            $sortedGyms=collect([]);

            foreach($sortedMemberships as $sortedMembership){
                $gym=$gyms->where('Gym_id', $sortedMembership->gym_id)->first();
                if($gym){
                    $sortedGyms->push($gym);
                }
            }

            $gyms=$sortedGyms;
              //must call paginate before calling gymAll route, all ways
              $gyms= $gyms->paginate(5); 

            return view ("/gymAll",compact('gyms'));

       
    } else if($sort=="annual-low"){
        $memberships=Membership::where('membership_type','annual')->get();
        $sortedMemberships= $memberships->sortBy('price');

        $gym_ids=$sortedMemberships->pluck('gym_id')->toArray(); 
        $gyms=Gym::whereIn('Gym_id',$gym_ids)->get();

        $sortedGyms=collect([]);

        foreach($sortedMemberships as $sortedMembership){
            $gym=$gyms->where('Gym_id', $sortedMembership->gym_id)->first();
            if($gym){
                $sortedGyms->push($gym);
            }
        }
        $gyms=$sortedGyms;

          //must call paginate before calling gymAll route, all ways
          $gyms= $gyms->paginate(5); 
        return view ("/gymAll",compact('gyms'));

    }else if($sort=="annual-high"){
        $memberships=Membership::where('membership_type','annual')->get();

        $sortedMemberships= $memberships->sortByDesc('price'); //sorts in descending order

        $gym_ids=$sortedMemberships->pluck('gym_id')->toArray(); 

        $gyms=Gym::whereIn('Gym_id',$gym_ids)->get();

        $sortedGyms=collect([]);

        foreach($sortedMemberships as $sortedMembership){
            $gym=$gyms->where('Gym_id', $sortedMembership->gym_id)->first();
            if($gym){
                $sortedGyms->push($gym);
            }
        }

        $gyms=$sortedGyms;
          //must call paginate before calling gymAll route, all ways
          $gyms= $gyms->paginate(5); 

        return view ("/gymAll",compact('gyms'));

    } else if($sort=="daily-low"){
        $memberships=Membership::where('membership_type','daily')->get();
        $sortedMemberships= $memberships->sortBy('price');

        $gym_ids=$sortedMemberships->pluck('gym_id')->toArray(); 
        $gyms=Gym::whereIn('Gym_id',$gym_ids)->get();

        $sortedGyms=collect([]);

        foreach($sortedMemberships as $sortedMembership){
            $gym=$gyms->where('Gym_id', $sortedMembership->gym_id)->first();
            if($gym){
                $sortedGyms->push($gym);
            }
        }
        $gyms=$sortedGyms;

          //must call paginate before calling gymAll route, all ways
          $gyms= $gyms->paginate(5); 
        return view ("/gymAll",compact('gyms'));
        

    }else if($sort=="daily-high"){
        $memberships=Membership::where('membership_type','daily')->get();
        $sortedMemberships= $memberships->sortByDesc('price');

        $gym_ids=$sortedMemberships->pluck('gym_id')->toArray(); 
        $gyms=Gym::whereIn('Gym_id',$gym_ids)->get();

        $sortedGyms=collect([]);

        foreach($sortedMemberships as $sortedMembership){
            $gym=$gyms->where('Gym_id', $sortedMembership->gym_id)->first();
            if($gym){
                $sortedGyms->push($gym);
            }
        }
        $gyms=$sortedGyms;
          //must call paginate before calling gymAll route, all ways
          $gyms= $gyms->paginate(5); 

        return view ("/gymAll",compact('gyms'));
    }else if($sort=="weekly-low"){
        $memberships=Membership::where('membership_type','weekly')->get();
        $sortedMemberships= $memberships->sortBy('price');

        $gym_ids=$sortedMemberships->pluck('gym_id')->toArray(); 
        $gyms=Gym::whereIn('Gym_id',$gym_ids)->get();

        $sortedGyms=collect([]);

        foreach($sortedMemberships as $sortedMembership){
            $gym=$gyms->where('Gym_id', $sortedMembership->gym_id)->first();
            if($gym){
                $sortedGyms->push($gym);
            }
        }
        $gyms=$sortedGyms;
          //must call paginate before calling gymAll route, all ways
          $gyms= $gyms->paginate(5); 

        return view ("/gymAll",compact('gyms'));
    }else if($sort=="weekly-high"){
        $memberships=Membership::where('membership_type','weekly')->get();
        $sortedMemberships= $memberships->sortByDesc('price');

        $gym_ids=$sortedMemberships->pluck('gym_id')->toArray(); 
        $gyms=Gym::whereIn('Gym_id',$gym_ids)->get();

        $sortedGyms=collect([]);

        foreach($sortedMemberships as $sortedMembership){
            $gym=$gyms->where('Gym_id', $sortedMembership->gym_id)->first();
            if($gym){
                $sortedGyms->push($gym);
            }
        }
        $gyms=$sortedGyms;
          //must call paginate before calling gymAll route, all ways
          $gyms= $gyms->paginate(5); 

        return view ("/gymAll",compact('gyms'));
               
    }
}

public function filterLocation(Request $req){
    $filter=$req->filter_location;
    
    if($filter=="north"){
        $gyms= Gym::where('general_location', 'north')->get();
          //must call paginate before calling gymAll route, all ways
          $gyms= $gyms->paginate(5); 
        return view ("/gymAll",compact('gyms'));


    } elseif($filter=="east"){
        $gyms= Gym::where('general_location', 'east')->get();
          //must call paginate before calling gymAll route, all ways
          $gyms= $gyms->paginate(5); 
        return view ("/gymAll",compact('gyms'));


    } elseif($filter=="south"){
        $gyms= Gym::where('general_location', 'south')->get();
          //must call paginate before calling gymAll route, all ways
          $gyms= $gyms->paginate(5); 
        return view ("/gymAll",compact('gyms'));


    } elseif($filter=="west"){
        $gyms= Gym::where('general_location', 'west')->get();
          //must call paginate before calling gymAll route, all ways
          $gyms= $gyms->paginate(5); 
        return view ("/gymAll",compact('gyms'));


    } elseif($filter=="central"){
        $gyms= Gym::where('general_location', 'central')->get();
          //must call paginate before calling gymAll route, all ways
          $gyms= $gyms->paginate(5); 
        return view ("/gymAll",compact('gyms'));


    }
}

    public function sortRating (Request $req){
        //actually, put this into the existing sort function 
        //what if a gym has no rating?? it wont be in the rating table.

        //from highest rating to lowest rating
        
        //MUST CALCULATE AVERAGE RATING FOR THIS ONE x
        $sort=$req->sort_rating;
        
        if ($sort=="rating-low"){
           
            $ratings = Rating::all()->sortBy('rating');
            $gym_ids=$ratings->pluck('gym_id')->toArray(); 
            
            $gyms=Gym::whereIn('Gym_id',$gym_ids)->get();

            $sortedGyms=collect([]);

            foreach($ratings as $rating){
                $gym=$gyms->where('Gym_id', $rating->gym_id)->first();
                if($gym){
                    $sortedGyms->push($gym);
                }
            }

            $gyms=$sortedGyms;
           
            //must call paginate before calling gymAll route, all ways
            $gyms= $gyms->paginate(5); //I used this to paginate the collection and to display 3 gyms per pages: https://gist.github.com/simonhamp/549e8821946e2c40a617c85d2cf5af5e 

            return view ("/gymAll",compact('gyms'));


        //from lowest rating to highest rating
    }

}
}

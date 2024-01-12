<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\Gym;

class FilterSortController extends Controller
{
    public function sortMembershipPrice(Request $req){
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
                    $sortedGyms->push($gym);
                }
            }
            $gyms=$sortedGyms;

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

        return view ("/gymAll",compact('gyms'));
               
    }
}

public function filterLocation(Request $req){
    $filter=$req->filter_location;
    
    if($filter=="north"){
        $gyms= Gym::where('general_location', 'north')->get();
        return view ("/gymAll",compact('gyms'));


    } elseif($filter=="east"){
        $gyms= Gym::where('general_location', 'east')->get();
        return view ("/gymAll",compact('gyms'));


    } elseif($filter=="south"){
        $gyms= Gym::where('general_location', 'south')->get();
        return view ("/gymAll",compact('gyms'));


    } elseif($filter=="west"){
        $gyms= Gym::where('general_location', 'west')->get();
        return view ("/gymAll",compact('gyms'));


    } elseif($filter=="central"){
        $gyms= Gym::where('general_location', 'central')->get();
        return view ("/gymAll",compact('gyms'));


    }
}
}

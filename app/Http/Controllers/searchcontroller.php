<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Gym;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\redirect;
use App\Http\Controllers\view;
use App\Models\Classes;

use App\Models\Membership;
use App\Models\Offerings;

//I used these for help:  https://laracasts.com/series/laravel-8-from-scratch/episodes/37 and https://www.youtube.com/watch?v=aPYEOVDTV6E 
class searchcontroller extends Controller
{

    
    public function search(Request $req){
        $searchitems= $req->search;
        $gyms= Gym::all();
        $classes= Classes::all();

        
        $gyms= Gym::query()->where(function($query) use ($searchitems){
             $query->where('name', 'like', '%'.$searchitems. '%')
             ->orWhere(function($query) use ($searchitems){
                $query ->where('description', 'like','%'.$searchitems. '%')
             ->orWhere('location', 'like', '%'.$searchitems. '%')
            ->orWhere('instagram', 'like','%'.$searchitems. '%')
            ->orWhere('facebook', 'like', '%'.$searchitems. '%');
             });
        })->get();

            return view('gymAll', compact('gyms'));

        $classes= Classes::query()
        ->where('name',  'like','%'.$searchitems. '%');
        

    }

   
}

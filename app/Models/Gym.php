<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    

     //rela between gym & memberships. gym has many memberships
     public function memberships()
     {
         return $this->hasMany(Membership::class);
     }
 
     //rela between gym and user 
    public function user()
     {
         return $this->belongsTo(User::class); 
     }
}

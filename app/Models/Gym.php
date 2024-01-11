<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;
use App\Models\Membership;
use App\Models\User;
use App\Models\Offerings;
use App\Models\Images;
use App\Models\Equipment;
use App\Models\subscription;
use Cviebrock\EloquentSluggable\Sluggable;


//I used this for help with slugs https://www.youtube.com/watch?v=JZ0TwtAtY9E
class Gym extends Model
{

    use HasFactory;
    use Sluggable;

    protected $fillable=[
        'slug',
    ];
    
    public function sluggable(): array{
        return[

            'slug'=>[
                'source'=> ['name', 'location'],
            ],
        ];
    }

    
    protected $primaryKey = 'Gym_id'; //added when trying to edit gym info

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

     //one gym has many classes. one to many rela between gym and classes
     public function classes()
     {
         return $this->hasMany(Classes::class); 
     }

      //rela between gym & offerings. gym has many offerings
      public function offerings()
      {
          return $this->hasMany(Offerings::class);
      }
  
      public function images()
      {
         // return $this->hasMany(Images::class, 'gym_id', 'Gym_id');
         return $this->hasMany(Images::class); //not sure if this is ok. might need to change ERD
      }

        //rela between gym & offerings. gym has many offerings
        public function equipments()
        {
            return $this->hasMany(Equipment::class);
        }

        public function subscriptions()
        {
            return $this->hasMany(subscription::class);
        }
  
     
}

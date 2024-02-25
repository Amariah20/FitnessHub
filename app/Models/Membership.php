<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gym;

class Membership extends Model
{
    protected $primaryKey = 'membership_id'; //added when trying to edit gym info
      //rela between gym and membership
      public function gym()
      {
          return $this->belongsTo(Gym::class, 'gym_id', 'Gym_id');
      }

      protected $fillable = [
        'name',
        'price',
        'description',
        'membership_type',
        'gym_id',
      ];
}

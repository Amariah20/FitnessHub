<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gym;

class Classes extends Model
{
    //rela between gym and class. a class belongs to a gym
    public function gym()
    {
        return $this->belongsTo(Gym::class, 'gym_id');
    }
}



<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gym;

class Classes extends Model
{

    
    protected $primaryKey = 'Class_id'; //added when trying to edit class info
    //rela between gym and class. a class belongs to a gym
    public function gym()
    {
        return $this->belongsTo(Gym::class, 'gym_id');
    }
}



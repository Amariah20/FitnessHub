<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gym;

class Offerings extends Model
{
    protected $primaryKey = 'offerings_id'; //added when trying to edit gym info
    //rela between gym and offering
    public function gym()
    {
        return $this->belongsTo(Gym::class, 'gym_id');
    }
}

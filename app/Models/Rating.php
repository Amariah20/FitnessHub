<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gym;
use App\Models\User;

class Rating extends Model
{
    use HasFactory;

    protected $primaryKey = 'rating_id'; //added when trying to update ratings status

    public function gym(){
        return $this->belongsTo(Gym::class, 'gym_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}


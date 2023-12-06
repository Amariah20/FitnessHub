<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gym;

class subscription extends Model
{
    public function gym()
      {
          return $this->belongsTo(Gym::class, 'gym_id');
      }
}

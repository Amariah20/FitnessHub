<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gym;

class Images extends Model
{
   protected $table= 'images';
   protected $fillable =[
   'logo',
   'banner',
   'extra_image', ];

   public function gym()
   {
       return $this->belongsTo(Gym::class);
   }

}

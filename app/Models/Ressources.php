<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressources extends Model
{
    protected $fillable = [
        'Rubrique','Autre','user_id','nature_id','supprimer',
      ];
  
      public function nature(){
          return $this->belongsTo(Natures::class);
      }
}

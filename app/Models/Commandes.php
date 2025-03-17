<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commandes extends Model
{
    protected $fillable = [ 'Reference','Montant','Date','fournisseur_id','Etat','user_id' ];

    public function fournisseur(){
        return $this->belongsTo(Fournisseurs::class);
    }
      public function user(){
        return $this->belongsTo(User::class);
    }
}

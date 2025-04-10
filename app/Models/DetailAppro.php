<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAppro extends Model
{
    protected $fillable = [ 'Reference','NombreSac','approvisionnement_id','produit_id','user_id' ];

    public function approvisionnement(){
        return $this->belongsTo(Approvisionnement::class);
    }
    public function produit(){
        return $this->belongsTo(Produits::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}

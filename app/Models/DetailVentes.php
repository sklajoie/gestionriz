<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailVentes extends Model
{
    protected $fillable = [ 'Reference','MontantVente','QteVente','PrixVente','vente_id','produit_id' ];

    public function produit(){
        return $this->belongsTo(Produits::class);
    }
    public function vente(){
        return $this->belongsTo(Ventes::class);
    }
}

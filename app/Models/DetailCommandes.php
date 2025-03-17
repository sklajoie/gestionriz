<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCommandes extends Model
{
    protected $fillable = [ 'Reference','Qte','commande_id','produit_id','user_id','prixachat' ];

    public function commande(){
        return $this->belongsTo(Commandes::class);
    }
    public function produit(){
        return $this->belongsTo(Produits::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}

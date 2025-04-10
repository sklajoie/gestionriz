<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GestionCaisse extends Model
{
    protected $fillable = [
        'TypeBeneficier','Beneficiaire','TypeMouvement','Montant','modePaiement','supprimer',
        'Numero','Decharche','Date','Detail','user_id','ressource_id','membre_id','AutreDoc',
    ];

    public function ressource(){
        return $this->belongsTo(Ressources::class);
    }
    public function membre(){
        return $this->belongsTo(User::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}

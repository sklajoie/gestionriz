<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventes extends Model
{
    protected $fillable = [ 'Reference','Montant','Avance','Solde','Etat','user_id',
    'Client','Contact','Tht','Remise','Tva' ];
}

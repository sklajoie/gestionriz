<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseurs extends Model
{
    protected $fillable = [ 'Nom','Contact','Address','Ville','Compte','user_id' ];
}

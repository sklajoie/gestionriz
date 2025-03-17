<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class connexionusers extends Model
{
    protected $fillable = [ 'connexion_outcome','connexion_date','connexion_ip','user_id' ];
}

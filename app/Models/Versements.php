<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Versements extends Model
{
    protected $fillable = [ 'Reference','Montant','Moyen','user_id' ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approvisionnement extends Model
{
    protected $fillable = [ 'Reference','NbrTotalSac','qteTotalkg','Etat','user_id','Refcmmd', ];
}

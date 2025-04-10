<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Natures extends Model
{
    protected $fillable = [
        'Nature','Type','user_id','supprimer',
    ];
}

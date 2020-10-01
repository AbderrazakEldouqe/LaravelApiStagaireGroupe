<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stagiaire extends Model
{
    use HasFactory;

    protected $hidden=['id'];

    public function Groupe(){
        return $this->belongsTo(Groupe::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;

    protected $hidden=['id'];

    public function Stagiaires()
    {
        return $this->hasMany(Stagiaire::class);
    }
}

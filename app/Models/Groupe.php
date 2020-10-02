<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Groupe extends Model
{
    use HasFactory;

    protected $hidden=['id'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->groupeId = Str::random('30');
        });
    }

    public function Stagiaires()
    {
        return $this->hasMany(Stagiaire::class);
    }
}

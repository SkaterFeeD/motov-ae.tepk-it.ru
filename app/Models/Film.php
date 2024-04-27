<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'duration', 'description', 'year', 'country', 'director', 'genre_id'];

    public function session(){
        return $this->hasMany(Session::class);
    }
    public function genre() {
        return $this->belongsTo(Genre::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;

    protected $fillable = ['row_quantity', 'place_quantity', 'type_hall_id'];

    public function session(){
        return $this->hasMany(Session::class);
    }
    public function typehall(){
        return $this->belongsTo(Type_hall::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_hall extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function hall(){
        return $this->hasMany(Hall::class);
    }
}

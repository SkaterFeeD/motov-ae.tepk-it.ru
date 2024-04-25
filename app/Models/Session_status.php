<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session_status extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function session(){
        return $this->hasMany(Session::class);
    }
}

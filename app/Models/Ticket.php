<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['session_time', 'price', 'seat_number', 'user_id', 'session_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function session(){
        return $this->belongsTo(Session::class);
    }
}

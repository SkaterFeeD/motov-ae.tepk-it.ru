<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = ['time_start', 'time_end', 'session_status_id', 'film_id', 'hall_id'];

    public function hall(){
        return $this->belongsTo(Hall::class);
    }
    public function session(){
        return $this->belongsTo(Session_status::class);
    }
    public function film(){
        return $this->belongsTo(Film::class);
    }
    public function ticket(){
        return $this->hasMany(Ticket::class);
    }
}

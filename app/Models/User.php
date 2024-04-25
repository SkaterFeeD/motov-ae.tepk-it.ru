<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname', 'patronymic', 'phone_number', 'birth', 'login', 'password', 'email', 'api_token', 'role_id'];

    // Прячем
    protected $hidden = ['password'];

    public function role() {
        return $this->belongsTo(Role::class);
    }
    public function ticket(){
        return $this->hasMany(Ticket::class);
    }
    public function order(){
        return $this->hasMany(Order::class);
    }
    // belongsTo - цепляемся
    // hasMany - присасывается
}

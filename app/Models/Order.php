<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['datatime', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function orderlist(){
        return $this->hasMany(Order_list::class);
    }
}

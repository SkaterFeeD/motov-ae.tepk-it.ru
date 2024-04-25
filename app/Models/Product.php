<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['mass', 'description', 'name', 'price', 'photo'];

    public function cart(){
        return $this->hasMany(Cart::class);
    }
    public function order_list(){
        return $this->hasMany(Order_list::class);
    }
}

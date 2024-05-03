<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['mass', 'name', 'price', 'photo'];

    public function cart(){
        return $this->hasMany(Cart::class);
    }
    public function orderlist(){
        return $this->hasMany(Order_list::class);
    }
}

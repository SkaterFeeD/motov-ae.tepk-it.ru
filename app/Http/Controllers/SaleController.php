<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function getSalesByPeriod(Request $request)
    {
        $period = $request->input('period'); // 'day', 'month', 'year'
        $date = now();

        if ($period == 'month') {
            $date->startOfMonth();
        } elseif ($period == 'year') {
            $date->startOfYear();
        } // else default to 'day'

        $sales = Cart::select('products.name as product', 'carts.quantity as soldCount', 'products.price as price', DB::raw('carts.quantity * products.price as total'))
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->join('orders', 'carts.user_id', '=', 'orders.user_id')
            ->whereDate('orders.datetime', '>=', $date->toDateString())
            ->get();

        return response()->json($sales);
    }

    public function getSalesByPeriodAndProduct(Request $request, $productId)
    {
        $period = $request->input('period'); // 'day', 'month', 'year'
        $date = now();

        if ($period == 'month') {
            $date->startOfMonth();
        } elseif ($period == 'year') {
            $date->startOfYear();
        } // else default to 'day'

        $sales = Cart::select('products.name as product', DB::raw('SUM(carts.quantity) as soldCount'), 'products.price as price', DB::raw('SUM(carts.quantity * products.price) as total'))
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->join('orders', 'carts.user_id', '=', 'orders.user_id')
            ->whereDate('orders.datetime', '>=', $date->toDateString())
            ->where('products.id', $productId)
            ->groupBy('products.name', 'products.price')
            ->get();

        return response()->json($sales);
    }
}

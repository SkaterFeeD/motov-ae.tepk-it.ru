<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartCreateRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_list;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Создание корзины
    public function create(CartCreateRequest $request) {
        $user = Auth::user();
        $order = Order::create();
        $cart = Cart::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'datetime' => $order->datetime,
        ]);

        return response()->json(new CartResource($cart))->setStatusCode(201);
    }

    // Просмотр всех корзин
    public function index() {
        $carts = Cart::all();
        return response()->json(CartResource::collection($carts))->setStatusCode(200, 'Успешно');
    }

    // Просмотр всех товаров в корзине по пользователю
    public function showByUser() {
        $carts = Cart::where('user_id', Auth::user()->id)->get();

        return response()->json(CartResource::collection($carts))->setStatusCode(200, 'Успешно');
    }

    // Просмотр корзины
    public function show($id) {
        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json('Корзина не найдена')->setStatusCode(404, 'Not found');
        }

        return response()->json(new CartResource($cart))->setStatusCode(200, 'Успешно');
    }

    // Редактирование корзины
    public function update(CartUpdateRequest $request) {
        $cart = Cart::where('user_id', Auth::user()->id)->get();

        if (!$cart) {
            return response()->json('Корзина не найдена')->setStatusCode(404, 'Not found');
        }

        $cart->update($request->all());
        return response()->json(new CartResource($cart))->setStatusCode(200, 'Изменено');
    }

    // Удаление корзины
    public function destroy($id) {
        $cart = Cart::where('user_id', Auth::user()->id)->destroy();

        if (!$cart) {
            return response()->json('Корзина не найдена')->setStatusCode(404, 'Not found');
        }

        Cart::destroy($id);
        return response()->json('Корзина удалена')->setStatusCode(200, 'Удалено');
    }
}

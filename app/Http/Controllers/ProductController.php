<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products)->setStatusCode(200);
    }

    public function show($id)
    {
        $products = Product::find($id);
        if (!$products) {
            throw new ApiException(404, 'Продукт не найден');
        }
        return response()->json($products)->setStatusCode(200);
    }

    public function create(ProductCreateRequest $request)
    {
        $product = new Product($request->all());
        $product->save();

        if ($request->hasFile('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileName = 'products/' . $product->id . '.' . $extension;
            $request->file('photo')->storeAs('public/', $fileName);
            $product->photo = $fileName;
            $product->save();
        }
        return response()->json($product)->setStatusCode(201);
    }


    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            throw new ApiException(404, 'Фильм не найден');
        }
        // Обновляем атрибуты фильма с данными из запроса, исключая поле 'photo'
        $product->update($request->except('photo'));

        // Проверяем наличие нового файла фотографии в запросе
        if ($request->hasFile('photo')) {
            // Получаем расширение нового файла
            $extension = $request->file('photo')->getClientOriginalExtension();
            // Генерируем имя нового файла
            $fileName = 'products/' . $product->id . '.' . $extension;
            // Удаляем предыдущий файл фотографии, если он существует
            if ($product->photo) {
                Storage::delete('public/' . $product->photo);
            }
            // Сохраняем новый файл
            $request->file('photo')->storeAs('public', $fileName);
            // Обновляем ссылку на фотографию в модели фильма
            $product->photo = $fileName;
        }
        $product->save();
        // Возвращаем обновленный фильм
        return response()->json($product)->setStatusCode(200);
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            throw new ApiException(404, 'Продукт не найден');
        }
        // Удаляем фотографию продукта, если она существует
        if ($product->photo) {
            Storage::delete('public/' . $product->photo);
        }
        // Удаляем продукт из базы данных
        $product->delete();
        // Возвращаем успешный ответ
        return response()->json(['message' => 'Продукт успешно удален'])->setStatusCode(200);
    }
}

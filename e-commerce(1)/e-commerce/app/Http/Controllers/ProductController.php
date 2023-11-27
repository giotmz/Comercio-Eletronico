<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\{
    JsonResponse, Request
};
use App\Models\Product;

class ProductController extends Controller
{
    public function index() : JsonResponse
    {
        return response()->json(Product::all());
    }

    public function store(Request $request) : JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required',
            'stock' => 'required|integer',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors(), 400);

        Product::create($request->all());

        return response()->json([
            'message' => 'Produto cadastrado com sucesso',
            'status' => true
        ], 201);
    }

    public function show(int $id) : JsonResponse
    {
        return response()->json(Product::findOrFail($id));
    }

    public function update(Request $request, int $id) : JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string',
            'description' => 'nullable|string',
            'price' => 'nullable',
            'stock' => 'nullable|integer',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors(), 400);

        $product = Product::findOrFail($id);

        $product->update($request->all());

        return response()->json($product);
    }

    public function destroy(int $id) : JsonResponse
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return response()->json([
            'message' => 'Produto deletado com sucesso',
            'status' => true
        ]);
    }
}

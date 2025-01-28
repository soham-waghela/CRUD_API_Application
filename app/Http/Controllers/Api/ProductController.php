<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        if($products->count()>0 )
        {
            return ProductResource::collection($products);
        }
        else
        {
            return response()->json(['message'=>'No record available']);
        }

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'name'=> 'required',
            'description' => 'required',
            'price'=> 'required|integer',
        ]);
        
        if($validator->fails())
        {
            return response()->json([
                'message'=> 'All fields are Required',
                'error'=> $validator->messages()
            ],422);
        }

        $product=Product::create([
            'name'=> $request->name,
            'description'=> $request->description,
            'price'=> $request->price,

        ]);

        return response()->json([
            'message'=>'Product Created successfully',
            'data'=> new ProductResource($product)
        ],200);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);       
    }

    public function update(Product $product, Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'name'=> 'required',
            'description' => 'required',
            'price'=> 'required|integer',
        ]);
        
        if($validator->fails())
        {
            return response()->json([
                'message'=> 'All fields are Required',
                'error'=> $validator->messages()
            ],422);
        }

        $product->update([
            'name'=> $request->name,
            'description'=> $request->description,
            'price'=> $request->price,

        ]);

        return response()->json([
            'message'=>'Product Updated successfully',
            'data'=> new ProductResource($product)
        ],200);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message'=> 'Product Deleted Successfully',
            'data'=> new ProductResource($product)
        ],200);
    }

}    

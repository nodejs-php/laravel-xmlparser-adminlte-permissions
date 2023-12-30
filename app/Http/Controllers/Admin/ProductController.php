<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Validator;
use DataTables;
class ProductController extends Controller
{
   
    public function index()
    {
        $products = Product::with('images')->get();
        return response()->json($products);
    }

 public function getData()
    {
        $products = Product::select(['id', 'product_name', 'product_price', 'product_description','product_image'])->get();

        return DataTables::of($products)
            ->addColumn('action', function($product) {
                // Add any action buttons you might need in the DataTable
                return '<button class="btn btn-info">View</button>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'product_description' => 'required',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        
        $product = Product::create([
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description,
           
        ]);

        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('product_images', $imageName, 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imageName,
                ]);
            }
        }

        return response()->json(['message' => 'Product created successfully'], 201);
    }

  
    public function update(Request $request, $id)
    {
      
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'product_description' => 'required',
         
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $product = Product::findOrFail($id);
        $product->update([
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description,
   
        ]);

        return response()->json(['message' => 'Product updated successfully'], 200);
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
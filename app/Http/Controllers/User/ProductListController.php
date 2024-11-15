<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Inertia\Inertia;

class ProductListController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'brand', 'product_images');
        $filterProducts = $products->filtered()->paginate(9)->withQueryString();
        $categories = Category::get();
        $brands = Brand::get();

        return Inertia::render('User/ProductList', [
            'categories' => $categories,
            'brands' => $brands,
            'products' => ProductResource::collection($filterProducts)
        ]);
    }

    public function detail(Product $product)
    {
        $details = Product::where('id', $product->id)->with('category', 'brand', 'product_images')->get();
        return Inertia::render('User/DetailProduct', [
            'details' => $details,
        ]);
    }
}

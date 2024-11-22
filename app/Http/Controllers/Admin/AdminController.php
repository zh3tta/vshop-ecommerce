<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        $sales = Order::count();
        $products = Product::count();
        $brands = Brand::count();
        $categories = Category::count();
        return Inertia::render('Admin/Dashboard', [
            'sales' => $sales,
            'products' => $products,
            'brands' => $brands,
            'categories' => $categories,
        ]);
    }
}

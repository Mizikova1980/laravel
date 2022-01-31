<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{

    public function category(Category $category)
    {

                return view('categories', compact('category'));
    }

    public function getProducts (Category $category)
    {
        $products = $category->products;
        $basketProducts = session('products');
        return $products->transform(function ($product) use ($basketProducts) {
            $product->quantity = $basketProducts[$product->id] ?? 0;
            return $product;
        });
    }
}

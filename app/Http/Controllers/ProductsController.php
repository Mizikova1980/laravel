<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductsController extends Controller
{

   public function index( product $product)
    {

                return view('products', compact('product'));
    }
}

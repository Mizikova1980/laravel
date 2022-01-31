<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $title='Список категорий';
        $categories=Category::get();
        $data=[
            'categories'=>$categories,
            'title'=>$title,
           
        ];

        return view('home', $data);
    }
}

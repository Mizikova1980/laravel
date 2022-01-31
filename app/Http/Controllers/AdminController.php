<?php

namespace App\Http\Controllers;

use App\Jobs\ExportCategories;
use App\Jobs\ExportProducts;
use App\Jobs\ImportCategories;
use App\Jobs\ImportProducts;
use Illuminate\Foundation\Auth\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function index ()
    {
        $users = User::get();
        return view('admin');
    }


    public function users ()
    {
        $users = User::get();
        return view('/users', compact('users'));
    }

    public function enterAsUser ($userId)
    {
        Auth::loginUsingId($userId);
        return redirect()->route('home');
        //return view('enterAsUser');
    }


    public function createCategory (Request $request)
    {
        $request->validate([
            'picture' => 'mimes:png,jpg',
            'name'=>'required',

        ]);

        $category= new Category();

        $file=$request->file('picture');
        $input=$request->all();
        if($file){
            $ext=$file->getClientOriginalExtension();
            $fileName=time() . rand(100, 999) . '.' . $ext;
            $file->storeAs('public/img/categories', $fileName);
            $category->picture=$fileName;
        }


        $category->name = $input['name'];
        $category->description = $input['description'];
        $category->save();
        return back();
    }



    public function createProduct (Request $request)
    {
        $request->validate([
            'picture' => 'mimes:png,jpg',
            'name'=>'required',

        ]);

        $product= new Product();

        $file=$request->file('picture');
        $input=$request->all();
        if($file){
            $ext=$file->getClientOriginalExtension();
            $fileName=time() . rand(100, 999) . '.' . $ext;
            $file->storeAs('public/img/products', $fileName);
            $product->picture=$fileName;
        }


        $product->category_id=$input['category_id'];
        $product->name = $input['name'];
        $product->description = $input['description'];
        $product->price=$input['price'];
        $product->save();
        return back();
    }

    public function exportCategories ()
    {
            $title='Список категорий';
            $categories=Category::get();
            $data=[
                'categories'=>$categories,
                'title'=>$title,
                'showTitle'=>true,
            ];
        return view ('exportCategories', $data);
    }


    public function exportProducts(){
         $products=Product::get();
        $data=[
            'products'=>$products,
        ];

        return view('exportProducts', $data);
    }


    public function exportCategoriesJob ()
    {
        ExportCategories::dispatch();
        session()->flash('startExportCategories');
        return back();
    }

    public function exportProductsJob ()
    {
        ExportProducts::dispatch();
        session()->flash('startExportProducts');
        return back();
    }

    public function importCategoriesJob ()
    {
        ImportCategories::dispatch();
        session()->flash('startImportCategories');
        return back();
    }

    public function importProductsJob ()
    {
        ImportProducts::dispatch();
        session()->flash('startImportProducts');
        return back();
    }

    public function saveFileCategories (Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',

        ]);

        $file=$request->file('file');
        $input=$request->all();
        if($file){
            $fileName='categories.csv';
            $file->storeAs('public/', $fileName);

        }
        return back();
    }


    public function saveFileProducts (Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',

        ]);

        $file=$request->file('file');
        $input=$request->all();
        if($file){
            $fileName='products.csv';
            $file->storeAs('public/', $fileName);

        }
        return back();
    }
}

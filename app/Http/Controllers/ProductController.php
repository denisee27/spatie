<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $data = Product::all();
        $categories = Category::all();
        $parse = [
            'datas' => $data,
            'categories' => $categories,
        ];

        return view('product',$parse);
    }
}

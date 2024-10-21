<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Role;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $data = Role::whereNotBetween('id',[11,15])->get();
        $data = Role::whereBetween('id',[11,15])->get();
        $data = Role::where('id','>',10)->orderBy('created_at')->get();
        //desc = descending = terbesar hingga kecil
        //asc = ascending = kecil hingga besar

        $parse = [
            'roles' => $data,
        ];

        return view('product',$parse);
    }
}

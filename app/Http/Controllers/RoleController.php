<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $data = Role::get();
        $parse =[
            'datas' => $data
        ];
        return view('role',$parse);
    }
}

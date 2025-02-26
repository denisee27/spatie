<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{
    use HasFactory, Notifiable;
    use HasRoles;

    public function index(){
        $data = User::get();
        $role = Role::get();
        $parse =[
            'datas' => $data,
            'roles' => $role,
        ];
        return view('user',$parse);
    }

    public function create(Request $request){
        $store = new User();
        $store->name = $request->name;
        $store->email = $request->email;
        $store->password = Hash::make($request->password);
        $store->role = $request->role;
        $store->save();

        // foreach($request->categories as $category){
        //     $addres = new CustomerAddress();
        //     $addres->customer_id = $store->id;
        //     $addres->name = $category;
        //     $address->save();
        // }

        $last = User::latest('id')->first();
        $last->assignRole($request->role);

        Alert::success('Input Sukses', $request->name . ' berhasil ditambahkan');
        return back();
    }

}

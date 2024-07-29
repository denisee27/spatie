<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
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
            'roles' => $role
        ];
        return view('user',$parse);
    }

}

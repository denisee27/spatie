<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index(){
        if (Auth::check()) {
            return redirect('products');
        }
        return view('login');
    }

    public function actionLogin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) {
            return redirect('products');
        }else{
            Alert::error('Failed Login','Login Gagal!');
            return back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}

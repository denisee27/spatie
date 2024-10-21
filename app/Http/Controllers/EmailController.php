<?php

namespace App\Http\Controllers;

use App\Mail\SendingEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Email;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EmailController extends Controller
{
    public function index(){
        $data = Email::get();
        $parse = [
            'datas' => $data
        ];
        return view('email',$parse);
    }

    public function create(Request $request){
        try{
            $details = [
                'name' => $request->name,
                'subject' => $request->subject,
                'message' => $request->message
            ];
                
            Mail::to($request->to)->send(new SendingEmail($details));
            Alert::success('Email Berhasil Terkirim');
            return back();
        }
        catch(\Exception $e){
            Alert::error('Email Gagal Terkirim',$e->getMessage());
            return back();
        }
    }
}

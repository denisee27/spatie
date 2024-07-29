<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PermissionGroupController extends Controller
{
    public function index(){
        $data = PermissionGroup::get();
        $parse = [
            'datas' => $data
        ];
        return view('permission_group',$parse);
    }

    public function create(Request $request){
        $item = new PermissionGroup();
        $item->name = $request->name;
        $item->save();
        Alert::success('Submit Berhasil','Data berhasil disimpan');
        return back();
    }
}

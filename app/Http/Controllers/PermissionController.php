<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PermissionController extends Controller
{
    public function index(){
        // $data = Permission::get();
        $data = Permission::whereHas('group',function($q){
            $q->orderBy('name','asc');
        })->get();
        $group = PermissionGroup::get();
        $parse = [
            'datas' => $data,
            'groups' => $group
        ];
        return view('permission',$parse);
    }

    public function create(Request $request){
        $item = new Permission();
        $item->name = $request->name;
        $item->group_id = $request->group_id;
        $item->guard_name = 'web';
        $item->save();
        Alert::success('Submit Berhasil','Data berhasil disimpan');
        return back();
    }
}
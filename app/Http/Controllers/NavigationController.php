<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class NavigationController extends Controller
{
    public function index(){
        $data = Navigation::get();
        $parse =[
            'datas' => $data
        ];  
        return view('menu',$parse);
    }

    public function create(Request $request){
        $item = new Navigation();
        $item->parent_id = (isset($request->parent_id) && is_int($request->parent_id) ? $request->parent_id : null);
        $item->name = $request->name;
        $item->icon = $request->icon ?? null;
        $item->link = (isset($request->link) ? $request->link : null);
        $item->position = (isset($request->position) ? $request->position : null);
        if (isset($request->action)) {
            $action = str_replace(' ', '', $request->action);
            $action = explode(',', $action);
            $item->action = $action;
        }
        $item->status = (isset($request->status) ? (int)$request->status : 0);
        $item->save();
        Alert::success('Submit Berhasil','Data berhasil disimpan');
        return back();
    }
}

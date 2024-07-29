<?php

namespace App\Http\Controllers;

use App\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Redis;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    public function index(){
        $data = Role::get();
        $parse =[
            'datas' => $data
        ];
        return view('role',$parse);
    }

    public function create(){
        $permission = ModelsPermission ::get();
        $parse = [
            'permission' => $permission,
        ];
        return view('role_create',$parse);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        DB::beginTransaction();
        try{

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role1 = Role::create(['name' => $request->name,'guard_name' => 'web']);
        $permission = Permission::get();
        foreach ($permission as $p) {
            $nama = $p->name;
            if ($request->has($nama)) {
                $role1->givePermissionTo($request->$nama);
            }
        }
        DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        Alert::success('Konfirmasi input data', 'Data berhasil di input');
        return back();

    }
}

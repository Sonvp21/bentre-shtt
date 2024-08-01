<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function create()
    {
        return view('admin.permissions.create');
    }
    public function store(Request $request)
    {
       $permission = Permission::create([
           'module'=>$request->module_parent,
           'action'=>$request->module_parent,
           'parent_id'=> 0
        ]);
       foreach ($request->module_childrent as $value){
           Permission::create([
               'module'=>$value,
               'action'=>$value,
               'parent_id'=> $permission ->id,
               'key_code' =>  $request ->module_parent . '_' . $value
           ]);
       }
       return redirect()->route('admin.permissions.create')->with('success', 'Thêm thành công');
    }
}

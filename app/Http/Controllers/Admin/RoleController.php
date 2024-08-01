<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller
{
    protected $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }
    
    public function index(): View
    {
        $roles = Role::orderBy('updated_at', 'desc')->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function create(): View
    {
        $permissionsParent = $this->permission->where('parent_id', 0)->get();
        return view('admin.roles.create', compact('permissionsParent'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'display_name' => 'nullable|string',
            'permission_id' => 'array', // Đảm bảo permission_id là một mảng
            'permission_id.*' => 'exists:permissions,id', // Kiểm tra từng phần tử trong mảng permission_id có tồn tại trong bảng permissions
        ]);
    
        $role = Role::create($request->only(['name', 'display_name']));
    
        // Thêm các quyền vào vai trò thông qua bảng trung gian
        $role->permissions()->attach($request->permission_id);
    
        return redirect()->route('admin.roles.index')->with('success', 'Vai trò đã được tạo thành công.');
    }
    

    public function edit(Role $role)
    {
        $permissionsParent = $this->permission->where('parent_id', 0)->get();
        return view('admin.roles.edit', compact('role', 'permissionsParent'));
    }
    
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'display_name' => 'nullable|string',
            'permission_id' => 'array', // Đảm bảo permission_id là một mảng
            'permission_id.*' => 'exists:permissions,id', // Kiểm tra từng phần tử trong mảng permission_id có tồn tại trong bảng permissions
        ]);
    
        $role->update($request->only(['name', 'display_name']));
    
        // Cập nhật lại quyền cho vai trò
        $role->permissions()->sync($request->permission_id);
    
        return redirect()->route('admin.roles.index')->with('success', 'Vai trò đã được cập nhật thành công.');
    }
    

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Vai trò đã được xóa thành công.');
    }
}

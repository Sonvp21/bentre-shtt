<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Admin\Commune;
use App\Models\Admin\District;
use App\Models\Admin\Role;
use App\Models\Admin\UserCategory;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserController extends Controller
{
    private $role;
    public function __construct(Role $role)
    {
        $this->role = $role;
    }
    public function index(): View
    {
        $users = User::with('roles')->orderBy('updated_at', 'desc')->get();
        return view('admin.users.index', compact('users')); // Trả về view với danh sách người dùng
    }

    public function create(): View
    {
        $districts = District::all();
        $communes = collect([]);
        $categories = UserCategory::all();
        $roles = $this->role->all();
        return view('admin.users.create', compact('districts', 'communes', 'categories', 'roles'));
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }
        $user = User::create($validatedData);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $user->addMedia($image->getRealPath())
                    ->usingFileName($image->getClientOriginalName())
                    ->usingName($image->getClientOriginalName())
                    ->toMediaCollection('user_images');
            }
        }
        $user->roles()->attach($request->role_id);
        return redirect()->route('admin.users.index')->with('success', 'tài khoản đã được tạo thành công.');
    }

    public function edit(User $user): View
    {
        $districts = District::all();
        $communes = Commune::where('district_id', $user->district_id)->get();

        $categories = UserCategory::all();
        $roles = $this->role->all();
        return view('admin.users.edit', compact('user', 'districts', 'communes', 'categories', 'roles'));
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $validatedData = $request->validated();
        $user->update($validatedData);
        $user->roles()->sync($request->role_id);

        // Handle password update if requested
        if ($request->filled('password')) {
            // Validate current password
            if (!Hash::check($request->input('current_password'), $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => 'Mật khẩu cũ không đúng',
                ]);
            }
    
            // Update password
            $user->password = Hash::make($request->input('password'));
            $user->save();
        }
        // Thêm ảnh mới từ request vào collection 'user_images'
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $user->addMedia($image)
                    ->toMediaCollection('user_images');
            }
        }
        return redirect()->route('admin.users.index')->with('success', 'Tài khoản đã được cập nhật thành công.');
    }

    // Phương thức trong UserController
    public function deleteMedia(Media $media)
    {
        $media->delete();
        return response()->json(['message' => 'Đã xóa ảnh thành công.']);
    }

    public function destroy(user $user): RedirectResponse
    {
        $user->clearMediaCollection('user_images');
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Xoá thành công.');
    }
}

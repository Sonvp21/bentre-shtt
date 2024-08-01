<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'district_id' => ['nullable', 'exists:districts,id'], // Kiểm tra district_id tồn tại trong bảng districts
            'commune_id' => ['nullable', 'exists:communes,id'], // Kiểm tra commune_id tồn tại trong bảng communes
            'full_name' => 'nullable',
            'phone' => 'nullable',
            'address' => 'nullable',
            'birthday' => 'nullable',
            'description' => 'nullable',
            'ip' => 'nullable',
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'category_id' => 1,
            'status' => 0,
            'district_id' => $request->district_id,
            'commune_id' => $request->commune_id,
            // Giá trị mặc định
            'email_verified_at' => now(), // Đánh dấu email đã xác minh ngay khi tạo mới user
        ]);
        
        
        
        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}

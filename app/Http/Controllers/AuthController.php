<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) 
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed' 
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'user', 
        ]);

        
        Auth::login($user);

        return redirect()->route('shop.index')->with('success', 'تم إنشاء الحساب بنجاح! أهلاً بك يا ' . $user->name);
    }
    public function login(Request $request) 
{
   
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        
        // . تأمين الجلسة (عشان نمنع الـ Session Fixation)
        //انه الهاكر يثبت الجلسه بالid بتاعك فدى بتقفل السسشن
        //
        $request->session()->regenerate();

        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.orders.index'); 
        }

        return redirect()->route('shop.index'); 
    }

    
    return back()->withErrors([
        'email' => 'خطأ في البريد الإلكتروني أو كلمة المرور.',
    ]);
}
public function logout(Request $request) 
{
    Auth::logout();

    $request->session()->invalidate(); // مسح البيانات من السيرفر
    $request->session()->regenerateToken(); // تغيير توكن الـ CSRF للأمان

    return redirect()->route('shop.index');
}

public function showLoginForm()
{
    return view('auth.login'); 
}

public function showRegisterForm()
{
    return view('auth.register'); 
}
}
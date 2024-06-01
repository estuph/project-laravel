<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function login_process(Request $request)
    {
        $messages = [
            'email.required' => 'Email Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
            'email.exists' => 'Email atau passsword Salah',
        ];

        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ], $messages);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials, $request->has('remember'))) {
            $user = Auth::user();
            if($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }elseif ($user->role == 'kasir') {
                return redirect()->route('kasir.dashboard');
            }
        } else {
            return redirect()->route('login')->withErrors(['email' => 'Email atau Password Salah']);
        }
    }


    public function register()
    {
        return view('auth.register');
    }

    public function register_process(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create($data);

        return redirect()->route('login')->with('sucess', 'Berhasil Membuat Akun');
        
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}

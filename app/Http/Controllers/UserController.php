<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function showLogin()
    {
        return view('backend.user.auth-login-social');
    }

    public function showRegister()
    {
        return view('backend.user.auth-register-social');
    }

    public function checkLogin(LoginRequest $request)
    {
        $auth = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $rememberme = $request->rememberme == 'on';
        if (Auth::attempt($auth, $rememberme)) {
            $request->session()->regenerate();
            return redirect()->route('admin.index1');
        } else {
            Session::flash('error', 'Email or password is incorrect');
            return redirect()->route('admin.showLogin');
        }
    }

    public function checkRegister(RegisterRequest $request)
    {
        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
        Session::flash('success', 'Registered Successfully.');
        return redirect()->route('admin.showLogin');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.showLogin');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\AdminLoginRequest;


use app\Models\Admin;

class LoginController extends Controller
{
    public function showLoginForm()
    {

        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard')
                ->with('message', 'You are already logged in!');
        }


        return view('admin.auth.login');
    }

    public function login(AdminLoginRequest $request)
    {


        // Attempt to authenticate the admin
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        // If authentication fails, return back with an error
        return back()->withErrors([
            'email' => 'Invalid credentials. Please try again.',
        ])->withInput($request->only('email'));
    }
}

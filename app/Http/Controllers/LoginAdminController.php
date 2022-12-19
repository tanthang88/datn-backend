<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\LoginAdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginAdminController extends Controller
{

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return view('pages.login.index');
    }

    /**
     * Login
     *
     * @param  LoginAdminRequest $request
     * @return void
     */
    public function Login(LoginAdminRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/');
        } else {
            Session::flash('message', 'Email hoặc mật khẩu không đúng');
            return back();
        }
    }

    /**
     * logout
     *
     * @param  Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        Auth::guard('staff')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

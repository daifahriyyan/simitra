<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function register(){
        return view('auth.register', [
            'title' => 'Registrasi'
        ]);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('home');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function store(){
        $validator = request()->validate([
            'username' => 'required',
            'nama_perusahaan' => 'required',
            'alamat_perusahaan' => 'required',
            'telepon_perusahaan' => 'required',
            'email' => 'required',
            'nama_pic' => 'required',
            'telepon_pic' => 'required',
            'password' => 'required',
            'reenter_password' => 'required|same:password',
        ]);
        
        DataUser::create($validator);

        return redirect(route('Login'));
    }
    
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
     
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
}

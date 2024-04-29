<?php

namespace App\Http\Controllers;

use App\Models\DataCustomer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function register()
    {
        return view('auth.register', [
            'title' => 'Registrasi'
        ]);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('home');
        }

        return back()->with('error', 'password atau username anda salah');
    }
    public function store()
    {
        $id_customer = User::get()->count();
        $id_customer = $id_customer + 1;
        request()->id_customer = "C00$id_customer";
        $validator = request()->validate([
            'id_customer' => 'required',
            'nama_customer' => 'required',
            'alamat_customer' => 'required',
            'telepon_customer' => 'required',
            'email_customer' => 'required',
            'pic' => 'required',
            'phone_pic' => 'required',
        ]);
        $user = request()->validate([
            'username' => 'required',
            'password' => 'required',
            'reenter_password' => 'required|same:password',
            'id_customer' => 'required'
        ]);

        DataCustomer::create($validator);
        User::create($user);

        return redirect(route('Login'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function profile()
    {
        return view('auth.profile');
    }

    public function update()
    {
        request()->id_customer = Auth::user()->id_customer;
        DataCustomer::where('id', Auth::user()->id)->update([
            'id_customer' => request()->id_customer,
            'nama_customer' => request()->nama_customer,
            'alamat_customer' => request()->alamat_customer,
            'telepon_customer' => request()->telepon_customer,
            'email_customer' => request()->email_customer,
            'pic' => request()->pic,
            'phone_pic' => request()->phone_pic,
        ]);
        User::where('id', Auth::user()->id)->update([
            'username' => request()->username,
            'id_customer' => request()->id_customer
        ]);

        return redirect()->route('Profile');
    }
}

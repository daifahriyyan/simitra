<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use App\Models\DataCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        return view('customer-side.auth.login', [
            'title' => 'Login'
        ]);
    }

    public function register()
    {
        return view('customer-side.auth.register', [
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

    public function logoutPegawai(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('Login Pegawai');
    }

    public function profile()
    {
        if (Auth::user()->posisi == null) {
            return view('customer-side.auth.profile');
        } else {
          return redirect()->route('Dashboard');
        }
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

    public function daftarUser()
    {
        if (Auth::user()->posisi == null) {
          return redirect()->route('Home');

        } else if (Auth::user()->posisi == 'Direktur') {
            return view('customer-side.auth.account', [
                'dataUsers' => User::where('posisi', '!=', null)->get()
            ]);

        } else {
          return redirect()->route('Dashboard');
        }
    }
    public function tambahUser()
    {
        User::create([
            'username' => request()->username,
            'nama_lengkap' => request()->nama_lengkap,
            'posisi' => request()->posisi,
            'email' => request()->email,
            'pass' => request()->password,
            'password' => Hash::make(request()->password),
        ]);

        return redirect()->route('Daftar User');
    }
    public function updateUser(string $id)
    {
        User::where('id', $id)->update([
            'username' => request()->username,
            'nama_lengkap' => request()->nama_lengkap,
            'posisi' => request()->posisi,
            'email' => request()->email,
            'pass' => request()->password,
            'password' => Hash::make(request()->password),
        ]);

        return redirect()->route('Daftar User');
    }
    public function deleteUser(string $id)
    {
        try {
            User::where('id', $id)->delete();
            // Validate the value...
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('Daftar User');
    }

    public function loginPegawai()
    {
        return view('auth.login');
    }

    public function authenticatePegawai(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('Dashboard');
        }

        return back()->with('error', 'password atau email anda salah');
    }

    public function registerPegawai()
    {
        return view('auth.register', [
            'title' => 'Registrasi'
        ]);
    }

    public function storePegawai()
    {
        $this->validate(request(), [
            'username' => 'required',
            'nama_lengkap' => 'required',
            'posisi' => 'required',
            'email' => 'required',
            'password' => 'required',
            'reenter_password' => 'required|same:password',
        ]);

        User::create([
            'username' => request()->username,
            'nama_lengkap' => request()->nama_lengkap,
            'posisi' => request()->posisi,
            'email' => request()->email,
            'pass' => request()->password,
            'password' => Hash::make(request()->password),
        ]);

        return redirect()->route('Login Pegawai');
    }

    public function profilePegawai()
    {
        if(Auth::user()->posisi != null){
            return view('auth.profile');
        } else {
            return redirect()->route('Home');
        }
    }

    public function updatePegawai()
    {
        $user = request()->validate([
            'foto' => 'required',
            'username' => 'required',
            'nama_lengkap' => 'required',
            'posisi' => 'required',
            'email' => 'required',
            'password' => 'required',
            'reenter_password' => 'required|same:password',
        ]);

        if (request()->hasFile('foto')) {
            $foto = request()->file("foto");
            $filefoto    = time() . "-" . $foto->getClientOriginalName();
            $uploadfoto   = "foto_pegawai/" . $filefoto;

            Storage::disk('public')->put($uploadfoto, file_get_contents($foto));
        }

        User::where('id', Auth::user()->id)->update([
            'foto' => 'storage/' . $uploadfoto,
            'username' => request()->username,
            'nama_lengkap' => request()->nama_lengkap,
            'posisi' => request()->posisi,
            'email' => request()->email,
            'pass' => request()->password,
            'password' => Hash::make(request()->password),
        ]);

        return redirect()->route('Profile Pegawai');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use function Flasher\Toastr\Prime\toastr;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function register(Request $req)
    {
        $validatedData = $req->validate([
            'nama' => 'required|max:255',
            'alamat' => 'required|max:255',
            'no_hp' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8',
        ]);
        if (User::where('email', $validatedData['email'])->exists()) {
            toastr('error', 'Email sudah terdaftar');
            return redirect()->back()->withInput();
        }

        User::create(attributes: [
            'nama' => $validatedData['nama'],
            'alamat' => $validatedData['alamat'],
            'no_hp' => $validatedData['no_hp'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'pasien',
        ]);

        toastr()->success('Berhasil Mendaftar');
        return redirect('auth/login')->withInput();
    }

    public function login(Request $req)
    {
        $credentials = $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();

            $user = Auth::user();

            toastr()->success('Selamat Datang' . ' ' . $user->nama);

            if ($user->role == 'dokter') {
                return redirect('/dokter/dashboard');
            } elseif ($user->role == 'pasien') {
                return redirect('/pasien/dashboard');
            } else {
                return abort(401, 'Unauthorized');
            }
        }

        toastr()->error('Email atau Password Salah');
        return redirect()->back()->withInput();
    }

    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();

        toastr()->success('Berhasil Logout');
        return redirect('auth/login')->withInput();
    }
}
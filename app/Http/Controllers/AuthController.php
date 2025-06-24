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
            'no_ktp' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8',
        ]);
        
        // Check if user already exists by email
        if (User::where('email', $validatedData['email'])->exists()) {
            toastr('error', 'Email sudah terdaftar');
            return redirect()->back()->withInput();
        }

        // Check if user already exists by KTP
        $existingUser = User::where('no_ktp', $validatedData['no_ktp'])->first();
        
        if ($existingUser) {
            // User exists, check if No RM is already assigned
            if (is_null($existingUser->no_rm)) {
                $noRm = $this->generateNoRM();
                $existingUser->update(['no_rm' => $noRm]);
                toastr()->success('No RM berhasil dibuat: ' . $noRm);
            } else {
                toastr()->info('Pasien sudah terdaftar dengan No RM: ' . $existingUser->no_rm);
            }
            
            return redirect('auth/login')->withInput();
        }

        // Generate No RM for new patient
        $noRm = $this->generateNoRM();

        User::create([
            'nama' => $validatedData['nama'],
            'alamat' => $validatedData['alamat'],
            'no_hp' => $validatedData['no_hp'],
            'no_ktp' => $validatedData['no_ktp'],
            'no_rm' => $noRm,
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'pasien',
        ]);

        toastr()->success('Berhasil Mendaftar dengan No RM: ' . $noRm);
        return redirect('auth/login')->withInput();
    }

    /**
     * Generate No RM with format: YYYY-MM-XXX
     * Where XXX is sequential number based on existing patients in current month
     */
    private function generateNoRM()
    {
        $currentYear = date('Y');
        $currentMonth = date('m');
        
        // Count existing patients in current month
        $existingCount = User::where('role', 'pasien')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->whereNotNull('no_rm')
            ->count();
        
        // Generate sequential number (start from 1)
        $sequentialNumber = str_pad($existingCount + 1, 3, '0', STR_PAD_LEFT);
        
        return $currentYear . $currentMonth . $sequentialNumber;
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
            } elseif ($user->role == 'admin') {
                return redirect('/admin/dashboard');
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
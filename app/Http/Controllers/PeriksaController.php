<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriksaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $periksas = Periksa::latest()->get()->where('id_pasien', $user->id);

        return view('pasien.periksa.index', compact('periksas'));
    }
    public function create()
    {
        $dokters = User::where('role', 'dokter')->latest()->get();

        return view('pasien.periksa.create', compact('dokters'));
    }

    public function store(Request $req)
    {
        $user = Auth::user();

        $req->validate([
            'id_dokter' => ['required', 'integer'],
        ]);

        Periksa::create([
            'id_pasien' => $user->id,
            'id_dokter' => $req->id_dokter,
        ]);

        return redirect('pasien/periksa')->with('success', 'Berhasil Membuat Jadwal Periksa');
    }
}
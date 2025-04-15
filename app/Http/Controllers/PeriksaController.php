<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use App\Models\User;
use Illuminate\Http\Request;

class PeriksaController extends Controller
{
    public function index()
    {
        $periksas = Periksa::latest()->get();

        return view('pasien.periksa.index', compact('periksas'));
    }
    public function create()
    {
        $pasiens = User::where('role', 'pasien')->latest()->get();
        $dokters = User::where('role', 'dokter')->latest()->get();

        return view('pasien.periksa.create', compact('dokters', 'pasiens'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'id_pasien' => ['required', 'integer'],
            'id_dokter' => ['required', 'integer'],
        ]);

        Periksa::create($req->all());

        return redirect('pasien/periksa')->with('success', 'Berhasil Meminta Pemeriksaan');
    }
}
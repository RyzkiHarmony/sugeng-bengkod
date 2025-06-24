<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;

class DaftarPoliController extends Controller
{
    public function index()
    {
        $no_rm = Auth::user()->no_rm;
        $dokters = User::with([
            'jadwal_periksa_dokter' => function ($query) {
                $query->where('status', true);
            },
            'poli'
        ])
            ->where('role', 'dokter')
            ->get();

        // Get patient's registration history
        $riwayatDaftar = DaftarPoli::with([
            'jadwal.dokter.poli',
            'periksa'
        ])
            ->where('id_pasien', Auth::user()->id)
            ->latest()
            ->get();

        return view('pasien.daftar-poli.index', compact('no_rm', 'dokters', 'riwayatDaftar'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_jadwal' => 'required|exists:jadwal_periksas,id',
            'keluhan' => 'required',
        ]);

        // Check if patient already registered for this schedule and hasn't been examined yet
        $existingRegistration = DaftarPoli::where('id_pasien', Auth::user()->id)
            ->where('id_jadwal', $validatedData['id_jadwal'])
            ->with('periksa')
            ->first();

        if ($existingRegistration) {
            // If there's no examination record yet, prevent duplicate registration
            if ($existingRegistration->periksa->isEmpty()) {
                return redirect()->back()
                    ->withErrors(['id_jadwal' => 'Anda sudah terdaftar pada jadwal ini dan belum diperiksa'])
                    ->withInput();
            }
            // If already examined, allow new registration (patient can register again after being examined)
        }

        $jumlahJanji = DaftarPoli::where('id_jadwal', $validatedData['id_jadwal'])->count();
        $noAntrian = $jumlahJanji + 1;

        DaftarPoli::create([
            'id_pasien' => Auth::user()->id,
            'id_jadwal' => $validatedData['id_jadwal'],
            'keluhan' => $request->keluhan,
            'no_antrian' => $noAntrian,
        ]);

        return redirect()->route('pasien.daftar-poli.index')->with('status', 'daftar-poli-created');
    }
}
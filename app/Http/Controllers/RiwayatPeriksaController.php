<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPeriksaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Mengambil data daftar poli milik pasien yang sedang login
        // dengan relasi jadwal periksa, dokter, poli, dan periksa
        $janjiPeriksas = DaftarPoli::where('id_pasien', $user->id)
            ->with([
                'jadwal.dokter.poli',
                'periksa'
            ])
            ->latest()
            ->get();

        return view('pasien.riwayat-periksa.index', compact('janjiPeriksas'));
    }

    public function detail($id)
    {
        $user = Auth::user();
        
        $janjiPeriksa = DaftarPoli::where('id_pasien', $user->id)
            ->where('id', $id)
            ->with([
                'jadwal.dokter.poli',
                'periksa'
            ])
            ->firstOrFail();

        return view('pasien.riwayat-periksa.detail', compact('janjiPeriksa'));
    }

    public function riwayat($id)
    {
        $user = Auth::user();
        
        $janjiPeriksa = DaftarPoli::where('id_pasien', $user->id)
            ->where('id', $id)
            ->with([
                'jadwal.dokter.poli',
                'periksa.detailPeriksas'
            ])
            ->firstOrFail();

        // Pastikan sudah ada data periksa
        if (!$janjiPeriksa->periksa->first()) {
            return redirect()->route('pasien.riwayat-periksa.index')
                ->with('error', 'Belum ada riwayat pemeriksaan untuk janji ini.');
        }

        return view('pasien.riwayat-periksa.riwayat', compact('janjiPeriksa'));
    }
}
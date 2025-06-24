<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $JadwalPeriksas = JadwalPeriksa::where('id_dokter', Auth::user()->id)->get();
        return view('dokter.jadwalPeriksa.index')->with([
            'JadwalPeriksas' => $JadwalPeriksas,
        ]);
    }

    public function create()
    {
        return view('dokter.jadwalPeriksa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hari' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        if (
            JadwalPeriksa::where('id_dokter', Auth::user()->id)
                ->where('hari', $validated['hari'])
                ->where('jam_mulai', $validated['jam_mulai'])
                ->where('jam_selesai', $validated['jam_selesai'])
                ->exists()
        ) {
            return redirect()->route('dokter.jadwalPeriksa.create');
        }

        JadwalPeriksa::create([
            'id_dokter' => Auth::user()->id,
            'hari' => $validated['hari'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $validated['jam_selesai'],
            'status' => 0,
        ]);

        return redirect()->route('dokter.jadwalPeriksa.index')->with('success', 'Jadwal periksa berhasil ditambahkan!');
    }

    public function update($id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);

        if (!$jadwalPeriksa->status) {
            JadwalPeriksa::where('id_dokter', Auth::user()->id)->update(['status' => 0]);

            $jadwalPeriksa->status = 1;
            $jadwalPeriksa->save();

            return redirect()->route('dokter.jadwalPeriksa.index')->with('success', 'Jadwal periksa berhasil diaktifkan!');
        }

        $jadwalPeriksa->status = 0;
        $jadwalPeriksa->save();

        return redirect()->route('dokter.jadwalPeriksa.index')->with('success', 'Jadwal periksa berhasil dinonaktifkan!');
    }


}
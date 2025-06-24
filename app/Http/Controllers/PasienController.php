<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pasiens = User::where('role', 'pasien')->paginate(10);
        return view('admin.pasien.index', compact('pasiens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:150',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:20|unique:users,no_ktp',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Generate nomor RM otomatis dengan format YYYYMMXXX
        $currentYear = date('Y');
        $currentMonth = date('m');
        $yearMonth = $currentYear . $currentMonth;
        
        // Cari pasien terakhir di bulan dan tahun yang sama
        $lastPasien = User::where('role', 'pasien')
            ->whereNotNull('no_rm')
            ->where('no_rm', 'LIKE', $yearMonth . '%')
            ->orderBy('no_rm', 'desc')
            ->first();
        
        $nextNumber = 1;
        if ($lastPasien && $lastPasien->no_rm) {
            // Ambil 3 digit terakhir sebagai nomor urut
            $lastNumber = (int) substr($lastPasien->no_rm, -3);
            $nextNumber = $lastNumber + 1;
        }
        
        $no_rm = $yearMonth . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        User::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'no_rm' => $no_rm,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pasien',
        ]);

        return redirect()->route('admin.pasien.index')
            ->with('success', 'Pasien berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $pasien)
    {
        // Pastikan user yang diedit adalah pasien
        if ($pasien->role !== 'pasien') {
            return redirect()->route('admin.pasien.index')
                ->with('error', 'Data tidak ditemukan!');
        }

        return view('admin.pasien.edit', compact('pasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $pasien)
    {
        // Pastikan user yang diupdate adalah pasien
        if ($pasien->role !== 'pasien') {
            return redirect()->route('admin.pasien.index')
                ->with('error', 'Data tidak ditemukan!');
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:150',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:20|unique:users,no_ktp,' . $pasien->id,
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,' . $pasien->id,
            'password' => 'nullable|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $updateData = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $pasien->update($updateData);

        return redirect()->route('admin.pasien.index')
            ->with('success', 'Pasien berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $pasien)
    {
        // Pastikan user yang dihapus adalah pasien
        if ($pasien->role !== 'pasien') {
            return redirect()->route('admin.pasien.index')
                ->with('error', 'Data tidak ditemukan!');
        }

        // Check if pasien has any medical records
        if ($pasien->daftar_poli_pasien()->exists()) {
            return redirect()->route('admin.pasien.index')
                ->with('error', 'Pasien tidak dapat dihapus karena memiliki riwayat medis!');
        }

        $pasien->delete();

        return redirect()->route('admin.pasien.index')
            ->with('success', 'Pasien berhasil dihapus!');
    }
}
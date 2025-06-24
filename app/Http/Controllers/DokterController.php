<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = User::where('role', 'dokter')
            ->with('poli')
            ->paginate(10);
        
        return view('admin.dokter.index', compact('dokters'));
    }

    public function create()
    {
        $polis = Poli::all();
        return view('admin.dokter.create', compact('polis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'no_hp' => 'required|string|max:20',
            'id_poli' => 'required|exists:polis,id',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'id_poli' => $request->id_poli,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'dokter',
            'no_ktp' => null,
            'no_rm' => null,
        ]);

        return redirect('/admin/dokter')->with('success', 'Dokter berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $dokter = User::where('role', 'dokter')->findOrFail($id);
        $polis = Poli::all();
        
        return view('admin.dokter.edit', compact('dokter', 'polis'));
    }

    public function update(Request $request, string $id)
    {
        $dokter = User::where('role', 'dokter')->findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'no_hp' => 'required|string|max:20',
            'id_poli' => 'required|exists:polis,id',
            'email' => ['required', 'email', Rule::unique('users')->ignore($dokter->id)],
            'password' => 'nullable|string|min:6',
        ]);

        $updateData = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'id_poli' => $request->id_poli,
            'email' => $request->email,
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $dokter->update($updateData);

        return redirect('/admin/dokter')->with('success', 'Data dokter berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dokter = User::where('role', 'dokter')->findOrFail($id);
        $dokter->delete();

        return redirect('/admin/dokter')->with('success', 'Dokter berhasil dihapus!');
    }

    /**
     * Show the form for editing the authenticated doctor's profile.
     */
    public function editProfile()
    {
        $user = Auth::user();
        $polis = Poli::all();
        return view('dokter.profile.edit', compact('user', 'polis'));
    }

    /**
     * Update the authenticated doctor's profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'no_hp' => 'required|string|max:20',
            'id_poli' => 'required|exists:polis,id',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'id_poli' => $request->id_poli,
            'email' => $request->email,
        ]);

        return redirect()->route('dokter.profile.edit')->with('success', 'Profile berhasil diperbarui!');
    }
}
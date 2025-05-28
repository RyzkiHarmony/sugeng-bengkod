<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        // $obats = Obat::latest()->get();
        $obats = Obat::latest()->paginate(5);

        return view('dokter.obat.index', data: compact('obats'));
    }
    public function create()
    {
        return view('dokter.obat.create');
    }

    public function store(Request $req)
    {
        $req->validate([
            'nama_obat' => ['required', 'string', 'max:255'],
            'kemasan' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'integer'],
        ]);

        obat::create($req->all());

        return redirect('dokter/obat')->with('success', 'Obat Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $obat = Obat::find($id);

        return view('dokter.obat.edit', compact('obat'));
    }

    public function update(Request $req, $id)
    {
        $req->validate([
            'nama_obat' => ['required', 'string', 'max:255'],
            'kemasan' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'integer'],
        ]);

        obat::find($id)->update($req->all());

        return redirect('dokter/obat')->with('success', 'Obat Berhasil Diedit');
    }

    public function destroy($id)
    {
        Obat::find($id)->delete();

        return redirect('/dokter/obat')->with('success', 'Obat Berhasil Dihapus');
    }
}
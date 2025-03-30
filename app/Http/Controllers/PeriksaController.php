<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use App\Models\User;
use Illuminate\Http\Request;

class PeriksaController extends Controller
{
    public function index()
    {
        // Fetch only users with role='dokter'
        $dokters = User::where('role', 'dokter')->get();

        // Other data you need
        $periksas = Periksa::all();

        return view('pasien.periksa', compact('dokters', 'periksas'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use Illuminate\Http\Request;

class MemeriksaController extends Controller
{
    public function index()
    {
        $memeriksas = Periksa::with('pasien')->get();

        return view('dokter.memeriksa', data: compact('memeriksas'));
    }
}
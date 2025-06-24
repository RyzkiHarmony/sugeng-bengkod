@extends('layout.app')

@section('title', 'Detail Riwayat Periksa | Pasien')

@section('nav-item')
<li class="nav-item">
    <a href="/pasien/daftar-poli" class="nav-link {{ request()->is('pasien/daftar-poli*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-plus"></i>
        <p>Daftar Poli</p>
    </a>
</li>
<li class="nav-item">
    <a href="/pasien/riwayat-periksa" class="nav-link {{ request()->is('pasien/riwayat-periksa*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-history"></i>
        <p>Riwayat Periksa</p>
    </a>
</li>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Riwayat Pemeriksaan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/pasien/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pasien.riwayat-periksa.index') }}">Riwayat
                            Periksa</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Pemeriksaan</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Poliklinik:</strong></td>
                                        <td>{{ $janjiPeriksa->jadwal->dokter->poli->nama_poli ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Dokter:</strong></td>
                                        <td>{{ $janjiPeriksa->jadwal->dokter->nama ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Hari:</strong></td>
                                        <td>{{ $janjiPeriksa->jadwal->hari ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jam:</strong></td>
                                        <td>
                                            {{ $janjiPeriksa->jadwal->jam_mulai ? \Carbon\Carbon::parse($janjiPeriksa->jadwal->jam_mulai)->format('H.i') : 'N/A' }}
                                            -
                                            {{ $janjiPeriksa->jadwal->jam_selesai ? \Carbon\Carbon::parse($janjiPeriksa->jadwal->jam_selesai)->format('H.i') : 'N/A' }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>No. Antrian:</strong></td>
                                        <td><span class="badge badge-primary"
                                                style="font-size: 1.2rem;">{{ $janjiPeriksa->no_antrian ?? 'N/A' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Keluhan:</strong></td>
                                        <td>{{ $janjiPeriksa->keluhan ?? 'N/A' }}</td>
                                    </tr>
                                    @if($janjiPeriksa->periksa->first())
                                    <tr>
                                        <td><strong>Tanggal Periksa:</strong></td>
                                        <td>{{ $janjiPeriksa->periksa->first()->tgl_periksa ? \Carbon\Carbon::parse($janjiPeriksa->periksa->first()->tgl_periksa)->translatedFormat('d F Y') : 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Biaya Periksa:</strong></td>
                                        <td>{{ $janjiPeriksa->periksa->first()->biaya_periksa ? 'Rp ' . number_format($janjiPeriksa->periksa->first()->biaya_periksa, 0, ',', '.') : 'N/A' }}
                                        </td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($janjiPeriksa->periksa->first())
        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Catatan Pemeriksaan</h3>
                    </div>
                    <div class="card-body">
                        <p>{{ $janjiPeriksa->periksa->first()->catatan ?? 'Tidak ada catatan' }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if($janjiPeriksa->periksa->first()->detailPeriksas &&
        $janjiPeriksa->periksa->first()->detailPeriksas->count() > 0)
        <div class="row">
            <div class="col-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Obat yang Diberikan</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Obat</th>
                                    <th>Kemasan</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($janjiPeriksa->periksa->first()->detailPeriksas as $detail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $detail->obat->nama_obat ?? 'N/A' }}</td>
                                    <td>{{ $detail->obat->kemasan ?? 'N/A' }}</td>
                                    <td>{{ $detail->obat->harga ? 'Rp ' . number_format($detail->obat->harga, 0, ',', '.') : 'N/A' }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endif

        <div class="row">
            <div class="col-12">
                <a href="{{ route('pasien.riwayat-periksa.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
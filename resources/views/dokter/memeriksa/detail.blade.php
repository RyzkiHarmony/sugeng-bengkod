@extends('layout.app')

@section('title', 'Detail Pemeriksaan')

@section('nav-item')
<li class="nav-item">
    <a href="/dokter/jadwal-periksa" class="nav-link {{ request()->is('dokter/jadwal-periksa*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-alt"></i>
        <p>Jadwal Periksa</p>
    </a>
</li>
<li class="nav-item">
    <a href="/dokter/memeriksa" class="nav-link {{ request()->is('dokter/memeriksa') ? 'active' : '' }}">
        <i class="nav-icon fas fa-stethoscope"></i>
        <p>Memeriksa</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('dokter.memeriksa.history') }}"
        class="nav-link {{ request()->is('dokter/memeriksa/history*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-history"></i>
        <p>History Pemeriksaan</p>
    </a>
</li>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Pemeriksaan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dokter.memeriksa.index') }}">Memeriksa</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dokter.memeriksa.history') }}">History</a></li>
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
            <!-- Patient Information -->
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-user"></i> Informasi Pasien</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Nama:</strong></td>
                                <td>{{ $janjiPeriksa->pasien->nama }}</td>
                            </tr>
                            <tr>
                                <td><strong>No. RM:</strong></td>
                                <td><span class="badge badge-info">{{ $janjiPeriksa->pasien->no_rm }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>No. KTP:</strong></td>
                                <td>{{ $janjiPeriksa->pasien->no_ktp }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Lahir:</strong></td>
                                <td>{{ \Carbon\Carbon::parse($janjiPeriksa->pasien->tanggal_lahir)->format('d/m/Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Kelamin:</strong></td>
                                <td>
                                    <span
                                        class="badge {{ $janjiPeriksa->pasien->jenis_kelamin == 'L' ? 'badge-primary' : 'badge-pink' }}">
                                        {{ $janjiPeriksa->pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Alamat:</strong></td>
                                <td>{{ $janjiPeriksa->pasien->alamat }}</td>
                            </tr>
                            <tr>
                                <td><strong>No. HP:</strong></td>
                                <td>{{ $janjiPeriksa->pasien->no_hp }}</td>
                            </tr>
                            <tr>
                                <td><strong>No. Antrian:</strong></td>
                                <td><span class="badge badge-warning">{{ $janjiPeriksa->no_antrian }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Keluhan:</strong></td>
                                <td>{{ $janjiPeriksa->keluhan }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Examination Details -->
            <div class="col-md-8">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-stethoscope"></i> Detail Pemeriksaan</h3>
                        <div class="card-tools">
                            <a href="{{ route('dokter.memeriksa.history') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($janjiPeriksa->periksa->first())
                        @php
                        $periksa = $janjiPeriksa->periksa->first();
                        @endphp

                        <!-- Examination Information -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="fas fa-calendar-alt"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Tanggal Periksa</span>
                                        <span
                                            class="info-box-number">{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d/m/Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <span class="info-box-icon bg-success"><i class="fas fa-money-bill-wave"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Biaya Periksa</span>
                                        <span class="info-box-number">Rp
                                            {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Examination Notes -->
                        <div class="form-group">
                            <label class="font-weight-bold">Catatan Pemeriksaan:</label>
                            <div class="card">
                                <div class="card-body">
                                    <p class="mb-0">{{ $periksa->catatan }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Prescribed Medications -->
                        <div class="form-group">
                            <label class="font-weight-bold">Obat yang Diresepkan:</label>
                            @if($periksa->detailPeriksas && $periksa->detailPeriksas->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Nama Obat</th>
                                            <th>Kemasan</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $totalObat = 0; @endphp
                                        @foreach($periksa->detailPeriksas as $index => $detail)
                                        @php $totalObat += $detail->obat->harga; @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><strong>{{ $detail->obat->nama_obat }}</strong></td>
                                            <td>{{ $detail->obat->kemasan }}</td>
                                            <td>
                                                <span class="badge badge-success">
                                                    Rp {{ number_format($detail->obat->harga, 0, ',', '.') }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-light">
                                            <th colspan="3" class="text-right">Total Harga Obat:</th>
                                            <th>
                                                <span class="badge badge-primary">
                                                    Rp {{ number_format($totalObat, 0, ',', '.') }}
                                                </span>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> Tidak ada obat yang diresepkan untuk pemeriksaan ini.
                            </div>
                            @endif
                        </div>

                        <!-- Cost Breakdown -->
                        <div class="row">
                            <div class="col-md-6 offset-md-6">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0"><i class="fas fa-calculator"></i> Rincian Biaya</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm">
                                            <tr>
                                                <td>Biaya Konsultasi:</td>
                                                <td class="text-right">
                                                    <strong>Rp {{ number_format(150000, 0, ',', '.') }}</strong>
                                                </td>
                                            </tr>
                                            @if(isset($totalObat) && $totalObat > 0)
                                            <tr>
                                                <td>Biaya Obat:</td>
                                                <td class="text-right">
                                                    <strong>Rp {{ number_format($totalObat, 0, ',', '.') }}</strong>
                                                </td>
                                            </tr>
                                            @endif
                                            <tr class="border-top">
                                                <td><strong>Total Biaya:</strong></td>
                                                <td class="text-right">
                                                    <strong class="text-success">
                                                        Rp {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}
                                                    </strong>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> Data pemeriksaan tidak ditemukan.
                        </div>
                        @endif
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dokter.memeriksa.history') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali ke History
                            </a>

                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
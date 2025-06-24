@extends('layout.app')

@section('title', 'Riwayat Pemeriksaan')

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
                <h1 class="m-0">Riwayat Pemeriksaan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dokter.memeriksa.index') }}">Memeriksa</a></li>
                    <li class="breadcrumb-item active">History</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Flash Messages -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-history"></i> Daftar Pasien yang Sudah Diperiksa
                        </h3>
                        <div class="card-tools">
                            <a href="{{ route('dokter.memeriksa.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Antrian
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <p class="text-muted mb-3">
                            <i class="fas fa-info-circle"></i> Riwayat pemeriksaan pasien yang telah Anda tangani.
                        </p>

                        @if($janjiPeriksas->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" style="width: 120px">No. Antrian</th>
                                        <th scope="col">Nama Pasien</th>
                                        <th scope="col">Keluhan</th>
                                        <th scope="col">Tanggal Periksa</th>
                                        <th scope="col">Biaya</th>
                                        <th scope="col" style="width: 100px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($janjiPeriksas as $janjiPeriksa)
                                    <tr>
                                        <th scope="row" class="align-middle text-center">
                                            <span class="badge badge-secondary">{{ $janjiPeriksa->no_antrian }}</span>
                                        </th>
                                        <td class="align-middle">
                                            <strong>{{ $janjiPeriksa->pasien->nama }}</strong>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-truncate" style="max-width: 200px; display: inline-block;"
                                                title="{{ $janjiPeriksa->keluhan }}">
                                                {{ $janjiPeriksa->keluhan }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge badge-info">
                                                {{ $janjiPeriksa->periksa->first() && $janjiPeriksa->periksa->first()->tgl_periksa ? \Carbon\Carbon::parse($janjiPeriksa->periksa->first()->tgl_periksa)->format('d/m/Y H:i') : '-' }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge badge-success font-weight-bold">
                                                Rp
                                                {{ $janjiPeriksa->periksa->first() ? number_format($janjiPeriksa->periksa->first()->biaya_periksa, 0, ',', '.') : '0' }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('dokter.memeriksa.detail', $janjiPeriksa->id) }}"
                                                class="btn btn-info btn-sm" title="Lihat Detail">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <i class="fas fa-clipboard-list fa-2x text-muted mb-2"></i>
                                            <p class="text-muted mb-0">Belum ada riwayat pemeriksaan</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-5">
                            <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum Ada Riwayat Pemeriksaan</h5>
                            <p class="text-muted">Anda belum melakukan pemeriksaan pada pasien manapun.</p>
                            <a href="{{ route('dokter.memeriksa.index') }}" class="btn btn-primary">
                                <i class="fas fa-stethoscope"></i> Mulai Pemeriksaan
                            </a>
                        </div>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
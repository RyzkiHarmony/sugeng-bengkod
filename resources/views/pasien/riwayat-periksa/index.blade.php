@extends('layout.app')

@section('title', 'Riwayat Periksa | Pasien')

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
                <h1 class="m-0">Riwayat Periksa</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/pasien/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Riwayat Periksa</li>
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
                        <h3 class="card-title">Riwayat Janji Periksa</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Poliklinik</th>
                                    <th>Dokter</th>
                                    <th>Hari</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th>Antrian</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($janjiPeriksas) > 0)
                                @foreach ($janjiPeriksas as $janjiPeriksa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $janjiPeriksa->jadwal->dokter->poli->nama_poli ?? 'N/A' }}</td>
                                    <td>{{ $janjiPeriksa->jadwal->dokter->nama ?? 'N/A' }}</td>
                                    <td>{{ $janjiPeriksa->jadwal->hari ?? 'N/A' }}</td>
                                    <td>
                                        {{ $janjiPeriksa->jadwal->jam_mulai ? \Carbon\Carbon::parse($janjiPeriksa->jadwal->jam_mulai)->format('H.i') : 'N/A' }}
                                    </td>
                                    <td>
                                        {{ $janjiPeriksa->jadwal->jam_selesai ? \Carbon\Carbon::parse($janjiPeriksa->jadwal->jam_selesai)->format('H.i') : 'N/A' }}
                                    </td>
                                    <td>{{ $janjiPeriksa->no_antrian ?? 'N/A' }}</td>
                                    <td>
                                        @if ($janjiPeriksa->periksa->isEmpty())
                                        <span class="badge badge-warning">Belum Diperiksa</span>
                                        @else
                                        <span class="badge badge-success">Sudah Diperiksa</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($janjiPeriksa->periksa->isEmpty())
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#detailModal{{ $janjiPeriksa->id }}">
                                            Detail
                                        </button>
                                        @else
                                        <a href="{{ route('pasien.riwayat-periksa.riwayat', $janjiPeriksa->id) }}"
                                            class="btn btn-secondary btn-sm">Riwayat</a>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Modal Detail -->
                                <div class="modal fade" id="detailModal{{ $janjiPeriksa->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="detailModalLabel{{ $janjiPeriksa->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModalLabel{{ $janjiPeriksa->id }}">
                                                    Detail Riwayat Pemeriksaan</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <strong>Poliklinik:</strong>
                                                        <p>{{ $janjiPeriksa->jadwal->dokter->poli->nama_poli ?? 'N/A' }}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Nama Dokter:</strong>
                                                        <p>{{ $janjiPeriksa->jadwal->dokter->nama ?? 'N/A' }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <strong>Hari Pemeriksaan:</strong>
                                                        <p>{{ $janjiPeriksa->jadwal->hari ?? 'N/A' }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Jam:</strong>
                                                        <p>
                                                            {{ $janjiPeriksa->jadwal->jam_mulai ? \Carbon\Carbon::parse($janjiPeriksa->jadwal->jam_mulai)->format('H.i') : 'N/A' }}
                                                            -
                                                            {{ $janjiPeriksa->jadwal->jam_selesai ? \Carbon\Carbon::parse($janjiPeriksa->jadwal->jam_selesai)->format('H.i') : 'N/A' }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <strong>Keluhan:</strong>
                                                        <p>{{ $janjiPeriksa->keluhan ?? 'N/A' }}</p>
                                                    </div>
                                                </div>

                                                <!-- Highlight Nomor Antrian -->
                                                <div class="text-center mt-4">
                                                    <h5 class="font-weight-bold">Nomor Antrian Anda</h5>
                                                    <span class="badge badge-primary"
                                                        style="font-size: 1.75rem; padding: 0.6em 1.2em;">
                                                        {{ $janjiPeriksa->no_antrian ?? 'N/A' }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada riwayat janji periksa</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
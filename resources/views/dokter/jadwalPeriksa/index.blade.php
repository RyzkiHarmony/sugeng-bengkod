@extends('layout.app')

@section('title', 'Sugeng | Jadwal Periksa')

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
    <a href="{{ route('dokter.memeriksa.history') }}" class="nav-link {{ request()->is('dokter/memeriksa/history*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-history"></i>
        <p>History Pemeriksaan</p>
    </a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Jadwal Periksa</h3>
                    <div class="card-tools">
                        <a href="{{ route('dokter.jadwalPeriksa.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Jadwal
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if($JadwalPeriksas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Hari</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($JadwalPeriksas as $index => $jadwal)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $jadwal->hari }}</td>
                                    <td>{{ $jadwal->jam_mulai }}</td>
                                    <td>{{ $jadwal->jam_selesai }}</td>
                                    <td>
                                        @if($jadwal->status)
                                        <span class="badge badge-success">Aktif</span>
                                        @else
                                        <span class="badge badge-secondary">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('dokter.jadwalPeriksa.update', $jadwal->id) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            @if($jadwal->status)
                                            <button type="submit" class="btn btn-warning btn-sm"
                                                onclick="return confirm('Yakin ingin menonaktifkan jadwal ini?')">
                                                <i class="fas fa-toggle-off"></i> Nonaktifkan
                                            </button>
                                            @else
                                            <button type="submit" class="btn btn-success btn-sm"
                                                onclick="return confirm('Yakin ingin mengaktifkan jadwal ini?')">
                                                <i class="fas fa-toggle-on"></i> Aktifkan
                                            </button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada jadwal periksa</h5>
                        <p class="text-muted">Silakan tambah jadwal periksa baru</p>
                        <a href="{{ route('dokter.jadwalPeriksa.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Jadwal Pertama
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
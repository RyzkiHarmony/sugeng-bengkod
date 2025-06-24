@extends('layout.app')

@section('title', 'Sugeng | Periksa Pasien')

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
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Periksa Pasien</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dokter/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Periksa Pasien</li>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Pasien</h3>

                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                            {{ session('success') }}
                        </div>
                        @endif
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No. Antrian</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Keluhan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($janjiPeriksas as $janjiPeriksa)
                                <tr>
                                    <th scope="row" class="align-middle text-start">
                                        {{ $janjiPeriksa->no_antrian }}
                                    </th>
                                    <td class="align-middle text-start">
                                        {{ $janjiPeriksa->pasien->nama }}
                                    </td>
                                    <td class="align-middle text-start">
                                        {{ $janjiPeriksa->keluhan }}
                                    </td>
                                    <td class="align-middle text-start">
                                        <a href="{{ route('dokter.memeriksa.create', $janjiPeriksa->id) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-stethoscope"></i> Periksa
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada pasien yang perlu diperiksa</td>
                                </tr>
                                @endforelse
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
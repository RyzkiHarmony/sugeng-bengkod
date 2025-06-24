@extends('layout.app')

@section('title', 'Sugeng | Pemeriksaan')

@section('nav-item')
<li class="nav-item">
    <a href="/dokter/jadwal-periksa" class="nav-link {{ request()->is('dokter/jadwal-periksa*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-alt"></i>
        <p>Jadwal Periksa</p>
    </a>
</li>
<li class="nav-item">
    <a href="/dokter/memeriksa" class="nav-link {{ request()->is('dokter/memeriksa*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-stethoscope"></i>
        <p>Memeriksa</p>
    </a>
</li>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pemeriksaan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dokter/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/dokter/memeriksa">Memeriksa</a></li>
                    <li class="breadcrumb-item active">Pemeriksaan</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
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

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Pemeriksaan</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- Informasi Pasien -->
                    <div class="card card-info mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Pasien</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Nama Pasien</label>
                                        <p class="form-control-static">{{ $janjiPeriksa->pasien->name ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">No. HP</label>
                                        <p class="form-control-static">{{ $janjiPeriksa->pasien->no_hp ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Keluhan</label>
                                        <p class="form-control-static">{{ $janjiPeriksa->keluhan ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Jadwal</label>
                                        <p class="form-control-static">
                                            {{ $janjiPeriksa->jadwal->hari ?? 'N/A' }},
                                            {{ $janjiPeriksa->jadwal->jam_mulai ?? 'N/A' }} -
                                            {{ $janjiPeriksa->jadwal->jam_selesai ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- form start -->
                    <form method="POST" action="{{ route('dokter.memeriksa.store') }}">
                        @csrf
                        <input type="hidden" name="id_daftar_poli" value="{{ $janjiPeriksa->id }}">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="tgl_periksa">Tanggal Periksa</label>
                                <input type="datetime-local"
                                    class="form-control @error('tgl_periksa') is-invalid @enderror" id="tgl_periksa"
                                    name="tgl_periksa" value="{{ old('tgl_periksa', now()->format('Y-m-d\TH:i')) }}"
                                    required>
                                @error('tgl_periksa')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="catatan">Catatan Pemeriksaan</label>
                                <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan"
                                    name="catatan" rows="4"
                                    placeholder="Masukkan catatan hasil pemeriksaan...">{{ old('catatan') }}</textarea>
                                @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Obat</label>
                                <div class="d-flex">
                                    <select class="custom-select form-control" id="obat-select">
                                        <option selected>Pilih Obat</option>
                                        @foreach($obats as $obat)
                                        <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">
                                            {{ $obat->nama_obat }} - {{ $obat->kemasan }} -
                                            Rp {{ number_format($obat->harga, 0, ',', '.') }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <button type="button" id="clear-all-obats" class="btn btn-outline-danger ml-2"
                                        style="display: block;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>

                                <div class="selected-obats mt-3" id="selected-obats-container" style="display: block;">
                                    <ul class="list-group" id="selected-obats-list">
                                        @if(isset($selected_obats) && !empty($selected_obats))
                                        @foreach($obats as $obat)
                                        @if(in_array($obat->id, $selected_obats))
                                        <li class="list-group-item d-flex justify-content-between align-items-center"
                                            data-id="{{ $obat->id }}" data-harga="{{ $obat->harga }}">
                                            {{ $obat->nama_obat }} - {{ $obat->kemasan }} - Rp
                                            {{ number_format($obat->harga, 0, ',', '.') }}
                                            <button type="button" class="btn btn-sm btn-danger remove-obat">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            <input type="hidden" name="obat[]" value="{{ $obat->id }}">
                                        </li>
                                        @endif
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="biaya_periksa">Biaya Periksa</label>
                                <!-- Hidden input for form submission -->
                                <input type="hidden" id="biaya_periksa" name="biaya_periksa"
                                    value="{{ old('biaya_periksa', 150000) }}">
                                <!-- Display element for formatted price -->
                                <div id="biaya_periksa_display" class="form-control bg-light" readonly>
                                    Rp 150.000
                                </div>
                                <small class="form-text text-muted">
                                    Biaya dihitung otomatis: Rp 150.000 (biaya dasar) + harga obat yang dipilih.
                                </small>
                                @error('biaya_periksa')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('dokter.memeriksa.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Pemeriksaan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
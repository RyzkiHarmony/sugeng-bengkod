@extends('layout.app')

@section("title", "Sugeng | Daftar Poli")

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
                <h1 class="m-0">Janji Periksa</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/pasien/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Janji Periksa</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Form Pendaftaran -->
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Buat Janji Periksa</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <p class="text-muted mb-4">
                            Atur jadwal pertemuan dengan dokter untuk mendapatkan layanan konsultasi dan pemeriksaan
                            kesehatan sesuai kebutuhan Anda.
                        </p>

                        <!-- Success Message -->
                        @if(session('status') === 'daftar-poli-created')
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                            Berhasil Dibuat.
                        </div>
                        @endif

                        <!-- Error Messages -->
                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- form start -->
                        <form method="POST" action="{{ route('pasien.daftar-poli.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="no_rm">Nomor Rekam Medis</label>
                                <input type="text" class="form-control" id="no_rm" value="{{ $no_rm }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="dokterSelect">Dokter</label>
                                <select class="form-control" id="dokterSelect" name="id_jadwal" required>
                                    <option>Pilih Dokter</option>
                                    @foreach ($dokters as $dokter)
                                    @foreach ($dokter->jadwal_periksa_dokter as $jadwal)
                                    <option value="{{ $jadwal->id }}">
                                        {{ $dokter->nama }} - Poli: {{ $dokter->poli->nama_poli }} |
                                        {{ $jadwal->hari }}, {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                                    </option>
                                    @endforeach
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="keluhan">Keluhan</label>
                                <textarea class="form-control" id="keluhan" name="keluhan" rows="3"
                                    placeholder="Jelaskan keluhan Anda..." required>{{ old('keluhan') }}</textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary ml-2">Reset</button>
                            </div>
                        </form>
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
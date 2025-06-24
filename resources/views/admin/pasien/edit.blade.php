@extends('layout.app')

@section('title', 'Sugeng | Edit Pasien')

@section('nav-item')
<li class="nav-item">
    <a href="/admin/obat" class="nav-link {{ request()->is('admin/obat*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-solid fa-pills"></i>
        <p>Obat</p>
    </a>
</li>
<li class="nav-item">
    <a href="/admin/dokter" class="nav-link {{ request()->is('admin/dokter*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-md"></i>
        <p>Dokter</p>
    </a>
</li>
<li class="nav-item">
    <a href="/admin/poli" class="nav-link {{ request()->is('admin/poli*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-hospital"></i>
        <p>Poli</p>
    </a>
</li>
<li class="nav-item">
    <a href="/admin/pasien" class="nav-link {{ request()->is('admin/pasien*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>Pasien</p>
    </a>
</li>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Pasien</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.pasien.index') }}">Pasien</a></li>
                    <li class="breadcrumb-item active">Edit Pasien</li>
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
                        <h3 class="card-title">Form Edit Pasien</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        
                        <form action="{{ route('admin.pasien.update', $pasien->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                               id="nama" name="nama" value="{{ old('nama', $pasien->nama) }}" 
                                               placeholder="Masukkan nama lengkap" required>
                                        @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_ktp">No. KTP</label>
                                        <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" 
                                               id="no_ktp" name="no_ktp" value="{{ old('no_ktp', $pasien->no_ktp) }}" 
                                               placeholder="Masukkan nomor KTP" required>
                                        @error('no_ktp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_hp">No. HP</label>
                                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" 
                                               id="no_hp" name="no_hp" value="{{ old('no_hp', $pasien->no_hp) }}" 
                                               placeholder="Masukkan nomor HP" required>
                                        @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email', $pasien->email) }}" 
                                               placeholder="Masukkan email" required>
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                          id="alamat" name="alamat" rows="3" 
                                          placeholder="Masukkan alamat lengkap" required>{{ old('alamat', $pasien->alamat) }}</textarea>
                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="no_rm">No. Rekam Medis</label>
                                <input type="text" class="form-control" id="no_rm" value="{{ $pasien->no_rm }}" readonly>
                                <small class="form-text text-muted">Nomor rekam medis tidak dapat diubah</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Password Baru (Opsional)</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" 
                                       placeholder="Kosongkan jika tidak ingin mengubah password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password. Minimal 6 karakter jika diisi.</small>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.pasien.index') }}" class="btn btn-secondary">Kembali</a>
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
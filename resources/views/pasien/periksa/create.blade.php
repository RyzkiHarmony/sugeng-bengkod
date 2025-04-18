@extends('layout.app')

@section('title', 'Periksa | Buat Janji')

@section('nav-item')
<li class="nav-item">
    <a href="/pasien/periksa" class="nav-link {{ request()->is('pasien/periksa*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-sharp-duotone fa-solid fa-microscope"></i>
        <p>Periksa</p>
    </a>
</li>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Periksa</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/pasien/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/pasien/periksa">Periksa</a></li>
                    <li class="breadcrumb-item active">Buat Janji Periksa</li>
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
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Periksa</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="/pasien/periksa">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id-dokter">Dokter</label>
                                <select class="form-control" id="id-dokter" name="id_dokter">
                                    <option selected>Pilih Dokter</option>
                                    @foreach($dokters as $dokter)
                                    <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
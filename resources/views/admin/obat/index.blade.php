@extends('layout.app')

@section('title', 'Sugeng | Daftar Obat')

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
                <h1 class="m-0">Obat</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Obat</li>
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
                <a href="/admin/obat/create" class="btn btn-sm btn-info mb-2 float-right">Tambah Obat</a>

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Obat</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm mb-2" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Obat</th>
                                        <th>Kemasan</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($obats) > 0)
                                    @foreach($obats as $obat)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $obat->nama_obat }}</td>
                                        <td>{{ $obat->kemasan }}</td>
                                        <td>Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="row">
                                                <a href="/admin/obat/{{ $obat->id }}/edit" class="btn btn-warning "><i
                                                        class="fas fa-edit"></i> Edit</a>
                                                <form action="/admin/obat/{{ $obat->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Yakin INgin Hapus Obat {{ $obat->nama_obat }}?')"
                                                        class="btn btn-danger ml-2"><i class="fas fa-trash"></i>
                                                        Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data obat</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="mt-4">
                                {{ $obats->links('pagination::bootstrap-5') }}
                            </div>
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
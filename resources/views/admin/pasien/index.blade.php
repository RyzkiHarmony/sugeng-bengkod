@extends('layout.app')

@section('title', 'Sugeng | Daftar Pasien')

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
                <h1 class="m-0">Pasien</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Pasien</li>
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
                <a href="{{ route('admin.pasien.create') }}" class="btn btn-sm btn-info mb-2 float-right">Tambah Pasien</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Pasien</h3>
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
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No. RM</th>
                                        <th>Nama</th>
                                        <th>No. KTP</th>
                                        <th>No. HP</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($pasiens) > 0)
                                    @foreach($pasiens as $pasien)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pasien->no_rm }}</td>
                                        <td>{{ $pasien->nama }}</td>
                                        <td>{{ $pasien->no_ktp }}</td>
                                        <td>{{ $pasien->no_hp }}</td>
                                        <td>{{ $pasien->email }}</td>
                                        <td>{{ Str::limit($pasien->alamat, 30) }}</td>
                                        <td>
                                            <div class="row">
                                                <a href="{{ route('admin.pasien.edit', $pasien->id) }}"
                                                    class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                                <form action="{{ route('admin.pasien.destroy', $pasien->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Yakin ingin hapus pasien {{ $pasien->nama }}?')"
                                                        class="btn btn-danger ml-2"><i class="fas fa-trash"></i>
                                                        Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data pasien</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="mt-4">
                                {{ $pasiens->links('pagination::bootstrap-5') }}
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
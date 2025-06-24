@extends('layout.app')

@section('title', 'Pemeriksaan Pasien')

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
                <h1 class="m-0">Pemeriksaan Pasien</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dokter.memeriksa.index') }}">Memeriksa</a></li>
                    <li class="breadcrumb-item active">Pemeriksaan</li>
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

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="row">
            <!-- Patient Information -->
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-user"></i> Informasi Pasien</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Nama:</strong></td>
                                <td>{{ $janjiPeriksa->pasien->nama }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat:</strong></td>
                                <td>{{ $janjiPeriksa->pasien->alamat }}</td>
                            </tr>
                            <tr>
                                <td><strong>No. KTP:</strong></td>
                                <td>{{ $janjiPeriksa->pasien->no_ktp }}</td>
                            </tr>
                            <tr>
                                <td><strong>No. Antrian:</strong></td>
                                <td><span class="badge badge-info">{{ $janjiPeriksa->no_antrian }}</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Examination Form -->
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-stethoscope"></i> Form Pemeriksaan</h3>
                    </div>

                    <form action="{{ route('dokter.memeriksa.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_daftar_poli" value="{{ $janjiPeriksa->id }}">

                        <div class="card-body">
                            <!-- Tanggal Periksa -->
                            <div class="form-group">
                                <label for="tgl_periksa" class="form-label required">Tanggal Periksa</label>
                                <input type="date" class="form-control @error('tgl_periksa') is-invalid @enderror"
                                    id="tgl_periksa" name="tgl_periksa" value="{{ old('tgl_periksa', date('Y-m-d')) }}"
                                    required>
                                @error('tgl_periksa')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Catatan Pemeriksaan -->
                            <div class="form-group">
                                <label for="catatan" class="form-label required">Catatan Pemeriksaan</label>
                                <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan"
                                    name="catatan" rows="4" placeholder="Masukkan catatan pemeriksaan..."
                                    required>{{ old('catatan') }}</textarea>
                                @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Biaya Periksa -->
                            <div class="form-group">
                                <label for="biaya_periksa" class="form-label required">Biaya Periksa</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <div class="form-control bg-light" id="biaya_periksa_display">150.000</div>
                                </div>
                                <input type="hidden" id="biaya_periksa" name="biaya_periksa" value="150000">
                                <small class="form-text text-muted">Biaya akan dihitung otomatis berdasarkan obat yang
                                    dipilih</small>
                            </div>

                            <!-- Pilih Obat -->
                            <div class="form-group">
                                <label class="form-label">Pilih Obat</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">Daftar Obat</h6>
                                            </div>
                                            <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                                                @foreach($obats as $obat)
                                                <div class="obat-item" data-id="{{ $obat->id }}"
                                                    data-nama="{{ $obat->nama_obat }}"
                                                    data-kemasan="{{ $obat->kemasan }}" data-harga="{{ $obat->harga }}"
                                                    style="cursor: pointer; padding: 8px; border: 1px solid #ddd; margin-bottom: 5px; border-radius: 4px;">
                                                    <strong>{{ $obat->nama_obat }}</strong><br>
                                                    <small class="text-muted">{{ $obat->kemasan }} - Rp
                                                        {{ number_format($obat->harga, 0, ',', '.') }}</small>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h6 class="card-title mb-0">Obat Terpilih</h6>
                                                <button type="button" id="clear-all-obats"
                                                    class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i> Clear All
                                                </button>
                                            </div>
                                            <div class="card-body" id="selected-obats-container"
                                                style="min-height: 200px;">
                                                <ul id="selected-obats-list" class="list-unstyled">
                                                    <!-- Selected obats will be displayed here -->
                                                </ul>
                                                <div id="no-obats-message" class="text-center text-muted">
                                                    <i class="fas fa-pills fa-2x mb-2"></i><br>
                                                    Belum ada obat yang dipilih
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const obatItems = document.querySelectorAll('.obat-item');
    const selectedObatsList = document.getElementById('selected-obats-list');
    const selectedObatsContainer = document.getElementById('selected-obats-container');
    const clearAllBtn = document.getElementById('clear-all-obats');
    const biayaInput = document.getElementById('biaya_periksa');
    const biayaDisplay = document.getElementById('biaya_periksa_display');

    // Set default biaya to 150000
    const defaultBiaya = 150000;
    biayaInput.value = defaultBiaya;

    // Function to format rupiah
    function formatRupiah(angka) {
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    // Initialize biaya display
    biayaDisplay.textContent = formatRupiah(defaultBiaya);

    // Set untuk menyimpan ID obat yang sudah dipilih
    const selectedObats = new Set();

    // Object untuk menyimpan harga obat
    const obatPrices = {};

    // Populate obat prices
    obatItems.forEach(item => {
        const obatId = item.dataset.id;
        const harga = parseInt(item.dataset.harga);
        obatPrices[obatId] = harga;
    });

    // Function to show/hide no obats message
    function toggleNoObatsMessage() {
        const noObatsMessage = document.getElementById('no-obats-message');
        const hasSelectedObats = selectedObatsList.children.length > 0;

        if (hasSelectedObats) {
            noObatsMessage.style.display = 'none';
        } else {
            noObatsMessage.style.display = 'block';
        }
    }

    // Calculate total biaya based on selected obat
    function calculateTotalBiaya() {
        let total = defaultBiaya;

        selectedObatsList.querySelectorAll('li').forEach(item => {
            const obatId = item.dataset.id;
            if (obatId && obatPrices[obatId]) {
                total += obatPrices[obatId];
            }
        });

        // Set the actual numeric value for form submission
        biayaInput.value = total;
        // Display formatted value
        biayaDisplay.textContent = formatRupiah(total);
    }

    // Add click event to obat items
    obatItems.forEach(item => {
        item.addEventListener('click', function() {
            const obatId = this.dataset.id;
            const obatNama = this.dataset.nama;
            const obatKemasan = this.dataset.kemasan;
            const obatHarga = parseInt(this.dataset.harga);

            // Check if obat is already selected
            if (selectedObats.has(obatId)) {
                alert('Obat ini sudah dipilih!');
                return;
            }

            // Add to selected set
            selectedObats.add(obatId);

            // Create list item
            const listItem = document.createElement('li');
            listItem.className = 'mb-2 p-2 border rounded';
            listItem.dataset.id = obatId;
            listItem.innerHTML = `
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <strong>${obatNama}</strong><br>
                        <small class="text-muted">${obatKemasan} - Rp ${obatHarga.toLocaleString('id-ID')}</small>
                        <input type="hidden" name="obat_ids[]" value="${obatId}">
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-obat" data-id="${obatId}">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;

            // Add to selected list
            selectedObatsList.appendChild(listItem);

            // Add remove functionality
            const removeBtn = listItem.querySelector('.remove-obat');
            removeBtn.addEventListener('click', function() {
                const obatIdToRemove = this.dataset.id;
                selectedObats.delete(obatIdToRemove);
                listItem.remove();
                toggleNoObatsMessage();
                calculateTotalBiaya();
            });

            // Update UI
            toggleNoObatsMessage();
            calculateTotalBiaya();
        });
    });

    // Clear all selected obats
    clearAllBtn.addEventListener('click', function() {
        if (selectedObats.size === 0) {
            return;
        }

        if (confirm('Apakah Anda yakin ingin menghapus semua obat yang dipilih?')) {
            selectedObats.clear();
            selectedObatsList.innerHTML = '';
            toggleNoObatsMessage();

            // Reset biaya to default after clearing all obat
            biayaInput.value = defaultBiaya;
            biayaDisplay.textContent = formatRupiah(defaultBiaya);
        }
    });

    // Initialize UI
    toggleNoObatsMessage();
});
</script>
@endsection
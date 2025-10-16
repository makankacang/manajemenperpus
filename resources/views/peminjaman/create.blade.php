@php
    $pageTitle = 'Ajukan Peminjaman';
@endphp

<x-app-layout>
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Ajukan Peminjaman Buku</h4>
                <p class="text-muted mb-0">Ajukan peminjaman buku dari perpustakaan</p>
            </div>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('peminjaman.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label">Pilih Buku <span class="text-danger">*</span></label>
                                <select class="form-select @error('buku_id') is-invalid @enderror" name="buku_id" required>
                                    <option value="">Pilih Buku</option>
                                    @foreach($buku as $b)
                                        <option value="{{ $b->id }}" 
                                            {{ (old('buku_id') == $b->id || $selectedBukuId == $b->id) ? 'selected' : '' }}
                                            {{ $b->stok == 0 ? 'disabled' : '' }}>
                                            {{ $b->judul }} - {{ $b->penulis->nama ?? '-' }} 
                                            (Stok: {{ $b->stok }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('buku_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Tanggal Jatuh Tempo <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal_jatuh_tempo') is-invalid @enderror" 
                                       name="tanggal_jatuh_tempo" 
                                       value="{{ old('tanggal_jatuh_tempo', now()->addDays(7)->format('Y-m-d')) }}"
                                       min="{{ now()->addDay()->format('Y-m-d') }}"
                                       max="{{ now()->addDays(30)->format('Y-m-d') }}"
                                       required>
                                @error('tanggal_jatuh_tempo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    Pilih tanggal pengembalian buku. Maksimal 30 hari dari sekarang.
                                </div>
                            </div>

                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>
                                <strong>Perhatian:</strong> Peminjaman akan menunggu konfirmasi dari admin. 
                                Anda akan mendapatkan kode peminjaman setelah pengajuan.
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send me-2"></i>Ajukan Peminjaman
                                </button>
                                <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-2"></i>Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
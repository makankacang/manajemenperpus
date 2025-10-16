@php
    $pageTitle = 'Proses Pengembalian';
    $selectedPeminjamanId = request('peminjaman_id');
@endphp

<x-app-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Proses Pengembalian Buku</h4>
                <p class="text-muted mb-0">Form pengembalian buku perpustakaan</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Peminjaman
                </a>
                <a href="{{ route('pengembalian.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-list me-2"></i>Data Pengembalian
                </a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pengembalian.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label">Pilih Peminjaman <span class="text-danger">*</span></label>
                                <select class="form-select @error('peminjaman_id') is-invalid @enderror" name="peminjaman_id" required>
                                    <option value="">Pilih Peminjaman</option>
                                    @foreach($peminjaman as $p)
                                        @php
                                            $jatuhTempo = \Carbon\Carbon::parse($p->tanggal_jatuh_tempo);
                                            $today = \Carbon\Carbon::now();
                                            $keterlambatan = $today->greaterThan($jatuhTempo) ? $today->diffInDays($jatuhTempo) : 0;
                                        @endphp
                                        <option value="{{ $p->id }}" 
                                            {{ (old('peminjaman_id') == $p->id || $selectedPeminjamanId == $p->id) ? 'selected' : '' }}>
                                            {{ $p->kode_peminjaman }} - {{ $p->buku->judul }} 
                                            ({{ $p->user->name }})
                                            @if($keterlambatan > 0)
                                                - Terlambat {{ $keterlambatan }} hari
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('peminjaman_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Pengembalian <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal_pengembalian') is-invalid @enderror" 
                                       name="tanggal_pengembalian" 
                                       value="{{ old('tanggal_pengembalian', now()->format('Y-m-d')) }}"
                                       max="{{ now()->format('Y-m-d') }}"
                                       required>
                                @error('tanggal_pengembalian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kondisi Buku <span class="text-danger">*</span></label>
                                <select class="form-select @error('kondisi_buku') is-invalid @enderror" name="kondisi_buku" required>
                                    <option value="">Pilih Kondisi Buku</option>
                                    <option value="baik" {{ old('kondisi_buku') == 'baik' ? 'selected' : '' }}>Baik</option>
                                    <option value="rusak_ringan" {{ old('kondisi_buku') == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                    <option value="rusak_berat" {{ old('kondisi_buku') == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                                    <option value="hilang" {{ old('kondisi_buku') == 'hilang' ? 'selected' : '' }}>Hilang</option>
                                </select>
                                @error('kondisi_buku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror>
                                <div class="form-text">
                                    <strong>Keterangan:</strong><br>
                                    • Baik: Tidak ada kerusakan<br>
                                    • Rusak Ringan: Cover sobek/kotor minor (Denda: Rp 10.000)<br>
                                    • Rusak Berat: Halaman sobek/rusak parah (Denda: Rp 50.000)<br>
                                    • Hilang: Ganti buku (Denda: Harga buku)
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Catatan</label>
                                <textarea class="form-control @error('catatan') is-invalid @enderror" 
                                          name="catatan" rows="3" 
                                          placeholder="Catatan kondisi buku atau informasi lain...">{{ old('catatan') }}</textarea>
                                @error('catatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <strong>Perhatian:</strong> Denda akan dihitung otomatis berdasarkan keterlambatan dan kondisi buku. 
                                Pastikan data yang dimasukkan sudah benar.
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-2"></i>Proses Pengembalian
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
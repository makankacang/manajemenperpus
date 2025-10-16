@php
    $pageTitle = 'Data Buku';
    $isAdmin = Auth::user()->role->nama === 'Admin';
@endphp

<x-app-layout>
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Data Buku</h4>
                <p class="text-muted mb-0">Kelola koleksi buku perpustakaan</p>
            </div>
            @if($isAdmin)
            <div class="d-flex gap-2">
                <a href="{{ route('kategori.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-tags me-2"></i>Kelola Kategori
                </a>
                <a href="{{ route('penulis.index') }}" class="btn btn-outline-info">
            <i class="bi bi-people me-2"></i>Kelola Penulis
        </a>
        <a href="{{ route('laporan.data-buku') }}" target="_blank" class="btn btn-outline-success">
        <i class="bi bi-printer me-2"></i></i>Print Data
    </a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBukuModal">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Buku
                </button>
            </div>
            @endif
        </div>

        <!-- Books Grid -->
        <div class="row g-4">
            @foreach($buku as $item)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="book-card card h-100">
                    <!-- Book Cover & Badge -->
                    <div class="position-relative overflow-hidden">
                        @if($item->images->where('utama', true)->first())
                            <img src="{{ asset('storage/' . $item->images->where('utama', true)->first()->path) }}" 
                                 class="book-cover" 
                                 alt="{{ $item->judul }}">
                        @else
                            <div class="book-cover bg-gradient-primary d-flex align-items-center justify-content-center">
                                <div class="text-center text-white">
                                    <i class="bi bi-book display-4"></i>
                                    <p class="mt-2 mb-0 fw-semibold">No Cover</p>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Stock Badge -->
                        <span class="book-badge badge {{ $item->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                            <i class="bi bi-{{ $item->stok > 0 ? 'check' : 'x' }}-circle me-1"></i>
                            {{ $item->stok }} Stok
                        </span>

                       @if($isAdmin)
                        <div class="book-actions">
                            <a href="{{ route('buku.edit', $item->id) }}" class="btn-action" title="Edit Buku">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('buku.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action" 
                                        onclick="return confirm('Hapus buku ini?')"
                                        title="Hapus Buku">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                        @endif

                        <!-- Book Info Overlay (muncul saat hover) -->
                        <div class="book-info">
                            <h6 class="book-title">{{ $item->judul }}</h6>
                            <div class="book-meta">
                                <div class="mb-1">
                                    <i class="bi bi-person me-1"></i>
                                    <strong>Penulis:</strong> {{ $item->penulis->nama ?? '-' }}
                                </div>
                                <div class="mb-1">
                                    <i class="bi bi-building me-1"></i>
                                    <strong>Penerbit:</strong> {{ $item->penerbit ?? '-' }}
                                </div>
                                <div class="mb-1">
                                    <i class="bi bi-calendar me-1"></i>
                                    <strong>Tahun:</strong> {{ $item->tahun_terbit ?? '-' }}
                                </div>
                                <div class="mb-2">
                                    <i class="bi bi-tag me-1"></i>
                                    <strong>Kategori:</strong> {{ $item->kategori->nama ?? '-' }}
                                </div>
                                @if($item->deskripsi)
                                    <p class="small mb-2">{{ Str::limit($item->deskripsi, 100) }}</p>
                                @endif
                                <div class="d-flex justify-content-between align-items-center">
                                    <small>
                                        <i class="bi bi-images me-1"></i>
                                        {{ $item->images->count() }} gambar
                                    </small>
                                    <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('buku.show', $item->id) }}" class="btn btn-sm btn-outline-light m-1">
                                        <i class="bi bi-eye me-1"></i>Detail
                                    </a>
                                    
                                    @if(Auth::user()->role->nama !== 'Admin' && $item->stok > 0)
                                        <a href="{{ route('peminjaman.create') }}?buku_id={{ $item->id }}" 
                                        class="btn btn-sm btn-outline-light" title="Pinjam Buku">
                                            <i class="bi bi-cart-plus"></i>Pinjam
                                        </a>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <h6 class="card-title fw-bold text-truncate">{{ $item->judul }}</h6>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">{{ $item->penulis->nama ?? '-' }}</small>
                            <small class="text-muted">{{ $item->tahun_terbit ?? '-' }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($buku->hasPages())
        <div class="d-flex justify-content-center mt-5">
            <nav>
                {{ $buku->links() }}
            </nav>
        </div>
        @endif

        @if($buku->count() == 0)
        <div class="text-center py-5">
            <div class="empty-state-icon mb-4">
                <i class="bi bi-book display-1 text-muted"></i>
            </div>
            <h5 class="text-muted mb-3">Belum ada buku</h5>
            <p class="text-muted mb-4">Mulai dengan menambahkan buku pertama Anda ke perpustakaan.</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBukuModal">
                <i class="bi bi-plus-circle me-2"></i>Tambah Buku Pertama
            </button>
        </div>
        @endif
    </div>

    <!-- Modal Tambah Buku -->
    <div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-labelledby="tambahBukuModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahBukuModalLabel">Tambah Buku Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Judul Buku <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="judul" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">ISBN</label>
                                    <input type="text" class="form-control" name="isbn">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-select" name="kategori_id" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategories as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Penulis <span class="text-danger">*</span></label>
                                    <select class="form-select" name="penulis_id" required>
                                        <option value="">Pilih Penulis</option>
                                        @foreach($penulis as $penulis)
                                            <option value="{{ $penulis->id }}">{{ $penulis->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Penerbit</label>
                                    <input type="text" class="form-control" name="penerbit">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tahun Terbit</label>
                                    <input type="number" class="form-control" name="tahun_terbit" 
                                           min="1900" max="{{ date('Y') }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Jumlah Halaman</label>
                                    <input type="number" class="form-control" name="jumlah_halaman" min="1">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Stok <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="stok" min="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="3"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Cover Buku</label>
                                    <input type="file" class="form-control" name="cover_image" 
                                           accept="image/jpeg,image/png,image/jpg">
                                    <div class="form-text">Gambar ini akan menjadi cover utama</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Gambar Tambahan</label>
                                    <input type="file" class="form-control" name="additional_images[]" 
                                           multiple accept="image/jpeg,image/png,image/jpg">
                                    <div class="form-text">Pilih multiple gambar untuk detail</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Buku</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Reset form ketika modal tambah ditutup
        document.getElementById('tambahBukuModal').addEventListener('hidden.bs.modal', function () {
            this.querySelector('form').reset();
        });
    </script>
    @endpush
</x-app-layout>
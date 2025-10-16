@php
    $pageTitle = 'Detail Buku';
@endphp

<x-app-layout>
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Detail Buku</h4>
                <p class="text-muted mb-0">Informasi lengkap tentang buku</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('buku') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
                                        @if(Auth::user()->role->nama !== 'Admin' && $buku->stok > 0)
                            <a href="{{ route('peminjaman.create') }}?buku_id={{ $buku->id }}" 
                            class="btn btn-success">
                                <i class="bi bi-cart-plus me-1"></i>Pinjam Buku
                            </a>
                        @endif
            </div>
        </div>

        <div class="row">
            <!-- Book Images Section -->
            <div class="col-lg-5 mb-4">
                <div class="card">
                    <div class="card-body">
                        <!-- Main Cover Image -->
                        <div class="text-center mb-4">
                            @if($coverImage = $buku->images->where('utama', true)->first())
                                <img src="{{ asset('storage/' . $coverImage->path) }}" 
                                     class="img-fluid rounded shadow" 
                                     alt="{{ $buku->judul }}"
                                     style="max-height: 400px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                     style="height: 400px;">
                                    <div class="text-center text-muted">
                                        <i class="bi bi-book display-1"></i>
                                        <p class="mt-3 mb-0 fw-semibold">Tidak Ada Cover</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Additional Images -->
                        @if($buku->images->where('utama', false)->count() > 0)
                        <div>
                            <h6 class="fw-bold mb-3">Gambar Lainnya</h6>
                            <div class="row g-2">
                                @foreach($buku->images->where('utama', false) as $image)
                                <div class="col-4">
                                    <img src="{{ asset('storage/' . $image->path) }}" 
                                         class="img-thumbnail w-100" 
                                         alt="{{ $image->alt }}"
                                         style="height: 100px; object-fit: cover; cursor: pointer;"
                                         onclick="openImageModal('{{ asset('storage/' . $image->path) }}')">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Book Details Section -->
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <!-- Book Title & Status -->
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h2 class="fw-bold text-primary mb-2">{{ $buku->judul }}</h2>
                                <div class="d-flex gap-2 mb-3">
                                    <span class="badge {{ $buku->stok > 0 ? 'bg-success' : 'bg-danger' }} fs-6">
                                        <i class="bi bi-{{ $buku->stok > 0 ? 'check' : 'x' }}-circle me-1"></i>
                                        {{ $buku->stok > 0 ? 'Tersedia' : 'Habis' }} ({{ $buku->stok }} stok)
                                    </span>
                                    <span class="badge bg-secondary fs-6">
                                        {{ $buku->kategori->nama ?? 'Tidak ada kategori' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Book Information Grid -->
                        <div class="row g-4">
                            <!-- Basic Information -->
                            <div class="col-md-6">
                                <h5 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-info-circle me-2"></i>Informasi Buku
                                </h5>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-muted mb-1">ISBN</label>
                                    <p class="mb-0">{{ $buku->isbn ?: '-' }}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-muted mb-1">Penulis</label>
                                    <p class="mb-0">{{ $buku->penulis->nama ?? 'Tidak ada penulis' }}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-muted mb-1">Penerbit</label>
                                    <p class="mb-0">{{ $buku->penerbit ?: '-' }}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-muted mb-1">Tahun Terbit</label>
                                    <p class="mb-0">{{ $buku->tahun_terbit ?: '-' }}</p>
                                </div>
                            </div>

                            <!-- Additional Information -->
                            <div class="col-md-6">
                                <h5 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-file-text me-2"></i>Detail Lainnya
                                </h5>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-muted mb-1">Kategori</label>
                                    <p class="mb-0">{{ $buku->kategori->nama ?? 'Tidak ada kategori' }}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-muted mb-1">Jumlah Halaman</label>
                                    <p class="mb-0">{{ $buku->jumlah_halaman ? $buku->jumlah_halaman . ' halaman' : '-' }}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-muted mb-1">Stok Tersedia</label>
                                    <p class="mb-0 fs-5 fw-bold {{ $buku->stok > 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $buku->stok }} buku
                                    </p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-muted mb-1">Total Gambar</label>
                                    <p class="mb-0">{{ $buku->images->count() }} gambar</p>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        @if($buku->deskripsi)
                        <div class="mt-4">
                            <h5 class="fw-bold text-primary mb-3">
                                <i class="bi bi-card-text me-2"></i>Deskripsi
                            </h5>
                            <div class="bg-light rounded p-4">
                                <p class="mb-0" style="line-height: 1.6; white-space: pre-line;">{{ $buku->deskripsi }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Metadata -->
                        <div class="mt-4 pt-4 border-top">
                            <div class="row text-muted">
                                <div class="col-md-6">
                                    <small>
                                        <i class="bi bi-calendar-plus me-1"></i>
                                        Dibuat: {{ $buku->created_at->translatedFormat('d F Y H:i') }}
                                    </small>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <small>
                                        <i class="bi bi-calendar-check me-1"></i>
                                        Diupdate: {{ $buku->updated_at->translatedFormat('d F Y H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                @if(Auth::user()->role->nama == 'Admin')
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-1">Kelola Buku</h6>
                                <p class="text-muted mb-0">Aksi yang dapat dilakukan pada buku ini</p>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil me-2"></i>Edit Buku
                                </a>
                                <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Hapus buku {{ $buku->judul }}? Tindakan ini tidak dapat dibatalkan.')">
                                        <i class="bi bi-trash me-2"></i>Hapus Buku
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preview Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid" alt="Preview">
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function openImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            new bootstrap.Modal(document.getElementById('imageModal')).show();
        }

        // Confirm delete
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForm = document.querySelector('form[action*="destroy"]');
            if (deleteForm) {
                deleteForm.addEventListener('submit', function(e) {
                    if (!confirm('Apakah Anda yakin ingin menghapus buku ini? Tindakan ini tidak dapat dibatalkan.')) {
                        e.preventDefault();
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
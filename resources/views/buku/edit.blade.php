@php
    $pageTitle = 'Edit Buku';
@endphp

<x-app-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Edit Buku</h4>
                <p class="text-muted mb-0">Edit data buku: {{ $buku->judul }}</p>
            </div>
            <a href="{{ route('buku') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Buku
            </a>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('buku.update', $buku) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6">

                                    
                                    <div class="mb-3">
                                        <label class="form-label">Judul Buku <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                               name="judul" value="{{ old('judul', $buku->judul) }}" required>
                                        @error('judul')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">ISBN</label>
                                        <input type="text" class="form-control @error('isbn') is-invalid @enderror" 
                                               name="isbn" value="{{ old('isbn', $buku->isbn) }}">
                                        @error('isbn')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                        <select class="form-select @error('kategori_id') is-invalid @enderror" name="kategori_id" required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach($kategories as $kategori)
                                                <option value="{{ $kategori->id }}" 
                                                    {{ old('kategori_id', $buku->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                                    {{ $kategori->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Penulis <span class="text-danger">*</span></label>
                                        <select class="form-select @error('penulis_id') is-invalid @enderror" name="penulis_id" required>
                                            <option value="">Pilih Penulis</option>
                                            @foreach($penulises as $penulis)
                                                <option value="{{ $penulis->id }}"
                                                    {{ old('penulis_id', $buku->penulis_id) == $penulis->id ? 'selected' : '' }}>
                                                    {{ $penulis->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('penulis_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">


                                    <div class="mb-3">
                                        <label class="form-label">Penerbit</label>
                                        <input type="text" class="form-control @error('penerbit') is-invalid @enderror" 
                                               name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}">
                                        @error('penerbit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Tahun Terbit</label>
                                        <input type="number" class="form-control @error('tahun_terbit') is-invalid @enderror" 
                                               name="tahun_terbit" min="1900" max="{{ date('Y') }}"
                                               value="{{ old('tahun_terbit', $buku->tahun_terbit) }}">
                                        @error('tahun_terbit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Jumlah Halaman</label>
                                        <input type="number" class="form-control @error('jumlah_halaman') is-invalid @enderror" 
                                               name="jumlah_halaman" min="1"
                                               value="{{ old('jumlah_halaman', $buku->jumlah_halaman) }}">
                                        @error('jumlah_halaman')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Stok <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                                               name="stok" min="0" value="{{ old('stok', $buku->stok) }}" required>
                                        @error('stok')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-4">
                                <h5 class="mb-3 text-primary">
                                    <i class="bi bi-card-text me-2"></i>Deskripsi
                                </h5>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                          name="deskripsi" rows="4" placeholder="Masukkan deskripsi buku...">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gambar Buku -->
                            <div class="mb-4">
                                <h5 class="mb-3 text-primary">
                                    <i class="bi bi-images me-2"></i>Gambar Buku
                                </h5>
                            

                                <!-- Upload New Images -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Cover Buku Baru</label>
                                            <input type="file" class="form-control @error('cover_image') is-invalid @enderror" 
                                                   name="cover_image" accept="image/jpeg,image/png,image/jpg">
                                            <div class="form-text">
                                                Upload cover baru. Jika diisi, akan menggantikan cover lama.
                                            </div>
                                            @error('cover_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Gambar Tambahan Baru</label>
                                            <input type="file" class="form-control @error('additional_images.*') is-invalid @enderror" 
                                                   name="additional_images[]" multiple accept="image/jpeg,image/png,image/jpg">
                                            <div class="form-text">Pilih multiple gambar untuk menambah gambar detail buku.</div>
                                            @error('additional_images.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-top pt-4">
                                <div>
                                    <small class="text-muted">
                                        <i class="bi bi-clock me-1"></i>
                                        Terakhir diupdate: {{ $buku->updated_at->format('d M Y H:i') }}
                                    </small>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle me-2"></i>Update Buku
                                    </button>
                                </div>
                            </div>
                        </form>

                                                        <!-- Current Images -->
                                @if($buku->images->count() > 0)
                                <div class="mb-4">
                                    <label class="form-label d-block">Gambar Saat Ini</label>
                                    <div class="row g-3">
                                        @foreach($buku->images as $image)
                                        <div class="col-md-3">
                                            <div class="card position-relative">
                                                <img src="{{ asset('storage/' . $image->path) }}" 
                                                     class="card-img-top" 
                                                     alt="{{ $image->alt }}"
                                                     style="height: 150px; object-fit: cover;">
                                                <div class="card-body p-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        @if($image->utama)
                                                            <span class="badge bg-primary">Cover Utama</span>
                                                        @else
                                                            <span class="badge bg-secondary">Gambar</span>
                                                        @endif
                                                        <form action="{{ route('buku.images.destroy', $image->id) }}" 
                                                              method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    class="btn btn-sm btn-danger"
                                                                    onclick="return confirm('Hapus gambar ini?')">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                    @if(!$image->utama)
                                                    <form action="{{ route('buku.images.set-cover', $image->id) }}" 
                                                          method="POST" class="mt-2">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-outline-primary w-100">
                                                            Jadikan Cover
                                                        </button>
                                                    </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>

        document.querySelector('input[name="cover_image"]')?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Bisa tambahkan preview di sini jika diperlukan
                    console.log('New cover image selected:', file.name);
                }
                reader.readAsDataURL(file);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('form[action*="destroy"]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Apakah Anda yakin ingin menghapus?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
    @endpush
    
</x-app-layout>
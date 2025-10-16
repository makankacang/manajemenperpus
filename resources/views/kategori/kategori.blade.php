@php
    $pageTitle = 'Data Kategori';
@endphp

<x-app-layout>
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Data Kategori</h4>
                <p class="text-muted mb-0">Kelola kategori buku perpustakaan</p>
            </div>
            <a href="{{ route('buku') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Buku
            </a>
        </div>

        <div class="row">
            <!-- Form Tambah/Edit Kategori -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-header" id="formHeader">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Kategori Baru
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kategori.store') }}" method="POST" id="kategoriForm">
                            @csrf
                            <div id="formMethod"></div>
                            
                            <div class="mb-3">
                                <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                       name="nama" value="{{ old('nama') }}" 
                                       placeholder="Contoh: Novel, Sains, Sejarah" 
                                       id="inputNama" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                          name="deskripsi" rows="3" 
                                          placeholder="Deskripsi kategori (opsional)"
                                          id="inputDeskripsi">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" id="submitButton">
                                    <i class="bi bi-check-circle me-2"></i>Simpan Kategori
                                </button>
                                <button type="button" class="btn btn-secondary" id="cancelButton" style="display: none;" 
                                        onclick="resetForm()">
                                    <i class="bi bi-x-circle me-2"></i>Batal Edit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Daftar Kategori -->
            <div class="col-lg-8">
                <div class="row">
                    @foreach($kategori as $item)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title fw-bold text-primary">{{ $item->nama }}</h5>
                                </div>

                                @if($item->deskripsi)
                                <p class="card-text text-muted mb-3">{{ $item->deskripsi }}</p>
                                @endif

                                <!-- Buku dalam kategori ini -->
                                <div class="mb-3">
                                    <small class="text-muted d-block mb-2">
                                        <i class="bi bi-book me-1"></i>
                                        <strong>{{ $item->buku->count() }}</strong> buku dalam kategori ini
                                    </small>
                                    
                                    @if($item->buku->count() > 0)
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($item->buku->take(3) as $buku)
                                        <span class="badge bg-light text-dark border small">
                                            {{ Str::limit($buku->judul, 15) }}
                                        </span>
                                        @endforeach
                                        @if($item->buku->count() > 3)
                                        <span class="badge bg-secondary small">
                                            +{{ $item->buku->count() - 3 }} lainnya
                                        </span>
                                        @endif
                                    </div>
                                    @else
                                    <span class="badge bg-warning text-dark">Belum ada buku</span>
                                    @endif
                                </div>

                                <!-- Quick Action Buttons -->
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-outline-warning btn-sm flex-fill"
                                            onclick="editKategori({{ $item->id }}, '{{ $item->nama }}', `{{ $item->deskripsi }}`)">
                                        <i class="bi bi-pencil me-1"></i>Edit
                                    </button>
                                    <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="d-inline flex-fill">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm w-100"
                                                onclick="return confirm('Hapus kategori {{ $item->nama }}?')">
                                            <i class="bi bi-trash me-1"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Empty State -->
                @if($kategori->count() == 0)
                <div class="text-center py-5">
                    <div class="empty-state-icon mb-4">
                        <i class="bi bi-tags display-1 text-muted"></i>
                    </div>
                    <h5 class="text-muted mb-3">Belum ada kategori</h5>
                    <p class="text-muted mb-4">Gunakan form di samping untuk menambahkan kategori pertama Anda.</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let currentEditId = null;

        function editKategori(id, nama, deskripsi) {
            // Set current edit ID
            currentEditId = id;
            
            // Update form header
            document.getElementById('formHeader').innerHTML = `
                <h5 class="card-title mb-0 text-warning">
                    <i class="bi bi-pencil me-2"></i>Edit Kategori
                </h5>
            `;
            
            // Update form action and method
            document.getElementById('kategoriForm').action = `/kategori/${id}`;
            document.getElementById('formMethod').innerHTML = '<input type="hidden" name="_method" value="PUT">';
            
            // Set form values
            document.getElementById('inputNama').value = nama;
            document.getElementById('inputDeskripsi').value = deskripsi;
            
            // Update submit button
            document.getElementById('submitButton').innerHTML = '<i class="bi bi-check-circle me-2"></i>Update Kategori';
            document.getElementById('submitButton').classList.remove('btn-primary');
            document.getElementById('submitButton').classList.add('btn-warning');
            
            // Show cancel button
            document.getElementById('cancelButton').style.display = 'block';
            
            // Focus on input
            document.getElementById('inputNama').focus();
        }

        function resetForm() {
            // Reset current edit ID
            currentEditId = null;
            
            // Update form header
            document.getElementById('formHeader').innerHTML = `
                <h5 class="card-title mb-0">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Kategori Baru
                </h5>
            `;
            
            // Reset form action and method
            document.getElementById('kategoriForm').action = '{{ route("kategori.store") }}';
            document.getElementById('formMethod').innerHTML = '';
            
            // Clear form values
            document.getElementById('inputNama').value = '';
            document.getElementById('inputDeskripsi').value = '';
            
            // Reset submit button
            document.getElementById('submitButton').innerHTML = '<i class="bi bi-check-circle me-2"></i>Simpan Kategori';
            document.getElementById('submitButton').classList.remove('btn-warning');
            document.getElementById('submitButton').classList.add('btn-primary');
            
            // Hide cancel button
            document.getElementById('cancelButton').style.display = 'none';
            
            // Clear validation classes
            document.getElementById('inputNama').classList.remove('is-invalid');
            document.getElementById('inputDeskripsi').classList.remove('is-invalid');
        }

        // Reset form when page loads
        document.addEventListener('DOMContentLoaded', function() {
            resetForm();
        });

        // Confirm delete
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('form[action*="destroy"]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                        e.preventDefault();
                    }
                });
            });
        });

        // Handle form submission success
        @if(session('success'))
            resetForm();
        @endif
    </script>
    @endpush
</x-app-layout>
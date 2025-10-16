@php
    $pageTitle = 'Data Pengembalian';
    $isAdmin = Auth::user()->role->nama === 'Admin';
@endphp

<x-app-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Data Pengembalian</h4>
                <p class="text-muted mb-0">Riwayat pengembalian buku perpustakaan</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Peminjaman
                </a>
                @if($isAdmin)
                <a href="{{ route('laporan.semua-pengembalian') }}" target="_blank" class="btn btn-outline-success">
                    <i class="bi bi-printer me-2"></i>Print Data
                </a>
                <a href="{{ route('pengembalian.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Pengembalian
                </a>
                @endif
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Peminjaman</th>
                                <th>Buku</th>
                                <th>Peminjam</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Kondisi Buku</th>
                                <th>Denda</th>
                                <th>Petugas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengembalian as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <code class="bg-light px-2 py-1 rounded">{{ $item->peminjaman->kode_peminjaman }}</code>
                                </td>
                                <td>
                                    <strong>{{ $item->buku->judul ?? $item->peminjaman->buku->judul }}</strong>
                                </td>
                                <td>{{ $item->user->name ?? $item->peminjaman->user->name }}</td>
                                <td>{{ $item->tanggal_pengembalian->format('d M Y') }}</td>
                                <td>
                                    @if($item->kondisi_buku == 'baik')
                                        <span class="badge bg-success">Baik</span>
                                    @elseif($item->kondisi_buku == 'rusak_ringan')
                                        <span class="badge bg-warning text-dark">Rusak Ringan</span>
                                    @elseif($item->kondisi_buku == 'rusak_berat')
                                        <span class="badge bg-danger">Rusak Berat</span>
                                    @elseif($item->kondisi_buku == 'hilang')
                                        <span class="badge bg-dark">Hilang</span>
                                    @endif
                                </td>
                                <td>
                                    <strong class="text-danger">Rp {{ number_format($item->denda, 0, ',', '.') }}</strong>
                                </td>
                                <td>{{ $item->petugas->name }}</td>
                                <td>
                                    @if($isAdmin)
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" 
                                                data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <button class="dropdown-item" data-bs-toggle="modal" 
                                                        data-bs-target="#detailPengembalianModal{{ $item->id }}">
                                                    <i class="bi bi-eye me-2"></i>Detail
                                                </button>
                                            </li>
                                            <li>
                                                <form action="{{ route('pengembalian.destroy', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" 
                                                            onclick="return confirm('Hapus data pengembalian? Status peminjaman akan dikembalikan ke \"dipinjam\"')">
                                                        <i class="bi bi-trash me-2"></i>Hapus
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($pengembalian->count() == 0)
                <div class="text-center py-5">
                    <i class="bi bi-arrow-return-left display-1 text-muted"></i>
                    <h5 class="text-muted mb-3">Belum ada data pengembalian</h5>
                    <p class="text-muted mb-4">Tidak ada riwayat pengembalian buku.</p>
                    @if($isAdmin)
                    <a href="{{ route('pengembalian.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Pengembalian Pertama
                    </a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- MODALS SECTION - Dipindahkan ke luar loop -->
    @foreach($pengembalian as $item)
    <!-- Modal Detail Pengembalian -->
    <div class="modal fade" id="detailPengembalianModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pengembalian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <strong>Kode Peminjaman:</strong>
                        <p><code>{{ $item->peminjaman->kode_peminjaman }}</code></p>
                    </div>
                    <div class="mb-3">
                        <strong>Buku:</strong>
                        <p>{{ $item->peminjaman->buku->judul }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Peminjam:</strong>
                        <p>{{ $item->peminjaman->user->name }}</p>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <strong>Tanggal Pinjam:</strong>
                            <p>{{ $item->peminjaman->tanggal_pinjam->format('d M Y') }}</p>
                        </div>
                        <div class="col-6 mb-3">
                            <strong>Jatuh Tempo:</strong>
                            <p>{{ $item->peminjaman->tanggal_jatuh_tempo->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <strong>Tanggal Kembali:</strong>
                            <p>{{ $item->tanggal_pengembalian->format('d M Y') }}</p>
                        </div>
                        <div class="col-6 mb-3">
                            <strong>Kondisi Buku:</strong>
                            <p>
                                @if($item->kondisi_buku == 'baik')
                                    <span class="badge bg-success">Baik</span>
                                @elseif($item->kondisi_buku == 'rusak_ringan')
                                    <span class="badge bg-warning text-dark">Rusak Ringan</span>
                                @elseif($item->kondisi_buku == 'rusak_berat')
                                    <span class="badge bg-danger">Rusak Berat</span>
                                @elseif($item->kondisi_buku == 'hilang')
                                    <span class="badge bg-dark">Hilang</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <strong>Denda:</strong>
                        <p class="fw-bold text-danger">Rp {{ number_format($item->denda, 0, ',', '.') }}</p>
                    </div>
                    @if($item->catatan)
                    <div class="mb-3">
                        <strong>Catatan:</strong>
                        <p>{{ $item->catatan }}</p>
                    </div>
                    @endif
                    <div class="mb-3">
                        <strong>Petugas:</strong>
                        <p>{{ $item->petugas->name }}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide alerts after 5 seconds
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);

            // Delete confirmation with better message
            const deleteForms = document.querySelectorAll('form[action*="destroy"]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const kodePeminjaman = this.closest('tr').querySelector('code').textContent;
                    if (!confirm(`Hapus data pengembalian untuk peminjaman ${kodePeminjaman}? Status peminjaman akan dikembalikan ke "dipinjam".`)) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
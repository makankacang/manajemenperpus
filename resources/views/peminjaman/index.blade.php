@php
    $pageTitle = 'Data Peminjaman';
    $isAdmin = Auth::user()->role->nama === 'Admin';
@endphp

<x-app-layout>
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Data Peminjaman</h4>
                <p class="text-muted mb-0">
                    @if($isAdmin)
                        Kelola semua peminjaman buku
                    @else
                        Riwayat peminjaman Anda
                    @endif
                </p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('buku') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Buku
                </a>
                @if($isAdmin)
                 <a href="{{ route('laporan.semua-peminjaman') }}" target="_blank" class="btn btn-outline-success">
        <i class="bi bi-printer me-2"></i></i>Print Data
    </a>
    @endif
                @if(!$isAdmin)
               
                <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Ajukan Peminjaman
                </a>
                @endif
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Peminjaman Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                @if($isAdmin)
                                <th>User</th>
                                @endif
                                <th>Buku</th>
                                @if(!$isAdmin)
                                <th>Kode Peminjaman</th>
                                @endif
                                <th>Tanggal Pinjam</th>
                                <th>Jatuh Tempo</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjaman as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @if($isAdmin)
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" 
                                             style="width: 32px; height: 32px; font-size: 0.8rem;">
                                            {{ strtoupper(substr($item->user->name, 0, 1)) }}
                                        </div>
                                        {{ $item->user->name }}
                                    </div>
                                </td>
                                @endif
                                <td>
                                    <strong>{{ $item->buku->judul }}</strong><br>
                                    <small class="text-muted">oleh {{ $item->buku->penulis->nama ?? '-' }}</small>
                                </td>
                                @if(!$isAdmin)
                                <td>
                                    <code class="bg-light px-2 py-1 rounded">{{ $item->kode_peminjaman }}</code>
                                </td>
                                @endif
                                <td>
                                    @if($item->tanggal_pinjam)
                                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                                </td>
                                <td>
                                    @if($item->status == 'menunggu_konfirmasi')
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-clock me-1"></i>Menunggu Konfirmasi
                                        </span>
                                    @elseif($item->status == 'dipinjam')
                                        <span class="badge bg-primary">
                                            <i class="bi bi-book me-1"></i>Dipinjam
                                        </span>
                                    @elseif($item->status == 'dikembalikan')
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle me-1"></i>Dikembalikan
                                        </span>
                                    @elseif($item->status == 'ditolak')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-x-circle me-1"></i>Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" 
                                                data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <button class="dropdown-item" data-bs-toggle="modal" 
                                                        data-bs-target="#detailPeminjamanModal{{ $item->id }}">
                                                    <i class="bi bi-eye me-2"></i>Detail
                                                </button>
                                            </li>
                                            
                                            <!-- Aksi untuk User -->
                                            @if(!$isAdmin && $item->status == 'menunggu_konfirmasi')
                                            <li>
                                                <form action="{{ route('peminjaman.destroy', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" 
                                                            onclick="return confirm('Batalkan peminjaman?')">
                                                        <i class="bi bi-trash me-2"></i>Batalkan
                                                    </button>
                                                </form>
                                            </li>
                                            @endif

                                            <!-- Aksi untuk Admin -->
                                            @if($isAdmin)
                                                @if($item->status == 'menunggu_konfirmasi')
                                                <li>
                                                    <button class="dropdown-item text-success" data-bs-toggle="modal" 
                                                            data-bs-target="#confirmPeminjamanModal{{ $item->id }}">
                                                        <i class="bi bi-check-circle me-2"></i>Konfirmasi
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item text-danger" data-bs-toggle="modal" 
                                                            data-bs-target="#rejectPeminjamanModal{{ $item->id }}">
                                                        <i class="bi bi-x-circle me-2"></i>Tolak
                                                    </button>
                                                </li>
                                                @elseif($item->status == 'dipinjam')
                                                <li>
                                                    <button class="dropdown-item text-info" data-bs-toggle="modal" 
                                                            data-bs-target="#pengembalianModal{{ $item->id }}">
                                                        <i class="bi bi-arrow-return-left me-2"></i>Proses Pengembalian
                                                    </button>
                                                </li>
                                                @endif
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($peminjaman->count() == 0)
                <div class="text-center py-5">
                    <div class="empty-state-icon mb-4">
                        <i class="bi bi-journal-text display-1 text-muted"></i>
                    </div>
                    <h5 class="text-muted mb-3">
                        @if($isAdmin)
                            Belum ada peminjaman
                        @else
                            Belum ada riwayat peminjaman
                        @endif
                    </h5>
                    <p class="text-muted mb-4">
                        @if($isAdmin)
                            Tidak ada peminjaman yang diajukan.
                        @else
                            Mulai dengan meminjam buku pertama Anda.
                        @endif
                    </p>
                    @if(!$isAdmin)
                    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Ajukan Peminjaman Pertama
                    </a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- MODALS SECTION - Dipindahkan ke luar loop untuk menghindari duplikasi -->
    @foreach($peminjaman as $item)
    <!-- Modal Detail Peminjaman -->
    <div class="modal fade" id="detailPeminjamanModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <strong>Kode Peminjaman:</strong>
                        <p><code>{{ $item->kode_peminjaman }}</code></p>
                    </div>
                    <div class="mb-3">
                        <strong>Buku:</strong>
                        <p>{{ $item->buku->judul }}</p>
                    </div>
                    @if($isAdmin)
                    <div class="mb-3">
                        <strong>User:</strong>
                        <p>{{ $item->user->name }}</p>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-6 mb-3">
                            <strong>Tanggal Pinjam:</strong>
                            <p>{{ $item->tanggal_pinjam ? \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') : '-' }}</p>
                        </div>
                        <div class="col-6 mb-3">
                            <strong>Jatuh Tempo:</strong>
                            <p>{{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <strong>Status:</strong>
                        <p>
                            @if($item->status == 'menunggu_konfirmasi')
                                <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
                            @elseif($item->status == 'dipinjam')
                                <span class="badge bg-primary">Dipinjam</span>
                            @elseif($item->status == 'dikembalikan')
                                <span class="badge bg-success">Dikembalikan</span>
                            @elseif($item->status == 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </p>
                    </div>
                    @if($item->catatan)
                    <div class="mb-3">
                        <strong>Catatan:</strong>
                        <p>{{ $item->catatan }}</p>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    @if($isAdmin && $item->status == 'menunggu_konfirmasi')
    <!-- Modal Konfirmasi Peminjaman -->
    <div class="modal fade" id="confirmPeminjamanModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('peminjaman.confirm', $item->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Konfirmasi peminjaman buku <strong>{{ $item->buku->judul }}</strong> oleh <strong>{{ $item->user->name }}</strong>?</p>
                        <div class="mb-3">
                            <label class="form-label">Masukkan Kode Peminjaman:</label>
                            <input type="text" class="form-control" name="kode_konfirmasi" 
                                   placeholder="Masukkan kode yang diberikan user" required>
                            <div class="form-text">Minta kode peminjaman dari user untuk konfirmasi</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Konfirmasi Peminjaman</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tolak Peminjaman -->
    <div class="modal fade" id="rejectPeminjamanModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tolak Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('peminjaman.reject', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menolak peminjaman ini?</p>
                        <div class="mb-3">
                            <label class="form-label">Alasan Penolakan (opsional):</label>
                            <textarea class="form-control" name="catatan" rows="3" 
                                      placeholder="Berikan alasan penolakan..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tolak Peminjaman</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    @if($isAdmin && $item->status == 'dipinjam')
    <!-- Modal Pengembalian -->
    <div class="modal fade" id="pengembalianModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Proses Pengembalian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Detail Peminjaman</h6>
                            <div class="mb-3">
                                <strong>Buku:</strong>
                                <p>{{ $item->buku->judul }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Peminjam:</strong>
                                <p>{{ $item->user->name }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Tanggal Pinjam:</strong>
                                <p>{{ $item->tanggal_pinjam->format('d M Y') }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Jatuh Tempo:</strong>
                                <p>{{ $item->tanggal_jatuh_tempo->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>Informasi Pengembalian</h6>
                            @php
                                $today = \Carbon\Carbon::now();
                                $jatuhTempo = \Carbon\Carbon::parse($item->tanggal_jatuh_tempo);
                                $keterlambatan = $today->greaterThan($jatuhTempo) ? $today->diffInDays($jatuhTempo) : 0;
                                $perkiraanDenda = $keterlambatan * 5000;
                            @endphp
                            <div class="mb-3">
                                <strong>Tanggal Hari Ini:</strong>
                                <p>{{ $today->format('d M Y') }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Keterlambatan:</strong>
                                <p>
                                    @if($keterlambatan > 0)
                                        <span class="text-danger">{{ $keterlambatan }} hari</span>
                                    @else
                                        <span class="text-success">Tepat waktu</span>
                                    @endif
                                </p>
                            </div>
                            <div class="mb-3">
                                <strong>Perkiraan Denda:</strong>
                                <p class="fw-bold text-danger">Rp {{ number_format($perkiraanDenda, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info mt-3">
                        <i class="bi bi-info-circle me-2"></i>
                        Untuk memproses pengembalian, klik tombol di bawah dan isi form pengembalian.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a href="{{ route('pengembalian.create') }}?peminjaman_id={{ $item->id }}" 
                    class="btn btn-primary">
                        <i class="bi bi-arrow-return-left me-2"></i>Proses Pengembalian
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach

    @push('styles')
    <style>
        .avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        code {
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide alerts
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });
    </script>
    @endpush
</x-app-layout>
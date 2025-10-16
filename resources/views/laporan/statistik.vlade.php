<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @media print { .no-print { display: none !important; } }
        .stat-card { border-radius: 10px; padding: 20px; margin-bottom: 20px; color: white; }
        .stat-card i { font-size: 2rem; margin-bottom: 10px; }
        .bg-book { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .bg-user { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .bg-borrow { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .bg-return { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
        .bg-money { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
        .bg-active { background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); color: #333; }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="text-center mb-4">
            <h1 class="mb-1">STATISTIK PERPUSTAKAAN</h1>
            <h4 class="mb-1">PERPUSTAKAAN DIGITAL</h4>
            <p class="mb-0">Periode: {{ now()->format('d F Y') }}</p>
        </div>

        <!-- Statistik Cards -->
        <div class="row">
            <div class="col-md-3">
                <div class="stat-card bg-book text-center">
                    <i class="fas fa-book"></i>
                    <h3>{{ $totalBuku }}</h3>
                    <p class="mb-0">Total Buku</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card bg-user text-center">
                    <i class="fas fa-users"></i>
                    <h3>{{ $totalAnggota }}</h3>
                    <p class="mb-0">Total Anggota</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card bg-borrow text-center">
                    <i class="fas fa-hand-holding"></i>
                    <h3>{{ $totalPeminjaman }}</h3>
                    <p class="mb-0">Total Peminjaman</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card bg-return text-center">
                    <i class="fas fa-arrow-return-left"></i>
                    <h3>{{ $totalPengembalian }}</h3>
                    <p class="mb-0">Total Pengembalian</p>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="stat-card bg-active text-center">
                    <i class="fas fa-clock"></i>
                    <h3>{{ $peminjamanAktif }}</h3>
                    <p class="mb-0">Peminjaman Aktif</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stat-card bg-money text-center">
                    <i class="fas fa-money-bill-wave"></i>
                    <h3>Rp {{ number_format($totalDenda, 0, ',', '.') }}</h3>
                    <p class="mb-0">Total Denda</p>
                </div>
            </div>
        </div>

        <!-- Buku Populer -->
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-trophy me-2"></i>5 Buku Terpopuler</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th>Total Dipinjam</th>
                                <th>Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bukuPopuler as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->penulis->nama ?? '-' }}</td>
                                <td>{{ $item->peminjaman_count }} kali</td>
                                <td>
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= min(5, $item->peminjaman_count / 2))
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-4 text-muted">
            <p class="mb-0">Dicetak pada: {{ now()->format('d F Y H:i:s') }} oleh {{ Auth::user()->name }}</p>
        </div>
    </div>

    <!-- Tombol Print -->
    <div class="container-fluid mt-4 no-print">
        <div class="text-center">
            <button onclick="window.print()" class="btn btn-primary btn-lg">
                <i class="fas fa-print me-2"></i>Print Laporan
            </button>
            <a href="{{ route('pengembalian.index') }}" class="btn btn-secondary btn-lg ms-2">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
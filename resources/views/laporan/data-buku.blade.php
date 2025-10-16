<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Buku - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none !important; }
            body { font-size: 12px; margin: 0; padding: 10px; }
            .table { font-size: 11px; }
        }
        
        .header-laporan { border-bottom: 3px double #333; padding-bottom: 15px; margin-bottom: 20px; }
        .footer-laporan { border-top: 1px solid #333; padding-top: 10px; margin-top: 20px; }
        .table-laporan { font-size: 14px; }
        .table-laporan th { background-color: #f8f9fa !important; font-weight: 600; }
        .summary-box { background: #f8f9fa; border-left: 4px solid #28a745; padding: 15px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Header -->
        <div class="header-laporan text-center">
            <h2 class="mb-1">LAPORAN DATA BUKU</h2>
            <h4 class="mb-1">PERPUSTAKAAN DIGITAL</h4>
            <p class="mb-0">Periode: {{ now()->format('d F Y') }}</p>
        </div>

        <!-- Summary -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="summary-box">
                    <div class="row">
                        <div class="col-md-3">
                            <strong>Total Buku:</strong> {{ $buku->count() }}
                        </div>
                        <div class="col-md-3">
                            <strong>Total Stok:</strong> {{ $buku->sum('stok') }}
                        </div>
                        <div class="col-md-3">
                            <strong>Kategori:</strong> {{ $buku->pluck('kategori_id')->unique()->count() }}
                        </div>
                        <div class="col-md-3">
                            <strong>Penulis:</strong> {{ $buku->pluck('penulis_id')->unique()->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-bordered table-laporan table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>ISBN</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th>Halaman</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($buku as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->isbn ?? '-' }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->penulis->nama ?? '-' }}</td>
                        <td>{{ $item->kategori->nama ?? '-' }}</td>
                        <td>{{ $item->penerbit ?? '-' }}</td>
                        <td>{{ $item->tahun_terbit ?? '-' }}</td>
                        <td class="text-center">
                            @if($item->stok > 5)
                                <span class="badge bg-success">{{ $item->stok }}</span>
                            @elseif($item->stok > 0)
                                <span class="badge bg-warning text-dark">{{ $item->stok }}</span>
                            @else
                                <span class="badge bg-danger">Habis</span>
                            @endif
                        </td>
                        <td class="text-center">{{ $item->jumlah_halaman ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-dark">
                    <tr>
                        <td colspan="7" class="text-end"><strong>TOTAL STOK:</strong></td>
                        <td class="text-center fw-bold">{{ $buku->sum('stok') }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer-laporan">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0"><strong>Dicetak oleh:</strong> {{ Auth::user()->name }}</p>
                </div>
                <div class="col-md-6 text-end">
                    <p class="mb-0"><strong>Tanggal cetak:</strong> {{ now()->format('d F Y H:i:s') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Print -->
    <div class="container-fluid mt-4 no-print">
        <div class="text-center">
            <button onclick="window.print()" class="btn btn-primary btn-lg">
                <i class="fas fa-print me-2"></i>Print Laporan
            </button>
            <a href="{{ route('buku') }}" class="btn btn-secondary btn-lg ms-2">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
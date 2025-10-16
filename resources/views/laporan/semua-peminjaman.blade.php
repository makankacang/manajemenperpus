<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Semua Peminjaman - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            .container {
                max-width: 100% !important;
            }
            body {
                font-size: 12px;
                margin: 0;
                padding: 10px;
            }
            .table {
                font-size: 11px;
            }
        }
        
        .header-laporan {
            border-bottom: 3px double #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        
        .footer-laporan {
            border-top: 1px solid #333;
            padding-top: 10px;
            margin-top: 20px;
        }
        
        .table-laporan {
            font-size: 14px;
        }
        
        .table-laporan th {
            background-color: #f8f9fa !important;
            font-weight: 600;
        }
        
        .summary-box {
            background: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Header -->
        <div class="header-laporan text-center">
            <h2 class="mb-1">LAPORAN SEMUA PEMINJAMAN</h2>
            <h4 class="mb-1">PERPUSTAKAAN DIGITAL</h4>
            <p class="mb-0">Periode: {{ now()->format('d F Y') }}</p>
        </div>

        <!-- Summary -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="summary-box">
                    <div class="row">
                        <div class="col-md-3">
                            <strong>Total Data:</strong> {{ $peminjaman->count() }}
                        </div>
                        <div class="col-md-3">
                            <strong>Dipinjam:</strong> {{ $peminjaman->where('status', 'dipinjam')->count() }}
                        </div>
                        <div class="col-md-3">
                            <strong>Dikembalikan:</strong> {{ $peminjaman->where('status', 'dikembalikan')->count() }}
                        </div>
                        <div class="col-md-3">
                            <strong>Menunggu:</strong> {{ $peminjaman->where('status', 'menunggu_konfirmasi')->count() }}
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
                        <th>Kode</th>
                        <th>Buku</th>
                        <th>Peminjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $item->kode_peminjaman }}</strong></td>
                        <td>{{ $item->buku->judul }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->tanggal_pinjam->format('d/m/Y') }}</td>
                        <td>{{ $item->tanggal_jatuh_tempo->format('d/m/Y') }}</td>
                        <td>
                            @if($item->tanggal_kembali)
                                {{ $item->tanggal_kembali->format('d/m/Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($item->status == 'menunggu_konfirmasi')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($item->status == 'dipinjam')
                                <span class="badge bg-primary">Dipinjam</span>
                            @elseif($item->status == 'dikembalikan')
                                <span class="badge bg-success">Dikembalikan</span>
                            @elseif($item->status == 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td class="text-end">
                            @if($item->status == 'dikembalikan' && $item->pengembalian)
                                Rp {{ number_format($item->pengembalian->denda, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
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
            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary btn-lg ms-2">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('load', function() {
            // Auto print jika diinginkan
            // window.print();
        });
    </script>
</body>
</html>
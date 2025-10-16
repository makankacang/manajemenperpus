<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Semua Pengembalian - Perpustakaan</title>
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
            <h2 class="mb-1">LAPORAN SEMUA PENGEMBALIAN</h2>
            <h4 class="mb-1">PERPUSTAKAAN DIGITAL</h4>
            <p class="mb-0">Periode: {{ now()->format('d F Y') }}</p>
        </div>

        <!-- Summary -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="summary-box">
                    <div class="row">
                        <div class="col-md-3">
                            <strong>Total Data:</strong> {{ $pengembalian->count() }}
                        </div>
                        <div class="col-md-3">
                            <strong>Total Denda:</strong> Rp {{ number_format($pengembalian->sum('denda'), 0, ',', '.') }}
                        </div>
                        <div class="col-md-3">
                            <strong>Buku Baik:</strong> {{ $pengembalian->where('kondisi_buku', 'baik')->count() }}
                        </div>
                        <div class="col-md-3">
                            <strong>Buku Rusak/Hilang:</strong> {{ $pengembalian->where('kondisi_buku', '!=', 'baik')->count() }}
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
                        <th>Tanggal Kembali</th>
                        <th>Kondisi</th>
                        <th>Denda</th>
                        <th>Petugas</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengembalian as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $item->peminjaman->kode_peminjaman }}</strong></td>
                        <td>{{ $item->buku->judul ?? $item->peminjaman->buku->judul }}</td>
                        <td>{{ $item->user->name ?? $item->peminjaman->user->name }}</td>
                        <td>{{ $item->tanggal_pengembalian->format('d/m/Y') }}</td>
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
                        <td class="text-end">Rp {{ number_format($item->denda, 0, ',', '.') }}</td>
                        <td>{{ $item->petugas->name }}</td>
                        <td>{{ $item->catatan ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-dark">
                    <tr>
                        <td colspan="6" class="text-end"><strong>TOTAL DENDA:</strong></td>
                        <td class="text-end fw-bold">Rp {{ number_format($pengembalian->sum('denda'), 0, ',', '.') }}</td>
                        <td colspan="2"></td>
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
            <a href="{{ route('pengembalian.index') }}" class="btn btn-secondary btn-lg ms-2">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        });
    </script>
</body>
</html>
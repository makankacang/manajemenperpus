<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Anggota - Perpustakaan</title>
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
        .summary-box { background: #f8f9fa; border-left: 4px solid #dc3545; padding: 15px; margin-bottom: 20px; }
        .avatar { width: 40px; height: 40px; border-radius: 50%; background: #007bff; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Header -->
        <div class="header-laporan text-center">
            <h2 class="mb-1">LAPORAN DATA ANGGOTA</h2>
            <h4 class="mb-1">PERPUSTAKAAN DIGITAL</h4>
            <p class="mb-0">Periode: {{ now()->format('d F Y') }}</p>
        </div>

        <!-- Summary -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="summary-box">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Total Anggota:</strong> {{ $anggota->count() }}
                        </div>
                        <div class="col-md-4">
                            <strong>Anggota Aktif:</strong> {{ $anggota->count() }}
                        </div>
                        <div class="col-md-4">
                            <strong>Tanggal Laporan:</strong> {{ now()->format('d F Y') }}
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
                        <th>Foto</th>
                        <th>Nama Anggota</th>
                        <th>Email</th>
                        <th>Tanggal Bergabung</th>
                        <th>Status</th>
                        <th>Total Pinjaman</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($anggota as $item)
                    @php
                        $totalPinjaman = \App\Models\Peminjaman::where('user_id', $item->id)->count();
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-center">
                            <div class="avatar mx-auto">
                                {{ strtoupper(substr($item->name, 0, 1)) }}
                            </div>
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <span class="badge bg-success">Aktif</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-primary">{{ $totalPinjaman }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-dark">
                    <tr>
                        <td colspan="6" class="text-end"><strong>TOTAL ANGGOTA:</strong></td>
                        <td class="text-center fw-bold">{{ $anggota->count() }}</td>
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
            <a href="{{ route('anggota.index') }}" class="btn btn-secondary btn-lg ms-2">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
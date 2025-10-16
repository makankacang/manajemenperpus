@php
    $isAdmin = Auth::user()->role->nama === 'Admin';
    
    // Data statistik
    if ($isAdmin) {
        $totalBuku = \App\Models\Buku::count();
        $totalAnggota = \App\Models\User::whereHas('role', function($q) { 
            $q->where('nama', '!=', 'Admin'); 
        })->count();
        $peminjamanAktif = \App\Models\Peminjaman::where('status', 'dipinjam')->count();
        $pengembalianHariIni = \App\Models\Pengembalian::whereDate('created_at', today())->count();
        $totalDenda = \App\Models\Pengembalian::sum('denda');
    } else {
        $peminjamanUser = \App\Models\Peminjaman::where('user_id', Auth::id())->count();
        $peminjamanAktifUser = \App\Models\Peminjaman::where('user_id', Auth::id())
            ->whereIn('status', ['menunggu_konfirmasi', 'dipinjam'])
            ->count();
        $riwayatPengembalian = \App\Models\Peminjaman::where('user_id', Auth::id())
            ->where('status', 'dikembalikan')
            ->count();
        $dendaUser = \App\Models\Pengembalian::whereHas('peminjaman', function($q) {
            $q->where('user_id', Auth::id());
        })->sum('denda');
    }
    
    // Data untuk charts
    $bukuTerbaru = \App\Models\Buku::with(['kategori', 'images'])
        ->latest()
        ->take(6)
        ->get();
        
    $peminjamanTerbaru = \App\Models\Peminjaman::with(['user', 'buku'])
        ->latest()
        ->take(5)
        ->get();
@endphp

<x-app-layout>
    <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-header">
                    <h1 class="h3 mb-0">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </h1>
                    <p class="text-muted mb-0">Selamat datang kembali, {{ Auth::user()->name }}!</p>
                    @if(!Auth::user()->hasVerifiedEmail())
                    <div class="card border-warning mt-4">
                        <div class="card-header bg-warning text-dark">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>Verifikasi Email Diperlukan</strong>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-3">
                                Silakan verifikasi email Anda untuk mengakses semua fitur.
                            </p>

                            @if (session('status') == 'verification-link-sent')
                                <div class="alert alert-success mb-3">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Link verifikasi baru telah dikirim ke email Anda!
                                </div>
                            @endif

                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-envelope me-2"></i>Kirim Ulang Email Verifikasi
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Statistik Cards -->
        <div class="row mb-4">
            @if($isAdmin)
            <!-- Admin Stats -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Buku
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBuku }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-book fs-1 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Anggota
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAnggota }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-people fs-1 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Peminjaman Aktif
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $peminjamanAktif }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-handbag fs-1 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Denda
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalDenda, 0, ',', '.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-cash-coin fs-1 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @else
            <!-- User Stats -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Pinjaman
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $peminjamanUser }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-book fs-1 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Sedang Dipinjam
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $peminjamanAktifUser }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-handbag fs-1 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Telah Dikembalikan
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $riwayatPengembalian }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-arrow-return-left fs-1 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Denda
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($dendaUser, 0, ',', '.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-cash-coin fs-1 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="row">
            <!-- Buku Terbaru -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="bi bi-star-fill me-2"></i>Buku Terbaru
                        </h6>
                        <a href="{{ route('buku') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($bukuTerbaru as $buku)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="position-relative">
                                        @if($coverImage = $buku->images->where('utama', true)->first())
                                            <img src="{{ asset('storage/' . $coverImage->path) }}" 
                                                 class="card-img-top" 
                                                 alt="{{ $buku->judul }}"
                                                 style="height: 200px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                                 style="height: 200px;">
                                                <i class="bi bi-book text-muted fs-1"></i>
                                            </div>
                                        @endif
                                        <div class="position-absolute top-0 end-0 m-2">
                                            <span class="badge {{ $buku->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $buku->stok > 0 ? 'Tersedia' : 'Habis' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title text-dark">{{ Str::limit($buku->judul, 40) }}</h6>
                                        <p class="card-text text-muted small mb-2">
                                            {{ $buku->penulis->nama ?? 'Penulis Tidak Diketahui' }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">{{ $buku->kategori->nama ?? '-' }}</small>
                                            <a href="{{ route('buku.show', $buku->id) }}" 
                                               class="btn btn-sm btn-outline-primary">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Peminjaman Terbaru -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="bi bi-clock-history me-2"></i>
                            @if($isAdmin)
                                Peminjaman Terbaru
                            @else
                                Riwayat Peminjaman Saya
                            @endif
                        </h6>
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Kode</th>
                                        <th>Buku</th>
                                        @if($isAdmin)
                                        <th>Peminjam</th>
                                        @endif
                                        <th>Tanggal Pinjam</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($peminjamanTerbaru as $peminjaman)
                                    <tr>
                                        <td>
                                            <code class="bg-light px-2 py-1 rounded">{{ $peminjaman->kode_peminjaman }}</code>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    @if($coverImage = $peminjaman->buku->images->where('utama', true)->first())
                                                        <img src="{{ asset('storage/' . $coverImage->path) }}" 
                                                             alt="{{ $peminjaman->buku->judul }}"
                                                             class="rounded" width="40" height="40" style="object-fit: cover;">
                                                    @else
                                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                             style="width: 40px; height: 40px;">
                                                            <i class="bi bi-book text-muted"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-0 text-dark small">{{ Str::limit($peminjaman->buku->judul, 30) }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        @if($isAdmin)
                                        <td class="small">{{ $peminjaman->user->name }}</td>
                                        @endif
                                        <td class="small">
                                            {{ $peminjaman->tanggal_pinjam ? $peminjaman->tanggal_pinjam->format('d M Y') : '-' }}
                                        </td>
                                        <td>
                                            @if($peminjaman->status == 'menunggu_konfirmasi')
                                                <span class="badge bg-warning text-dark">Menunggu</span>
                                            @elseif($peminjaman->status == 'dipinjam')
                                                <span class="badge bg-primary">Dipinjam</span>
                                            @elseif($peminjaman->status == 'dikembalikan')
                                                <span class="badge bg-success">Dikembalikan</span>
                                            @elseif($peminjaman->status == 'ditolak')
                                                <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Kanan -->
            <div class="col-xl-4 col-lg-5">
                <!-- Quick Actions -->
                <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="bi bi-trophy-fill me-2"></i>Buku Terpopuler
        </h6>
    </div>
    <div class="card-body">
        @php
            // Ambil data buku terpopuler berdasarkan jumlah peminjaman
            if ($isAdmin) {
                $bukuPopuler = \App\Models\Buku::withCount('peminjaman')
                    ->with(['penulis', 'images'])
                    ->orderBy('peminjaman_count', 'desc')
                    ->take(5)
                    ->get();
            } else {
                $bukuPopuler = \App\Models\Buku::withCount(['peminjaman' => function($query) {
                        $query->where('status', 'dikembalikan');
                    }])
                    ->with(['penulis', 'images'])
                    ->orderBy('peminjaman_count', 'desc')
                    ->take(5)
                    ->get();
            }
        @endphp

        @if($bukuPopuler->count() > 0)
        <div class="list-group list-group-flush">
            @foreach($bukuPopuler as $index => $buku)
            <div class="list-group-item px-0 py-3 border-bottom">
                <div class="d-flex align-items-start">
                    <!-- Ranking Number -->
                    <div class="flex-shrink-0">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" 
                             style="width: 32px; height: 32px; font-size: 0.8rem; font-weight: bold;">
                            {{ $index + 1 }}
                        </div>
                    </div>
                    
                    <!-- Book Cover -->
                    <div class="flex-shrink-0 mx-3">
                        @if($coverImage = $buku->images->where('utama', true)->first())
                            <img src="{{ asset('storage/' . $coverImage->path) }}" 
                                 alt="{{ $buku->judul }}"
                                 class="rounded" 
                                 style="width: 45px; height: 60px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                 style="width: 45px; height: 60px;">
                                <i class="bi bi-book text-muted"></i>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Book Info -->
                    <div class="flex-grow-1">
                        <h6 class="mb-1 text-dark small fw-bold">{{ Str::limit($buku->judul, 35) }}</h6>
                        <p class="mb-1 text-muted small">{{ $buku->penulis->nama ?? 'Penulis Tidak Diketahui' }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-info text-dark">
                                <i class="bi bi-handbag me-1"></i>{{ $buku->peminjaman_count }}x dipinjam
                            </span>
                            @if($buku->stok > 0)
                                <span class="badge bg-success small">Tersedia</span>
                            @else
                                <span class="badge bg-danger small">Habis</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-3">
            <a href="{{ route('buku') }}" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-eye me-1"></i>Lihat Semua Buku
            </a>
        </div>
        
        @else
        <div class="text-center py-4">
            <i class="bi bi-inbox display-4 text-muted mb-3"></i>
            <p class="text-muted mb-0">Belum ada data buku terpopuler</p>
            <a href="{{ route('buku') }}" class="btn btn-primary btn-sm mt-2">
                <i class="bi bi-book me-1"></i>Jelajahi Koleksi
            </a>
        </div>
        @endif
    </div>
</div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="bi bi-info-circle me-2"></i>Informasi Sistem
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                                <span class="text-muted small">Versi Aplikasi</span>
                                <span class="small font-weight-bold">v1.0</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                                <span class="text-muted small">Status Sistem</span>
                                <span class="badge bg-success">Online</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                                <span class="text-muted small">Tanggal Hari Ini</span>
                                <span class="small font-weight-bold">{{ now()->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if(!$isAdmin)
                <!-- Tips untuk User -->
                <div class="card shadow mb-4 border-left-warning">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-warning">
                            <i class="bi bi-lightbulb me-2"></i>Tips Perpustakaan
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning mb-3">
                            <h6 class="alert-heading mb-2">
                                <i class="bi bi-exclamation-triangle me-2"></i>Perhatian!
                            </h6>
                            <p class="mb-0 small">Kembalikan buku tepat waktu untuk menghindari denda.</p>
                        </div>
                        <ul class="list-unstyled small mb-0">
                            <li class="mb-2">
                                <i class="bi bi-check text-success me-2"></i>
                                Periksa stok buku sebelum meminjam
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-success me-2"></i>
                                Jaga kondisi buku selama dipinjam
                            </li>
                            <li class="mb-0">
                                <i class="bi bi-check text-success me-2"></i>
                                Hubungi admin untuk bantuan
                            </li>
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Calendar Mini -->
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="bi bi-calendar3 me-2"></i>Kalender
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <h5 class="font-weight-bold text-gray-800">{{ now()->translatedFormat('F Y') }}</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm mb-0">
                                <thead>
                                    <tr>
                                        @foreach(['M', 'S', 'S', 'R', 'K', 'J', 'S'] as $day)
                                        <th class="text-center small text-muted">{{ $day }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @php
                                            $firstDay = now()->firstOfMonth()->dayOfWeek;
                                            $daysInMonth = now()->daysInMonth;
                                            $today = now()->day;
                                        @endphp
                                        
                                        @for($i = 0; $i < $firstDay; $i++)
                                            <td class="text-center"></td>
                                        @endfor
                                        
                                        @for($day = 1; $day <= $daysInMonth; $day++)
                                            @if(($day + $firstDay - 1) % 7 == 0 && $day != 1)
                                                </tr><tr>
                                            @endif
                                            <td class="text-center small {{ $day == $today ? 'bg-primary text-white rounded' : '' }}">
                                                {{ $day }}
                                            </td>
                                        @endfor
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .border-left-primary { border-left: 4px solid #4e73df !important; }
        .border-left-success { border-left: 4px solid #1cc88a !important; }
        .border-left-info { border-left: 4px solid #36b9cc !important; }
        .border-left-warning { border-left: 4px solid #f6c23e !important; }
        
        .card {
            transition: transform 0.2s;
        }
        
        .card:hover {
            transform: translateY(-2px);
        }
        
        .page-header {
            border-bottom: 1px solid #e3e6f0;
            padding-bottom: 1rem;
        }
    </style>
    @endpush
</x-app-layout>
            <div class="sidebar">
                <div class="sidebar-header">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fas fa-book-open me-2"></i><span class="fw-bold ms-2 text-dark">E-Library</span>
                        </div>
                    </a>
                </div>
                
                <div class="sidebar-nav">
                    <!-- Dashboard -->
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>

                    <!-- Data Buku -->
                    <a class="nav-link {{ request()->routeIs('buku*') ? 'active' : '' }}" href="{{ route('buku') }}">
                        <i class="bi bi-book"></i> Data Buku
                    </a>
                    @if(Auth::user()->role->nama === 'Admin')
                    <!-- Data Anggota -->
                    <a class="nav-link {{ request()->routeIs('anggota.*') ? 'active' : '' }}" href="{{ route('anggota.index') }}">
                        <i class="bi bi-people"></i> Data Anggota
                    </a>
                    @endif

                    <!-- Peminjaman -->
                    <a class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">
                        <i class="bi bi-journal-text"></i> Peminjaman
                    </a>

                    <!-- Pengembalian -->
                    @if(Auth::user()->role->nama === 'Admin')
                    <a class="nav-link {{ request()->routeIs('pengembalian.*') ? 'active' : '' }}" href="{{ route('pengembalian.index') }}">
                        <i class="bi bi-arrow-return-left"></i> Pengembalian
                    </a>
                    @endif


                </div>
            </div>
@php
    $pageTitle = 'Data Anggota';
@endphp

<x-app-layout>
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Data Anggota</h4>
                <p class="text-muted mb-0">Kelola data anggota perpustakaan</p>
            </div>
            <a href="{{ route('laporan.data-anggota') }}" target="_blank" class="btn btn-outline-success">
                <i class="bi bi-printer me-2"></i>Print Data
            </a>
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

        <!-- Members Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Tanggal Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <span class="fw-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $user->name }}</h6>
                                            <small class="text-muted">ID: {{ $user->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <form action="{{ route('anggota.update-role', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="role_id" class="form-select form-select-sm" onchange="this.form.submit()" 
                                                {{ Auth::user()->id === $user->id ? 'disabled' : '' }}>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" 
                                                    {{ $user->role_id == $role->id ? 'selected' : '' }}
                                                    {{ $role->nama == 'Admin' ? 'class="text-success fw-bold"' : '' }}>
                                                    {{ $role->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if(Auth::user()->id === $user->id)
                                        <small class="text-muted d-block">Tidak bisa ubah role sendiri</small>
                                        @endif
                                    </form>
                                </td>
                                <td>
                                    @if($user->email_verified_at)
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle me-1"></i>Terverifikasi
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-clock me-1"></i>Belum Verifikasi
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <small>
                                        {{ $user->created_at->format('d M Y') }}<br>
                                        <span class="text-muted">{{ $user->created_at->format('H:i') }}</span>
                                    </small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" 
                                            data-bs-target="#detailUserModal{{ $user->id }}">
                                        <i class="bi bi-eye me-1"></i>Detail
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Empty State -->
                @if($users->count() == 0)
                <div class="text-center py-5">
                    <div class="empty-state-icon mb-4">
                        <i class="bi bi-people display-1 text-muted"></i>
                    </div>
                    <h5 class="text-muted mb-3">Belum ada anggota</h5>
                    <p class="text-muted">Tidak ada user yang terdaftar.</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- MODALS SECTION - Dipindahkan ke luar loop -->
    @foreach($users as $user)
    <!-- Modal Detail User -->
    <div class="modal fade" id="detailUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="detailUserModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailUserModalLabel{{ $user->id }}">Detail User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                             style="width: 80px; height: 80px; font-size: 2rem;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <h5>{{ $user->name }}</h5>
                        <p class="text-muted">{{ $user->email }}</p>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <strong>Role:</strong>
                            <div class="mt-1">
                                <span class="badge {{ $user->role->nama == 'Admin' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $user->role->nama }}
                                </span>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <strong>Status:</strong>
                            <div class="mt-1">
                                @if($user->email_verified_at)
                                    <span class="badge bg-success">Terverifikasi</span>
                                @else
                                    <span class="badge bg-warning text-dark">Belum Verifikasi</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <strong>Tanggal Daftar:</strong>
                            <p class="mb-0">{{ $user->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="col-6">
                            <strong>Terakhir Update:</strong>
                            <p class="mb-0">{{ $user->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>

                    @if($user->email_verified_at)
                    <div class="mt-3">
                        <strong>Email Terverifikasi:</strong>
                        <p class="mb-0">{{ $user->email_verified_at->format('d M Y H:i') }}</p>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @push('styles')
    <style>
        .avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        .form-select-sm {
            width: auto;
            display: inline-block;
        }
    </style>
    @endpush

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

            // Role change confirmation
            const roleSelects = document.querySelectorAll('select[name="role_id"]');
            roleSelects.forEach(select => {
                select.addEventListener('change', function(e) {
                    if (this.hasAttribute('disabled')) {
                        e.preventDefault();
                        return false;
                    }
                    
                    const userName = this.closest('tr').querySelector('h6').textContent;
                    const newRole = this.options[this.selectedIndex].text;
                    
                    if (!confirm(`Ubah role ${userName} menjadi ${newRole}?`)) {
                        // Reset to original value
                        this.form.reset();
                        return false;
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
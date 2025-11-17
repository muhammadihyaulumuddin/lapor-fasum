@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1">
                        <i class="fas fa-clipboard-list"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Laporan</span>
                        <span class="info-box-number">{{ $totalLaporan }}</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1">
                        <i class="fas fa-clock"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Terkirim</span>
                        <span class="info-box-number">{{ $jumlahTerkirim }}</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1">
                        <i class="fas fa-cogs"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Diproses</span>
                        <span class="info-box-number">{{ $jumlahDiproses }}</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1">
                        <i class="fas fa-check-circle"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Selesai</span>
                        <span class="info-box-number">{{ $jumlahSelesai }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress bars -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Statistik Laporan</h3>
                    </div>
                    <div class="card-body">
                        @if ($totalLaporan > 0)
                            <div class="progress mb-3">
                                <div class="progress-bar bg-warning"
                                    style="width: {{ ($jumlahTerkirim / $totalLaporan) * 100 }}%">
                                    <span>Terkirim: {{ $jumlahTerkirim }}
                                        ({{ number_format(($jumlahTerkirim / $totalLaporan) * 100, 1) }}%)</span>
                                </div>
                            </div>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-primary"
                                    style="width: {{ ($jumlahDiproses / $totalLaporan) * 100 }}%">
                                    <span>Diproses: {{ $jumlahDiproses }}
                                        ({{ number_format(($jumlahDiproses / $totalLaporan) * 100, 1) }}%)</span>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-success"
                                    style="width: {{ ($jumlahSelesai / $totalLaporan) * 100 }}%">
                                    <span>Selesai: {{ $jumlahSelesai }}
                                        ({{ number_format(($jumlahSelesai / $totalLaporan) * 100, 1) }}%)</span>
                                </div>
                            </div>
                        @else
                            <p class="text-muted text-center">Belum ada laporan</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Laporan</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pelapor</th>
                                        <th>Judul Laporan</th>
                                        <th>Lokasi</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($report as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->location }}</td>
                                            <td>
                                                @if ($item->status == 'terkirim')
                                                    <span class="badge badge-warning">Terkirim</span>
                                                @elseif($item->status == 'diproses')
                                                    <span class="badge badge-info">Diproses</span>
                                                @elseif($item->status == 'selesai')
                                                    <span class="badge badge-success">Selesai</span>
                                                @else
                                                    <span class="badge badge-secondary">Unknown</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.detail', $item->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.update', $item->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#deleteModal{{ $item->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($report as $item)
        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus laporan ini?</p>
                        <div class="alert alert-warning">
                            <strong>Data yang akan dihapus:</strong><br>
                            - Judul: <strong>{{ $item->title }}</strong><br>
                            - Pelapor: <strong>{{ $item->name }}</strong><br>
                            - Lokasi: <strong>{{ $item->location }}</strong>
                        </div>
                        <p class="text-danger"><small>Data yang sudah dihapus tidak dapat dikembalikan!</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <form action="{{ route('admin.delete', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

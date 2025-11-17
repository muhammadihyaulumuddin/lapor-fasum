@extends('layouts.admin')

@section('page_title', 'Detail Laporan')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Laporan</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center mb-3">
                                @if ($report->photo && $report->photo != 'nophoto.jpg')
                                    <img src="{{ asset('image/' . $report->photo) }}" alt="Foto Laporan"
                                        class="img-fluid rounded" style="max-height: 300px;">
                                    <p class="mt-2 text-muted">Foto Laporan</p>
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                        style="height: 200px; width: 100%;">
                                        <span class="text-muted">Tidak ada foto</span>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th width="30%">Status</th>
                                            <td>
                                                @if ($report->status == 'terkirim')
                                                    <span class="badge badge-warning">Terkirim</span>
                                                @elseif($report->status == 'diproses')
                                                    <span class="badge badge-info">Diproses</span>
                                                @elseif($report->status == 'selesai')
                                                    <span class="badge badge-success">Selesai</span>
                                                @else
                                                    <span class="badge badge-secondary">Unknown</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Nama Pelapor</th>
                                            <td>{{ $report->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor WhatsApp</th>
                                            <td>{{ $report->contact ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Judul Laporan</th>
                                            <td>{{ $report->title ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi</th>
                                            <td>{{ $report->location ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Dilaporkan</th>
                                            <td>{{ $report->created_at ? $report->created_at->format('d/m/Y H:i') : '-' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Terakhir Diupdate</th>
                                            <td>{{ $report->updated_at ? $report->updated_at->format('d/m/Y H:i') : '-' }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label><strong>Deskripsi Lengkap:</strong></label>
                                    <div class="border p-3 bg-light rounded" style="min-height: 100px;">
                                        {{ $report->description ?? 'Tidak ada deskripsi' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('admin.update', $report->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Update Status
                                </a>
                            </div>
                            <div class="col-md-6 text-right">
                                <small class="text-muted">ID Laporan: {{ $report->id }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('page_title', 'Update Status Laporan')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Update Status Laporan</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.detail', $report->id) }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali ke Detail
                            </a>
                        </div>
                    </div>
                    <form action="{{ route('admin.update.process', $report->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <!-- Informasi Laporan -->
                            <div class="alert alert-info">
                                <h5><i class="fas fa-info-circle"></i> Informasi Laporan</h5>
                                <strong>Pelapor:</strong> {{ $report->name }}<br>
                                <strong>Judul:</strong> {{ $report->title }}<br>
                                <strong>Lokasi:</strong> {{ $report->location }}
                            </div>

                            <!-- Field Update Status -->
                            <div class="form-group">
                                <label for="status"><strong>Status Saat Ini:</strong></label>
                                <div class="mb-2">
                                    @if ($report->status == 'terkirim')
                                        <span class="badge badge-warning">Terkirim</span>
                                    @elseif($report->status == 'diproses')
                                        <span class="badge badge-info">Diproses</span>
                                    @elseif($report->status == 'selesai')
                                        <span class="badge badge-success">Selesai</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status"><strong>Update Status ke:</strong></label>
                                <select name="status" id="status"
                                    class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="terkirim"
                                        {{ old('status', $report->status) == 'terkirim' ? 'selected' : '' }}>
                                        Terkirim
                                    </option>
                                    <option value="diproses"
                                        {{ old('status', $report->status) == 'diproses' ? 'selected' : '' }}>
                                        Diproses
                                    </option>
                                    <option value="selesai"
                                        {{ old('status', $report->status) == 'selesai' ? 'selected' : '' }}>
                                        Selesai
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Preview Status -->
                            <div class="form-group">
                                <label><strong>Preview Status Baru:</strong></label>
                                <div id="status-preview" class="p-3 border rounded bg-light text-center">
                                    Pilih status untuk melihat preview
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.detail', $report->id) }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('status');
            const statusPreview = document.getElementById('status-preview');

            const statusLabels = {
                'terkirim': '<span class="badge badge-warning">Terkirim</span>',
                'diproses': '<span class="badge badge-info">Diproses</span>',
                'selesai': '<span class="badge badge-success">Selesai</span>',
            };

            const statusDescriptions = {
                'terkirim': 'Laporan sedang menunggu penanganan',
                'diproses': 'Laporan sedang dalam proses penanganan',
                'selesai': 'Laporan telah selesai ditangani',
            };

            statusSelect.addEventListener('change', function() {
                const selectedStatus = this.value;
                if (selectedStatus && statusLabels[selectedStatus]) {
                    statusPreview.innerHTML = `
                    ${statusLabels[selectedStatus]}
                    <div class="mt-2 small text-muted">${statusDescriptions[selectedStatus]}</div>
                `;
                } else {
                    statusPreview.innerHTML = 'Pilih status untuk melihat preview';
                }
            });

            // Trigger change event on page load
            statusSelect.dispatchEvent(new Event('change'));
        });
    </script>
@endsection

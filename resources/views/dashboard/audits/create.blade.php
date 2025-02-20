@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Tambah Audit</h6>
                    <form method="post" action="/dashboard/audit">
                        @csrf
                        <div class="mb-3">
                            <label for="kodeLaporan" class="form-label">Kode Laporan</label>
                            <input type="number" class="form-control @error('kodeLaporan') is-invalid @enderror" id="kodeLaporan" name="kodeLaporan" required value="{{ old('kodeLaporan') }}">
                            @error('kodeLaporan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nomor_lhp" class="form-label">Nomor Laporan Audit</label>
                            <input type="number" class="form-control @error('nomor_lhp') is-invalid @enderror" id="nomor_lhp" name="nomor_lhp" required value="{{ old('nomor_lhp') }}">
                            @error('nomor_lhp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" required value="{{ old('judul') }}">
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tgl_pemeriksaan" class="form-label">Tanggal Laporan</label>
                            <input type="date" class="form-control @error('tgl_pemeriksaan') is-invalid @enderror" id="tgl_pemeriksaan" name="tgl_pemeriksaan" required value="{{ old('tgl_pemeriksaan') }}">
                            @error('tgl_pemeriksaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="latar_belakang" class="form-label">Latar Belakang</label>
                            <input id="latar_belakang" type="hidden" name="latar_belakang">
                            <trix-editor class="form-control @error('latar_belakang') is-invalid @enderror" input="latar_belakang" required></trix-editor>
                            @error('latar_belakang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tujuan" class="form-label">Tujuan</label>
                            <input id="tujuan" type="hidden" name="tujuan">
                            <trix-editor class="form-control @error('tujuan') is-invalid @enderror" input="tujuan" required></trix-editor>
                            @error('tujuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="waktu" class="form-label">Waktu Pelaksanaan Audit</label>
                            <input id="waktu" type="hidden" name="waktu">
                            <trix-editor class="form-control @error('waktu') is-invalid @enderror" input="waktu" required></trix-editor>
                            @error('waktu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ruang_lingkup" class="form-label">Ruang Lingkup Audit</label>
                            <input id="ruang_lingkup" type="hidden" name="ruang_lingkup">
                            <trix-editor class="form-control @error('ruang_lingkup') is-invalid @enderror" input="ruang_lingkup" required></trix-editor>
                            @error('ruang_lingkup')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="hasil" class="form-label">Hasil Audit</label>
                            <input id="hasil" type="hidden" name="hasil">
                            <trix-editor class="form-control @error('hasil') is-invalid @enderror" input="hasil" required></trix-editor>
                            @error('hasil')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rekomendasi" class="form-label">Rekomendasi Tindakan</label>
                            <input id="rekomendasi" type="hidden" name="rekomendasi">
                            <trix-editor class="form-control @error('rekomendasi') is-invalid @enderror" input="rekomendasi" required></trix-editor>
                            @error('rekomendasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kesimpulan" class="form-label">Penutup/Kesimpulan</label>
                            <input id="kesimpulan" type="hidden" name="kesimpulan">
                            <trix-editor class="form-control @error('kesimpulan') is-invalid @enderror" input="kesimpulan" required></trix-editor>
                            @error('kesimpulan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Audit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

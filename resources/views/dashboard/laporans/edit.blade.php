@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Edit Laporan</h6>
                    <form method="post" action="/dashboard/laporan/{{ $laporan->nomor_lhp }}">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="kodeLaporan" class="form-label">Kode Laporan</label>
                            <input type="number" class="form-control @error('kodeLaporan') is-invalid @enderror" id="kodeLaporan" name="kodeLaporan" placeholder="Ketik 470 untuk ket laporan" required autofocus value="{{ old('kodeLaporan', $laporan->kodeLaporan) }}">
                            @error('kodeLaporan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nomor_lhp" class="form-label">Nomor LHP</label>
                            <input type="number" class="form-control @error('nomor_lhp') is-invalid @enderror" id="nomor_lhp" name="nomor_lhp" placeholder="Urutan Nomor Surat Terbaru" required value="{{ old('nomor_lhp', $laporan->nomor_lhp) }}">
                            @error('nomor_lhp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" required value="{{ old('judul', $laporan->judul) }}">
                            @error('judul')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ringkasan_hasil" class="form-label">Ringkasan Hasil</label>
                            <input id="ringkasan_hasil" type="hidden" name="ringkasan_hasil" value="{{ old('ringkasan_hasil', $laporan->ringkasan_hasil) }}">
                            <trix-editor class="form-control @error('ringkasan_hasil') is-invalid @enderror" input="ringkasan_hasil" required></trix-editor>
                            @error('ringkasan_hasil')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        <div class="mb-3">
                            <label for="uraian_hasil" class="form-label">Uraian Hasil</label>
                            <input id="uraian_hasil" type="hidden" name="uraian_hasil" value="{{ old('uraian_hasil', $laporan->uraian_hasil) }}">
                            <trix-editor class="form-control @error('uraian_hasil') is-invalid @enderror" input="uraian_hasil" required></trix-editor>
                            @error('uraian_hasil')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        <div class="mb-3">
                            <label for="kesimpulan" class="form-label">Kesimpulan</label>
                            <input id="kesimpulan" type="hidden" name="kesimpulan" value="{{ old('kesimpulan', $laporan->kesimpulan) }}">
                            <trix-editor class="form-control @error('kesimpulan') is-invalid @enderror" input="kesimpulan" required></trix-editor>
                            @error('kesimpulan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        <div class="mb-3">
                            <label for="saran" class="form-label">Saran</label>
                            <input id="saran" type="hidden" name="saran" value="{{ old('saran', $laporan->saran) }}">
                            <trix-editor class="form-control @error('saran') is-invalid @enderror" input="saran" required></trix-editor>
                            @error('saran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        <div class="mb-3">
                            <label for="ttd" class="form-label">Yang Menandatangani</label>
                            <input type="text" class="form-control @error('ttd') is-invalid @enderror" id="ttd" name="ttd" placeholder="Keuchik/Sekdes" required value="{{ old('ttd', $laporan->ttd) }}">
                            @error('ttd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="namaTtd" class="form-label">Nama Yang Menandatangai</label>
                            <input type="text" class="form-control @error('namaTtd') is-invalid @enderror" id="namaTtd" name="namaTtd" required value="{{ old('namaTtd', $laporan->namaTtd) }}">
                            @error('namaTtd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update Laporan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

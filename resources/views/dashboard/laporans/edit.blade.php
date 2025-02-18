@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Edit Laporan</h6>
                    <form method="post" action="/dashboard/laporan/{{ $laporan->id }}">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="ringkasan" class="form-label">Ringkasan Hasil</label>
                            <input id="ringkasan" type="hidden" name="ringkasan" value="{{ old('ringkasan', $laporan->ringkasan_hasil) }}">
                            <trix-editor class="form-control @error('ringkasan') is-invalid @enderror" input="ringkasan" required></trix-editor>
                            @error('ringkasan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="uraian" class="form-label">Uraian Hasil</label>
                            <input id="uraian" type="hidden" name="uraian" value="{{ old('uraian', $laporan->uraian_hasil) }}">
                            <trix-editor class="form-control @error('uraian') is-invalid @enderror" input="uraian" required></trix-editor>
                            @error('uraian')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kesimpulan" class="form-label">Kesimpulan</label>
                            <input id="kesimpulan" type="hidden" name="kesimpulan" value="{{ old('kesimpulan', $laporan->kesimpulan) }}">
                            <trix-editor class="form-control @error('kesimpulan') is-invalid @enderror" input="kesimpulan" required></trix-editor>
                            @error('kesimpulan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="saran" class="form-label">Saran</label>
                            <input id="saran" type="hidden" name="saran" value="{{ old('saran', $laporan->saran) }}">
                            <trix-editor class="form-control @error('saran') is-invalid @enderror" input="saran" required></trix-editor>
                            @error('saran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ttd" class="form-label">Yang Menandatangai</label>
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

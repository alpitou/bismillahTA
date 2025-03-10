@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Edit Surat Keterangan Jalan</h6>
                    <form method="post" action="/dashboard/domisili/{{ $domisili->noSurat }}">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="kodeSurat" class="form-label">Kode Surat</label>
                            <input type="number" class="form-control @error('kodeSurat') is-invalid @enderror" id="kodeSurat" name="kodeSurat" placeholder="Ketik 470 untuk ket Domisili" required autofocus value="{{ old('kodeSurat', $domisili->kodeSurat) }}">
                            @error('kodeSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="noSurat" class="form-label">Nomor Surat</label>
                            <input type="number" class="form-control @error('noSurat') is-invalid @enderror" id="noSurat" name="noSurat" placeholder="Urutan Nomor Surat Terbaru" required value="{{ old('noSurat', $domisili->noSurat) }}">
                            @error('noSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Karyawan</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama Pemohon" required value="{{ old('nama', $domisili->nama) }}">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIP</label>
                            <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" required value="{{ old('nik', $domisili->nik) }}">
                            @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tempatTglLahir" class="form-label">Tempat Berangkat</label>
                            <input type="text" class="form-control @error('tempatTglLahir') is-invalid @enderror" id="tempatTglLahir" name="tempatTglLahir" placeholder="" required value="{{ old('tempatTglLahir', $domisili->tempatTglLahir) }}">
                            @error('tempatTglLahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label">Pejabat Berwenang Yang Memberi Perintah</label>
                            <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" name="pekerjaan" required value="{{ old('pekerjaan', $domisili->pekerjaan) }}">
                            @error('pekerjaan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Tempat Tujuan</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" placeholder="Tulis alamat lengkap disini..."
                                id="alamat" name="alamat" style="height: 150px;" required value="{{ old('alamat', $domisili->alamat) }}"></textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input id="keterangan" type="hidden" name="keterangan" value="{{ old('keterangan', $domisili->keterangan) }}">
                            <trix-editor class="form-control @error('keterangan') is-invalid @enderror" input="keterangan" required ></trix-editor>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        <div class="mb-3 mt-3">
                            <label for="tglSurat" class="form-label">Tanggal</label>
                            <input type="date" class="form-control @error('tglSurat') is-invalid @enderror" id="tglSurat" name="tglSurat" required value="{{ old('tglSurat', $domisili->tglSurat) }}">
                            @error('tglSurat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ttd" class="form-label">Yang Menandatangai</label>
                            <input type="text" class="form-control @error('ttd') is-invalid @enderror" id="ttd" name="ttd" placeholder="Keuchik/Sekdes" required value="{{ old('ttd', $domisili->ttd) }}">
                            @error('ttd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="namaTtd" class="form-label">Nama Yang Menandatangai</label>
                            <input type="text" class="form-control @error('namaTtd') is-invalid @enderror" id="namaTtd" name="namaTtd" required value="{{ old('namaTtd', $domisili->namaTtd) }}">
                            @error('namaTtd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Edit Surat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



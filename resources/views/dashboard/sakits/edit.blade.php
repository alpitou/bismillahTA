@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Edit Surat Keterangan Tugas</h6>
                    <form method="post" action="/dashboard/sakit/{{ $sakit->noSurat }}">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="kodeSurat" class="form-label">Kode Surat</label>
                            <input type="number" class="form-control @error('kodeSurat') is-invalid @enderror" 
                                id="kodeSurat" name="kodeSurat" placeholder="Ketik 510 untuk ket Tugas" required autofocus 
                                value="{{ old('kodeSurat', $sakit->kodeSurat) }}">
                            @error('kodeSurat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="noSurat" class="form-label">Nomor Surat</label>
                            <input type="number" class="form-control @error('noSurat') is-invalid @enderror" 
                                id="noSurat" name="noSurat" placeholder="Urutan Nomor Surat Terbaru" required 
                                value="{{ old('noSurat', $sakit->noSurat) }}">
                            @error('noSurat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label">Dasar</label>
                            <input id="pekerjaan" type="hidden" name="pekerjaan" value="{{ old('pekerjaan', $sakit->pekerjaan) }}">
                            <trix-editor class="form-control @error('pekerjaan') is-invalid @enderror" input="pekerjaan" required></trix-editor>
                            @error('pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Kepada</label>
                            <input id="nama" type="hidden" name="nama" value="{{ old('nama', $sakit->nama) }}">
                            <trix-editor class="form-control @error('nama') is-invalid @enderror" input="nama" required></trix-editor>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Untuk</label>
                            <input id="alamat" type="hidden" name="alamat" value="{{ old('alamat', $sakit->alamat) }}">
                            <trix-editor class="form-control @error('alamat') is-invalid @enderror" input="alamat" required></trix-editor>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Tembusan disampaikan kepada Yth</label>
                            <input id="keterangan" type="hidden" name="keterangan" value="{{ old('keterangan', $sakit->keterangan) }}">
                            <trix-editor class="form-control @error('keterangan') is-invalid @enderror" input="keterangan" required></trix-editor>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tglSurat" class="form-label">Tanggal Surat</label>
                            <input type="date" class="form-control @error('tglSurat') is-invalid @enderror" 
                                id="tglSurat" name="tglSurat" required value="{{ old('tglSurat', $sakit->tglSurat) }}">
                            @error('tglSurat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ttd" class="form-label">Yang Menandatangani</label>
                            <input type="text" class="form-control @error('ttd') is-invalid @enderror" 
                                id="ttd" name="ttd" placeholder="Inspektur" required value="{{ old('ttd', $sakit->ttd) }}">
                            @error('ttd')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="namaTtd" class="form-label">Nama Yang Menandatangani</label>
                            <input type="text" class="form-control @error('namaTtd') is-invalid @enderror" 
                                id="namaTtd" name="namaTtd" required value="{{ old('namaTtd', $sakit->namaTtd) }}">
                            @error('namaTtd')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Surat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

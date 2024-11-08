@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <h2>Detail Pegawai</h2>

                <!-- Tampilkan pesan sukses jika ada -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Detail informasi pegawai -->
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <p class="form-control">{{ $pegawai->nama }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jabatan</label>
                    <p class="form-control">{{ $pegawai->jabatan }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <p class="form-control">{{ $pegawai->username }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <p class="form-control">{{ $pegawai->email }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <p class="form-control">{{ $pegawai->role }}</p>
                </div>

                <!-- Tombol kembali -->
                <a href="{{ route('pegawai.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection

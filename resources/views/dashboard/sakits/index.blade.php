@extends('dashboard.layouts.main')

@section('container')
<!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-5">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Surat Tugas</p>
                        <h6 class="mb-0">{{ $totalSakit }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->

    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Daftar Surat Tugas</h6>
                <a href="/dashboard/sakit/create" class="btn btn-primary">Tambah Surat</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No Surat</th>
                            <th scope="col">Nama Pegawai</th>
                            <th scope="col">Tanggal Surat</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sakits as $sakit)
                        <tr>
                            <td>{!! $sakit->noSurat !!}</td>
                            <td>{!! $sakit->nama !!}</td>
                            <td>{{ date('d M Y', strtotime($sakit->tglSurat)) }}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="/dashboard/sakit/{{ $sakit->noSurat }}">Detail</a>
                                @if(auth()->user() && auth()->user()->role === 'Inspektur')
                                <a class="btn btn-sm btn-warning" href="/dashboard/sakit/{{ $sakit->noSurat }}/edit">Edit</a>
                                <form action="/dashboard/sakit/{{ $sakit->noSurat }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf 
                                    <button class="btn btn-sm btn-danger border-0" onclick="return confirm('Klik Oke Untuk Menghapus')">Hapus</button>
                                </form>
                                <a class="btn btn-sm btn-success" href="/dashboard/sakit/{{ $sakit->noSurat }}/cetak">Cetak</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex mt-3">
                    {{ $sakits->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection

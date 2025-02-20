@extends('dashboard.layouts.main')

@section('container')
<!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-5">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Laporan Pemeriksaan</p>
                        <h6 class="mb-0">{{ $totalLaporan }}</h6>
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
                <h6 class="mb-0">Daftar Laporan Hasil Pemeriksaan (LHP)</h6>
                <a href="/dashboard/laporan/create" class="btn btn-primary">Tambah Laporan</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Kode Laporan</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Tanggal Pemeriksaan</th>
                            <th scope="col">Action</th>
                            <th scope="col">Komentar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporans as $laporan)
                        <tr>
                            <td>{{ $laporan->kodeLaporan }}</td>
                            <td>{{ $laporan->judul }}</td>
                            <td>{{ date('d M Y', strtotime($laporan->tgl_pemeriksaan)) }}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="/dashboard/laporan/{{ $laporan->nomor_lhp }}">Detail</a>
                                @if(auth()->user() && auth()->user()->role === 'Inspektur')
                                <a class="btn btn-sm btn-warning" href="/dashboard/laporan/{{ $laporan->nomor_lhp }}/edit">Edit</a>
                                <form action="/dashboard/laporan/{{ $laporan->nomor_lhp }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf 
                                    <button class="btn btn-sm btn-danger border-0" onclick="return confirm('Klik Oke Untuk Menghapus')">Hapus</button>
                                </form>
                                <a class="btn btn-sm btn-success" href="/dashboard/laporan/{{ $laporan->nomor_lhp }}/cetak">Cetak</a>
                                @endif
                            </td>
                            <td>
                                @if(auth()->user() && auth()->user()->role === 'Inspektur')
                                <form action="/dashboard/laporan/{{ $laporan->id }}/komentar" method="post">
                                    @csrf
                                    <div class="mb-2">
                                        <textarea class="form-control" name="komentar" placeholder="Tulis komentar..." rows="3">{{ old('komentar', $laporan->komentar) }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-info">Kirim Komentar</button>
                                </form>
                                @else
                                    {{ $laporan->komentar ?? 'Tidak ada komentar' }}
                                @endif
                            </td>  
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex mt-3">
                    {{ $laporans->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection

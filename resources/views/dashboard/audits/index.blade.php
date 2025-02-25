@extends('dashboard.layouts.main')

@section('container')
<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-5">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Laporan Audit</p>
                    <h6 class="mb-0">{{ $totalAudit }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->

<!-- Recent Audits Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar Laporan Audit</h6>
            <a href="/dashboard/audit/create" class="btn btn-primary">Tambah Laporan</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">Kode Laporan</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Tanggal Laporan</th>
                        <th scope="col">Action</th>
                        <th scope="col">Komentar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($audits as $audit)
                    <tr>
                        <td>{{ $audit->kodeLaporan }}</td>
                        <td>{{ $audit->judul }}</td>
                        <td>{{ date('d M Y', strtotime($audit->tgl_pemeriksaan)) }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="/dashboard/audit/{{ $audit->nomor_lhp }}">Detail</a>
                            
                            <a class="btn btn-sm btn-warning" href="/dashboard/audit/{{ $audit->nomor_lhp }}/edit">Edit</a>
                            <form action="/dashboard/audit/{{ $audit->nomor_lhp }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf 
                                <button class="btn btn-sm btn-danger border-0" onclick="return confirm('Klik Oke Untuk Menghapus')">Hapus</button>
                            </form>
                            <a class="btn btn-sm btn-success" href="/dashboard/audit/{{ $audit->nomor_lhp }}/cetak">Cetak</a>
                            
                        </td>
                        <td>
                            @if(auth()->user() && auth()->user()->role === 'Inspektur')
                            <form action="/dashboard/audit/{{ $audit->id }}/komentar" method="post">
                                @csrf
                                <div class="mb-2">
                                    <textarea class="form-control" name="komentar" placeholder="Tulis komentar..." rows="3">{{ old('komentar', $audit->komentar) }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-sm btn-info">Kirim Komentar</button>
                            </form>
                            @else
                                {{ $audit->komentar ?? 'Tidak ada komentar' }}
                            @endif
                        </td>  
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex mt-3">
                {{ $audits->links() }}
            </div>
        </div>
    </div>
</div>
<!-- Recent Audits End -->
@endsection

@extends('dashboard.layouts.main')

@section('container')
<!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-5">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Surat Jalan</p>
                        <h6 class="mb-0">{{ $totalDomisili }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-5">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Surat Izin</p>
                        <h6 class="mb-0">{{ $totalUsaha }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-5">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa bi-list-task fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Surat Tugas</p>
                        <h6 class="mb-0">{{ $totalSakit }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-5">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa bi-clipboard-check fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Laporan Pemeriksaan</p>
                        <h6 class="mb-0">{{ $totalLaporan }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-5">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa bi-shield-check fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Laporan Audit</p>
                        <h6 class="mb-0">{{ $totalAudit }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->

    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Daftar Surat Jalan Terbaru</h6>
                <a href="/dashboard/domisili">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No Surat</th>
                            <th scope="col">Nama Pegawai</th>
                            <th scope="col">Tanggal Surat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($domisilis as $domisili)
                        <tr>
                            <td>{{ $domisili->noSurat }}</td>
                            <td>{{ $domisili->nama }}</td>
                            <td>{{ date('d M Y', strtotime($domisili->tglSurat)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->

    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Daftar Surat Izin Terbaru</h6>
                <a href="/dashboard/usaha">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No Surat</th>
                            <th scope="col">Nama Pegawai</th>
                            <th scope="col">Tanggal Surat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usahas as $usaha)
                        <tr>
                            <td>{{ $usaha->noSurat }}</td>
                            <td>{{ $usaha->nama }}</td>
                            <td>{{ date('d M Y', strtotime($usaha->tglSurat)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
     <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Daftar Surat Tugas Terbaru</h6>
                <a href="{{ route('sakits.index') }}">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No Surat</th>
                            <th scope="col">Nama Pegawai</th>
                            <th scope="col">Tanggal Surat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sakits as $sakit)
                        <tr>
                            <td>{{ $sakit->noSurat }}</td>
                            <td>{{ trim(html_entity_decode(strip_tags($sakit->nama))) }}</td>
                            <td>{{ date('d M Y', strtotime($sakit->tglSurat)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
      <!-- Recent Sales Start -->
       <!-- Recent Sales End -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Daftar Laporan Pemeriksaan Terbaru</h6>
                <a href="/dashboard/laporan">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Kode Laporan</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Tanggal Laporan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporans as $laporan)
                        <tr>
                            <td>{{ $laporan->kodeLaporan }}</td>
                            <td>{{ $laporan->judul }}</td>
                            <td>{{ date('d M Y', strtotime($laporan->tgl_pemeriksaan)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
      <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Daftar Laporan Audit Terbaru</h6>
                <a href="/dashboard/audit">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Kode Laporan</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Tanggal Laporan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($audits as $audit)
                        <tr>
                            <td>{{ $audit->kodeLaporan }}</td>
                            <td>{{ $audit->judul }}</td>
                            <td>{{ date('d M Y', strtotime($audit->tgl_pemeriksaan)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection
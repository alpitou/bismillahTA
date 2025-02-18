@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="/dashboard/laporan" class="btn btn-success"><i class="bi bi-arrow-left-square"></i> Kembali</a>
                <a href="/dashboard/laporan/{{ $laporan->id }}/cetak" class="btn btn-secondary"><i class="bi bi-printer"></i> Cetak</a>
            </div>
            <center style="margin-top: 50px;">
                <table style="align-content: center">
                    <tr>
                        <td><img src="{{ asset('dashmin/img/logo_lhok.svg') }}" width="110" height="110" /></td>
                        <td style="font-family: 'Times New Roman', Times, serif; font-size: 13px">
                            <center>
                                <font size="5"><b>PEMERINTAH KOTA LHOKSEUMAWE</b></font><br />
                                <font size="4"><b>KECAMATAN MUARA DUA</b></font><br />
                                <font size="5"><b>GAMPONG PAYA PUNTEUET</b></font><br />
                                <font size="3"><i>JLN. Tgk, WAHAB DAHLAWI KM.1</i></font><br />
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr style="border: 1px solid" /></td>
                    </tr>
                </table>
                <br />
                <table width="545">
                    <tr>
                        <td style="font-family: 'Times New Roman', Times, serif; font-size: 18px; text-align: center; font-weight: bold" class="text">
                            <u>LAPORAN HASIL PEMERIKSAAN</u>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center">Nomor : {{ $laporan->kodeLaporan }}/{{ $laporan->nomor_lhp }}/2025</td>
                    </tr>
                </table>
                <br /><br /><br />
                <table width="545">
                    <tr>
                        <td><strong>Ringkasan Hasil:</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">{!! $laporan->ringkasan_hasil !!}</td>
                    </tr>
                </table>
                <br>
                <table width="545">
                    <tr>
                        <td><strong>Uraian Hasil:</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">{!! $laporan->uraian_hasil !!}</td>
                    </tr>
                </table>
                <br>
                <table width="545">
                    <tr>
                        <td><strong>Kesimpulan:</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">{!! $laporan->kesimpulan !!}</td>
                    </tr>
                </table>
                <br>
                <table width="545">
                    <tr>
                        <td><strong>Saran:</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">{!! $laporan->saran !!}</td>
                    </tr>
                </table>
                <br><br>
                <table width="545">
                    <tr>
                        <td width="340"></td>
                        <td style="text-align: left">Jambi, {{ date('d M Y', strtotime($laporan->tgl_pemeriksaan)) }}</td>
                    </tr>
                    <tr>
                        <td width="340"></td>
                        <td style="text-align: left">An. {{ $laporan->ttd }}</td>
                    </tr>
                </table>
                <br /><br />
                <table width="545" style="margin-bottom: 100px">
                    <tr>
                        <td width="340"></td>
                        <td style="text-align: left">{{ $laporan->namaTtd }}</td>
                    </tr>
                </table>
            </center>
        </div>
    </div>
@endsection

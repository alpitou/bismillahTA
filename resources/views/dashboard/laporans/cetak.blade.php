@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="/dashboard/laporan" class="btn btn-success"><i class="bi bi-arrow-left-square"></i> Kembali</a>
                <a href="/dashboard/laporan/{{ $laporan->nomor_lhp }}/cetak" class="btn btn-secondary"><i class="bi bi-printer"></i> Cetak</a>
            </div>
            <div style="margin: 0 auto; width: 80%">
                <table width="100%">
                    <tr>
                        <td><img src="{{ asset('dashmin/img/image.png') }}" width="100" height="110" /></td>
                        <td style="font-family: 'Times New Roman', Times, serif; font-size: 13px; text-align: center;">
                            <div style="text-align: center;">
                                <font size="5">PEMERINTAH KOTA JAMBI</font><br />
                                <font size="6"><b>INSPEKTORAT</b></font><br />
                                <font size="3">Jl. Kapten A. Zaidi Saleh, Kota Baru, Jambi 36128, Telepon: (0741) 41239</font><br />
                                <font size="3">Laman: inspektorat.jambikota.go.id, Pos-el: inspektorat@jambikota.go.id</font>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr style="border: 2px solid black; margin: 2px 0;">
                            <hr style="border: 2px solid black; margin: 2px 0;">
                        </td>
                    </tr>
                </table>
                <br />
                <table width="100%" style="margin-bottom: 5px;">
                    <tr>
                        <td style="font-size: 18px; text-align: center; font-weight: bold">
                            <u>LAPORAN HASIL PEMERIKSAAN</u>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">Nomor : WAS. {{ $laporan->kodeLaporan }}/{{ $laporan->nomor_lhp }}/2025</td>
                    </tr>
                </table>
                <br />
                <table width="100%">
                    <tr>
                        <td style="text-align: center;"><strong>{!! $laporan->judul !!}</strong></td>
                    </tr>
                </table>
                <br />
                <table width="100%">
                    <tr>
                        <td><b>BAB I. Ringkasan Hasil:</b></td>
                    </tr>
                    <tr>
                        <td style="text-align: justify;">{!! $laporan->ringkasan_hasil !!}</td>
                    </tr>
                </table>
                <br>
                <table width="100%">
                    <tr>
                        <td><b>BAB II. Uraian Hasil:</b></td>
                    </tr>
                    <tr>
                        <td style="text-align: justify;">{!! $laporan->uraian_hasil !!}</td>
                    </tr>
                </table>
                <br>
                <table width="100%">
                    <tr>
                        <td><b>BAB III. Kesimpulan:</b></td>
                    </tr>
                    <tr>
                        <td style="text-align: justify;">{!! $laporan->kesimpulan !!}</td>
                    </tr>
                </table>
                <br>
                <table width="100%">
                    <tr>
                        <td><b>BAB IV. Saran:</b></td>
                    </tr>
                    <tr>
                        <td style="text-align: justify;">{!! $laporan->saran !!}</td>
                    </tr>
                </table>
                <br /><br />
                <table width="100%">
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: justify;">Demikian Laporan Hasil Pemeriksaan ini dibuat berdasarkan                 norma - norma Pemeriksaan Aparat Pengawasan Internal Pemerintah ( APIP ).</td>
                    </tr>
                </table>
                <br /><br />
                <table width="100%">
                    <tr>
                        <td width="60%"></td>
                        <td style="text-align: right;">Jambi, {{ date('d M Y', strtotime($laporan->tgl_pemeriksaan)) }}</td>
                    </tr>
                    <tr>
                        <td width="60%"></td>
                        <td style="text-align: right;">An. {{ $laporan->ttd }}</td>
                    </tr>
                </table>
                <br /><br />
                <table width="100%" style="margin-bottom: 100px">
                    <tr>
                        <td width="60%"></td>
                        <td style="text-align: right;">{{ $laporan->namaTtd }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection

@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="/dashboard/audit" class="btn btn-success"><i class="bi bi-arrow-left-square"></i> Kembali</a>
                <a href="/dashboard/audit/{{ $audit->nomor_lhp }}/cetak" class="btn btn-secondary"><i class="bi bi-printer"></i> Cetak</a>
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
                            <u>LAPORAN HASIL AUDIT</u>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">Nomor : {{ $audit->kodeLaporan }}/{{ $audit->nomor_lhp }}/2025</td>
                    </tr>
                </table>
                <br />
                <table width="100%">
                    <tr>
                        <td style="text-align: center;"><strong>{!! $audit->judul !!}</strong></td>
                    </tr>
                </table>
                <br />
                <table width="100%">
                    <tr>
                        <td><b>BAB I. LATAR BELAKANG</b></td>
                    </tr>
                    <tr>
                        <td style="text-align: justify;">{!! $audit->latar_belakang !!}</td>
                    </tr>
                </table>
                <br>
                <table width="100%">
                    <tr>
                        <td><b>BAB II. TUJUAN</b></td>
                    </tr>
                    <tr>
                        <td style="text-align: justify;">{!! $audit->tujuan !!}</td>
                    </tr>
                </table>
                <br>
                <table width="100%">
                    <tr>
                        <td><b>BAB III. WAKTU PELAKSANAAN AUDIT</b></td>
                    </tr>
                    <tr>
                        <td style="text-align: justify;">{!! $audit->waktu !!}</td>
                    </tr>
                </table>
                <br>
                <table width="100%">
                    <tr>
                        <td><b>BAB IV. RUANG LINGKUP AUDIT</b></td>
                    </tr>
                    <tr>
                        <td style="text-align: justify;">{!! $audit->ruang_lingkup !!}</td>
                    </tr>
                </table>
                <br>
                <table width="100%">
                    <tr>
                        <td><b>BAB V. HASIL AUDIT</b></td>
                    </tr>
                    <tr>
                        <td style="text-align: justify;">{!! $audit->hasil !!}</td>
                    </tr>
                </table>
                <br>
                <table width="100%">
                    <tr>
                        <td><b>BAB VI. REKOMENDASI TINDAKAN</b></td>
                    </tr>
                    <tr>
                        <td style="text-align: justify;">{!! $audit->rekomendasi !!}</td>
                    </tr>
                </table>
                <br />
                <table width="100%">
                    <tr>
                        <td><b>BAB VI. PENUTUP/KESIMPULAN</b></td>
                    </tr>
                    <tr>
                        <td style="text-align: justify;">{!! $audit->kesimpulan !!}</td>
                    </tr>
                </table>
                <br /><br /><br />
            </div>
        </div>
    </div>
@endsection

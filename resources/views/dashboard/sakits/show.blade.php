@extends('dashboard.layouts.main')

@section('container')

<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <a href="/dashboard/sakit" class="btn btn-success"><i class="bi bi-arrow-left-square"></i> Kembali</a>
            <a href="/dashboard/sakit/{{ $sakit->noSurat }}/cetak" class="btn btn-secondary"><i class="bi bi-printer"></i> Cetak</a>
        </div>
        <div style="margin: 0 auto; width: 80%">
        <table width="100%">
            <tr>
                <td><img src="{{ asset('dashmin/img/image.png') }}" width="100" height="110" /></td>
                <td style="font-family: 'Times New Roman', Times, serif; font-size: 13px; text-align: center;">
                    <div style="text-align: center;" >
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
                        <u>SURAT TUGAS</u>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; line-height: 1.2;">
                        Nomor: {{ $sakit->kodeSurat }}/{{ $sakit->noSurat }}/K/INSP/2025
                    </td>
                </tr>
            </table>
            <table width="100%" style="margin-bottom: 5px; margin-top: 18px;">
                <tr>
                    <td width="5%"><b>I.</b></td>
                    <td style="text-align: justify; line-height: 1.2;">
                        <b>Dasar:</b>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: justify; line-height: 1.2;">
                    {!! $sakit->pekerjaan !!}
                    </td>
                </tr>
            </table>
            <br />
            <table width="100%">
                <tr>
                    <td width="5%"><b>II.</b></td>
                    <td style="text-align: justify;">
                        <b>Kepada:</b>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: 2px; text-align: justify;">{!! $sakit->nama !!}</td>
                </tr>
            </table>
            <br />
            <table width="100%">
                <tr>
                    <td width="5%"><b>III.</b></td>
                    <td style="text-align: justify;">
                        <b>Untuk:</b>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: 2px; text-align: justify;">{!! $sakit->alamat !!}</td>
                </tr>
            </table>
            <br />
            <table width="100%">
                <tr>
                    <td width="5%" valign="top"><b>IV.</b></td>
                    <td style="text-align: justify;">
                        <b>Demikian untuk diketahui dan diberikan kepada Pejabat/Pegawai sebagaimana 
                        dimaksud di atas untuk dilaksanakan sesuai dengan ketentuan yang berlaku.</b>
                    </td>
                </tr>
            </table>
            <br /><br /><br />
            <table width="100%">
                <tr>
                    <td width="60%"></td>
                    <td style="text-align: right;">Dikeluarkan di</td>
                    <td style="text-align: right;">:</td>
                    <td style="text-align: right;">Jambi</td>
                </tr>
                <tr>
                    <td width="60%"></td>
                    <td style="text-align: right;">Pada Tanggal</td>
                    <td style="text-align: right;">:</td>
                    <td style="text-align: right;">{{ date('d F Y', strtotime($sakit->tglSurat)) }}</td>
                </tr>
            </table>

            <table width="100%" style="margin-top: 10px;">
                <tr>
                    <td width="60%"></td>
                    <td style="text-align: right;">Ditandatangani secara elektronik oleh:</td>
                </tr>
            </table>
            <table width="100%" style="margin-top: 10px;">
                <tr>
                    <td width="65%"></td>
                    <td style="text-align: left;">An. {{ $sakit->ttd }}</td>
                </tr>
            </table>
            <table width="100%" style="margin-bottom: 100px;">
                <tr>
                    <td width="65%"></td>
                    <td style="text-align: left;">{{ $sakit->namaTtd }}</td>
                </tr>
            </table>
            <table width="100%">
                <tr>
                    <td width="5%" valign="top"><b>IV.</b></td>
                    <td style="text-align: justify;">
                        <b>Tembusan disampaikan kepada Yth:</b>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: 2px; text-align: justify;">{!! $sakit->keterangan !!}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection

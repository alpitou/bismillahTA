@extends('dashboard.layouts.main')

@section('container')

<!-- Detail Tugas Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <a href="/dashboard/tugas" class="btn btn-success"><i class="bi bi-arrow-left-square"></i> Kembali</a>
            <a href="/dashboard/tugas/{{ $tugas->id }}/cetak" class="btn btn-secondary"><i class="bi bi-printer"></i> Cetak</a>
        </div>
        <center style="margin-top: 50px;">
            <table>
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
                        <u>SURAT KETERANGAN TUGAS</u>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center">Nomor : {{ $tugas->kodeSurat }}/{{ $tugas->noSurat }}/2023</td>
                </tr>
            </table>
            <br /><br /><br />
            <table width="545">
                <tr>
                    <td>Keuchik Gampong Paya Punteuet Kecamatan Muara Dua Pemerintah Kota Lhokseumawe, dengan ini menerangkan bahwa :</td>
                </tr>
            </table>
            <br /><br />
            <table width="545">
                <tr>
                    <td width="200">Nama</td>
                    <td width="10">:</td>
                    <td width="335">{{ $tugas->nama }}</td>
                </tr>
                <tr>
                    <td width="200">NIK</td>
                    <td width="10">:</td>
                    <td width="335">{{ $tugas->nik }}</td>
                </tr>
                <tr>
                    <td width="200">Tempat/Tanggal Lahir</td>
                    <td width="10">:</td>
                    <td width="335">{{ $tugas->tempatTglLahir }}</td>
                </tr>
                <tr>
                    <td width="200">Pekerjaan</td>
                    <td width="10">:</td>
                    <td width="335">{{ $tugas->pekerjaan }}</td>
                </tr>
                <tr>
                    <td width="200">Alamat</td>
                    <td width="10">:</td>
                    <td width="335">{{ $tugas->alamat }}</td>
                </tr>
            </table>
            <br /><br />
            <table width="545">
                <tr>
                    <td>{!! $tugas->keterangan !!}</td>
                </tr>
            </table>
            <br /><br />
            <table width="545">
                <tr>
                    <td>Demikian surat keterangan ini kami perbuat untuk dapat dipergunakan seperlunya.</td>
                </tr>
            </table>
            <br /><br /><br />
            <table width="545">
                <tr>
                    <td width="340"></td>
                    <td style="text-align: left">Paya Punteuet, {{ date('d M Y', strtotime($tugas->tglSurat)) }}</td>
                </tr>
                <tr>
                    <td width="340"></td>
                    <td style="text-align: left">An. {{ $tugas->ttd }}</td>
                </tr>
            </table>
            <br /><br />
            <table width="545" style="margin-bottom: 100px">
                <tr>
                    <td width="340"></td>
                    <td style="text-align: left">{{ $tugas->namaTtd }}</td>
                </tr>
            </table>
        </center>
    </div>
</div>
<!-- Detail Tugas End -->

@endsection

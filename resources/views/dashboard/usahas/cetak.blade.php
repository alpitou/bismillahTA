@extends('dashboard.layouts.main')

@section('container')

<!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="/dashboard/usaha" class="btn btn-success"><i class="bi bi-arrow-left-square"></i> Kembali</a>
                        <a href="/dashboard/usaha/{{ $usaha->noSurat }}/cetak" class="btn btn-secondary"><i class="bi bi-printer"></i> Cetak</a>
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
                        <!-- Judul Surat -->
            <table width="100%" style="margin-bottom: 5px;">
                <tr>
                    <td style="font-size: 18px; text-align: center; font-weight: bold">
                        <u>SURAT IZIN</u>
                    </td>
                </tr>
                <tr>
                <td style="text-align: center">Nomor : {{ $usaha->kodeSurat }}/{{ $usaha->noSurat }}/2023</td>
                </tr>
                </tr>
            </table>
            <br>
            <!-- Detail Surat -->
            <table width="100%">
                <tr>
                    <td width="5%" style="text-align: right;">1.</td>
                    <td width="40%" style="text-align: justify;">Pejabat berwenang yang memberi izin</td>
                    <td width="5%">:</td>
                    <td width="50%" style="text-align: justify;">{{ $usaha->ttd }}</td>
                </tr>
                <tr>
                    <td style="text-align: right;">2.</td>
                    <td style="text-align: justify;">Nama Pegawai yang meminta izin</td>
                    <td>:</td>
                    <td style="text-align: justify;">{{ $usaha->nama }}</td>
                </tr>
                <tr>
                    <td style="text-align: right;">3.</td>
                    <td style="text-align: justify;">NIP Pegawai yang meminta izin</td>
                    <td>:</td>
                    <td style="text-align: justify;">{{ $usaha->nik }}</td>
                </tr>
                <tr>
                    <td style="text-align: right;">4.</td>
                    <td style="text-align: justify;">Jabatan Pegawai yang meminta izin</td>
                    <td>:</td>
                    <td style="text-align: justify;">{{ $usaha->pekerjaan }}</td>
                </tr>
                <tr>
                    <td style="text-align: right;">5.</td>
                    <td style="text-align: justify;">Keterangan Izin</td>
                    <td>:</td>
                    <td style="text-align: justify;">{!! $usaha->keterangan !!}</td>
                </tr>
                <tr>
                    <td style="text-align: right;">6.</td>
                    <td style="text-align: justify;">Tanggal Izin</td>
                    <td>:</td>
                    <td style="text-align: justify;">{{ $usaha->tempatTglLahir }}</td>
                </tr>
                <tr>
                    <td style="text-align: right;">7.</td>
                    <td style="text-align: justify;">Alamat</td>
                    <td>:</td>
                    <td style="text-align: justify;">{{ $usaha->alamat }}</td>
                </tr>
            </table>
            <br>
            <br><br>
            <!-- Tanda Tangan -->
            <table width="100%">
            <tr>
                <td width="63%"></td>
                <td style="text-align: right; padding-right: 10px;">Dikeluarkan di</td>
                <td style="text-align: right; padding-right: 10px;">:</td>
                <td style="text-align: left; padding-left: 10px;">Jambi</td>
            </tr>
            <tr>
                <td width="60%"></td>
                <td style="text-align: right; padding-right: 10px;">Pada Tanggal</td>
                <td style="text-align: right; padding-right: 10px;">:</td>
                <td style="text-align: left; padding-left: 10px;">{{ date('d F Y', strtotime($usaha->tglSurat)) }}</td>
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
                    <td style="text-align: left;">An. {{ $usaha->pekerjaan }}</td>
                </tr>
            </table>
            <table width="100%" style="margin-bottom: 100px;">
                <tr>
                    <td width="65%"></td>
                    <td style="text-align: left;">{{ $usaha->nama }}</td>
                </tr>
            </table>

        </div>
    </div>
</div>
<!-- Recent Sales End -->

@endsection

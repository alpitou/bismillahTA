<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Izin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
                <table width="100%">
                    <tr>
                    <td><img src="inspektorat.png" width="100" height="110" /></td>
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
                        <u>SURAT IZIN</u>
                    </td>
                </tr>
                <tr>
                <td style="text-align: center">Nomor : {{ $usaha->kodeSurat }}/{{ $usaha->noSurat }}/2023</td>
                </tr>
                </tr>
            </table>
            <br>
            <table width="100%">
                <tr>
                    <td width="5%" style="text-align: right; padding-right: 10px;">1.</td>
                    <td width="60%" style="text-align: justify;">Pejabat berwenang yang memberi izin</td>
                    <td width="5%">:</td>
                    <td width="50%" style="text-align: justify;">{{ $usaha->ttd }}</td>
                </tr>
                <tr>
                    <td style="text-align: right; padding-right: 10px;">2.</td>
                    <td style="text-align: justify;">Nama Pegawai yang meminta izin</td>
                    <td>:</td>
                    <td style="text-align: justify;">{{ $usaha->nama }}</td>
                </tr>
                <tr>
                    <td style="text-align: right; padding-right: 10px;">3.</td>
                    <td style="text-align: justify;">NIP Pegawai yang meminta izin</td>
                    <td>:</td>
                    <td style="text-align: justify;">{{ $usaha->nik }}</td>
                </tr>
                <tr>
                    <td style="text-align: right; padding-right: 10px;">4.</td>
                    <td style="text-align: justify;">Jabatan Pegawai yang meminta izin</td>
                    <td>:</td>
                    <td style="text-align: justify;">{{ $usaha->pekerjaan }}</td>
                </tr>
                <tr>
                    <td style="text-align: right; padding-right: 10px;">5.</td>
                    <td style="text-align: justify;">Keterangan Izin</td>
                    <td>:</td>
                    <td style="text-align: justify;">{!! $usaha->keterangan !!}</td>
                </tr>
                <tr>
                    <td style="text-align: right; padding-right: 10px;">6.</td>
                    <td style="text-align: justify;">Tanggal Izin</td>
                    <td>:</td>
                    <td style="text-align: justify;">{{ $usaha->tempatTglLahir }}</td>
                </tr>
                <tr>
                    <td style="text-align: right; padding-right: 10px;">7.</td>
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
                    <td width="367px"></td>
                    <td style="text-align: right; padding-right: 10px; white-space: nowrap;">Dikeluarkan di :</td>
                    <td style="text-align: left; padding-left: 10px; white-space: nowrap;">Jambi</td>
                </tr>
                <tr>
                    <td width="60%"></td>
                    <td style="text-align: right; padding-right: 10px; white-space: nowrap;">Pada Tanggal :</td>
                    <td style="text-align: left; padding-left: 10px; white-space: nowrap;">{{ date('d F Y', strtotime($usaha->tglSurat)) }}</td>
                </tr>
            </table>
            <table width="527px" style="margin-top: 10px;">
                <tr>
                    <td width="60%"></td>
                    <td style="text-align: right; white-space: nowrap;">Ditandatangani oleh:</td>
                </tr>
            </table>
            <table width="602px" style="margin-top: 10px;">
                <tr>
                    <td width="65%"></td>
                    <td style="text-align: left; white-space: nowrap;">An. {{ $usaha->ttd }}</td>
                </tr>
            </table>
            <table width="602px" style="margin-bottom: 100px;">
                <tr>
                    <td width="65%"></td>
                    <td style="text-align: left; white-space: nowrap;">{{ $usaha->namaTtd }}</td>
                </tr>
            </table>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Tugas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <table width="100%">
                <tr>
                    <td><img src="inspektorat.png" width="100" height="110" /></td>
                    <td style="font-family: 'Times New Roman', Times, serif; font-size: 13px; text-align: center;">
                        <div>
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
            <table width="100%">
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
                    <td width="381px"></td>
                    <td style="text-align: right; padding-right: 10px; white-space: nowrap;">Dikeluarkan di :</td>
                    <td style="text-align: left; padding-left: 10px; white-space: nowrap;">Jambi</td>
                </tr>
                <tr>
                    <td width="60%"></td>
                    <td style="text-align: right; padding-right: 10px; white-space: nowrap;">Pada Tanggal :</td>
                    <td style="text-align: left; padding-left: 10px; white-space: nowrap;">{{ date('d F Y', strtotime($sakit->tglSurat)) }}</td>
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
                    <td style="text-align: left; white-space: nowrap;">An. {{ $sakit->ttd }}</td>
                </tr>
            </table>
            <table width="602px" style="margin-bottom: 100px;">
                <tr>
                    <td width="65%"></td>
                    <td style="text-align: left; white-space: nowrap;"><b>{{ $sakit->namaTtd }}</b></td>
                </tr>
                <tr>
                    <td width="65%"></td>
                    <td style="text-align: left; white-space: nowrap;">{{ $sakit->tempatTglLahir }}</td>
                </tr>
                <tr>
                    <td width="65%"></td>
                    <td style="text-align: left; white-space: nowrap;">NIP. {{ $sakit->nik }}</td>
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
</body>
</html>

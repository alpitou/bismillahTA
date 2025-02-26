<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Audit</title>
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
</body>
</html>

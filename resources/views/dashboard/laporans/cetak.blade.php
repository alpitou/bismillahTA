<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Laporan Hasil Pemeriksaan</title>
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
      <table width="450">
        <tr>
          <td style="font-size: 18px; text-align: center; font-weight: bold">
            <u>LAPORAN HASIL PEMERIKSAAN</u>
          </td>
        </tr>
        <tr>
          <td style="text-align: center;">Nomor : WAS. {{ $laporan->kodeLaporan }}/{{ $laporan->nomor_lhp }}/2025</td>
        </tr>
      </table>
      <br /><br />
      <table width="100%">
      <tr>
        <td style="text-align: center;"><strong>{!! $laporan->judul !!}</strong></td>
      </tr>
      </table>
      <br /><br /><br />
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
      <br /><br /><br />
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
  </body>
</html>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Cetak Laporan</title>
    <style>
      body {
        margin: 0 auto;
        width: 600px;
        font-family: 'Times New Roman', Times, serif;
      }
    </style>
  </head>
  <body>
    <center>
      <table width="450">
        <tr>
          <td><img src="{{ asset('dashmin/img/logo_cetak.svg') }}" width="110" height="110" /></td>
          <td style="font-size: 13px">
            <center>
              <font size="5"><b>PEMERINTAH KOTA LHOKSEUMAWE</b> </font><br />
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
      <table width="450">
        <tr>
          <td style="font-size: 18px; text-align: center; font-weight: bold">
            <u>LAPORAN HASIL PEMERIKSAAN</u>
          </td>
        </tr>
        <tr>
          <td style="text-align: center">Nomor: {{ $laporan->kodeLaporan }}/{{ $laporan->nomor_lhp }}/2023</td>
        </tr>
      </table>
      <br /><br />
      <table width="450">
        <tr>
          <td><b>Judul:</b> {{ $laporan->judul }}</td>
        </tr>
        <tr>
          <td><b>Tanggal Pemeriksaan:</b> {{ date('d M Y', strtotime($laporan->tgl_pemeriksaan)) }}</td>
        </tr>
      </table>
      <br /><br />
      <table width="450">
        <tr>
          <td><b>Ringkasan Hasil:</b></td>
        </tr>
        <tr>
          <td>{!! $laporan->ringkasan_hasil !!}</td>
        </tr>
      </table>
      <br />
      <table width="450">
        <tr>
          <td><b>Uraian Hasil:</b></td>
        </tr>
        <tr>
          <td>{!! $laporan->uraian_hasil !!}</td>
        </tr>
      </table>
      <br />
      <table width="450">
        <tr>
          <td><b>Kesimpulan:</b></td>
        </tr>
        <tr>
          <td>{!! $laporan->kesimpulan !!}</td>
        </tr>
      </table>
      <br />
      <table width="450">
        <tr>
          <td><b>Saran:</b></td>
        </tr>
        <tr>
          <td>{!! $laporan->saran !!}</td>
        </tr>
      </table>
      <br /><br />
      <table width="450">
        <tr>
          <td>Demikian laporan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</td>
        </tr>
      </table>
      <br /><br /><br />
      <table width="450">
        <tr>
          <td width="300"></td>
          <td style="text-align: left">Paya Punteuet, {{ date('d M Y') }}</td>
        </tr>
        <tr>
          <td width="300"></td>
          <td style="text-align: left">An. {{ $laporan->ttd }}</td>
        </tr>
      </table>
      <br /><br />
      <table width="450">
        <tr>
          <td width="300"></td>
          <td style="text-align: left">{{ $laporan->namaTtd }}</td>
        </tr>
      </table>
    </center>
  </body>
</html>

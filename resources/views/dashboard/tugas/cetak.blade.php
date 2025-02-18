<!DOCTYPE html>
<html lang="en">
<head>
    <title>Surat Tugas</title>
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
                <td style="text-align: center; font-size: 13px">
                    <font size="5"><b>PEMERINTAH KOTA LHOKSEUMAWE</b></font><br />
                    <font size="4"><b>KECAMATAN MUARA DUA</b></font><br />
                    <font size="5"><b>GAMPONG PAYA PUNTEUET</b></font><br />
                    <font size="3"><i>JLN. Tgk, WAHAB DAHLAWI KM.1</i></font>
                </td>
            </tr>
            <tr>
                <td colspan="2"><hr style="border: 1px solid" /></td>
            </tr>
        </table>
        <br />
        <table width="450">
            <tr>
                <td style="text-align: center; font-size: 18px; font-weight: bold">
                    <u>SURAT TUGAS</u>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">Nomor : {{ $tugas->kodeSurat }}/{{ $tugas->noSurat }}/2023</td>
            </tr>
        </table>
        <br /><br />
        <table width="450">
            <tr>
                <td>Yang bertanda tangan di bawah ini menerangkan bahwa :</td>
            </tr>
        </table>
        <br />
        <table width="450">
            <tr>
                <td width="120">Nama</td>
                <td width="10">:</td>
                <td width="335">{{ $tugas->nama }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $tugas->nik }}</td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>:</td>
                <td>{{ $tugas->tempatTglLahir }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td>{{ $tugas->pekerjaan }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $tugas->alamat }}</td>
            </tr>
        </table>
        <br />
        <table width="450">
            <tr>
                <td>{!! $tugas->keterangan !!}</td>
            </tr>
        </table>
        <br /><br />
        <table width="450">
            <tr>
                <td>Demikian surat tugas ini dibuat agar dapat digunakan sebagaimana mestinya.</td>
            </tr>
        </table>
        <br /><br />
        <table width="450">
            <tr>
                <td width="300"></td>
                <td style="text-align: left">Paya Punteuet, {{ date('d M Y', strtotime($tugas->tglSurat)) }}</td>
            </tr>
            <tr>
                <td width="300"></td>
                <td style="text-align: left">An. {{ $tugas->ttd }}</td>
            </tr>
        </table>
        <br /><br />
        <table width="450">
            <tr>
                <td width="300"></td>
                <td style="text-align: left">{{ $tugas->namaTtd }}</td>
            </tr>
        </table>
    </center>
</body>
</html>

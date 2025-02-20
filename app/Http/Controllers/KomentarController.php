<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Domisili;
use App\Models\Usaha;
use App\Models\Sakit; // Tambahkan model Sakit
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    // Fungsi untuk menyimpan komentar pada surat domisili
    public function store(Request $request, $noSurat)
    {
        // Validasi input komentar
        $request->validate([
            'komentar' => 'required|string|max:255',
        ]);

        // Cari surat berdasarkan noSurat
        $domisili = Domisili::where('noSurat', $noSurat)->first();

        if ($domisili) {
            // Simpan komentar hanya untuk surat yang sesuai
            $domisili->komentar = $request->komentar;
            $domisili->save();

            // Kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Komentar berhasil disimpan!');
        }

        // Jika surat tidak ditemukan
        return redirect()->back()->with('error', 'Surat tidak ditemukan!');
    }

    // Fungsi untuk menyimpan komentar pada surat usaha
    public function storeKomentar(Request $request, $noSurat)
    {
        $request->validate([
            'komentar' => 'required|string|max:255',
        ]);

        $usaha = Usaha::where('noSurat', $noSurat)->firstOrFail();
        $usaha->komentar = $request->komentar;
        $usaha->save();

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    // Fungsi untuk menyimpan komentar pada surat sakit
    public function storeKomentarSakit(Request $request, $noSurat)
    {
        $request->validate([
            'komentar' => 'required|string|max:255',
        ]);

        $sakit = Sakit::where('noSurat', $noSurat)->firstOrFail();

        $sakit->komentar = $request->komentar;
        $sakit->save();

    return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}

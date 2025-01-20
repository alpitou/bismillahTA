<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Domisili;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

namespace App\Http\Controllers;
use App\Models\Usaha;
use App\Models\Domisili;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    // Fungsi untuk menyimpan komentar
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

}

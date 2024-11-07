<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Domisili;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    /**
     * Menampilkan daftar komentar untuk domisili tertentu.
     */
    public function index($domisili_id)
    {
        $domisili = Domisili::findOrFail($domisili_id);
        $komentars = $domisili->komentars()->get();

        return view('dashboard.komentars.index', [
            'title' => 'Komentar',
            'domisili' => $domisili,
            'komentars' => $komentars
        ]);
    }

    /**
     * Menyimpan komentar baru untuk domisili tertentu.
     */
    public function store(Request $request, $domisili_id)
    {
        $request->validate([
            'konten' => 'required|string',
        ]);

        Komentar::create([
            'domisili_id' => $domisili_id,
            'user_id' => Auth::id(),
            'konten' => $request->konten,
            'tanggal' => now(),
            'ttd' => Auth::user()->ttd ?? null, // jika user memiliki ttd, gunakan
            'namaTtd' => Auth::user()->name,
        ]);

        return redirect()->route('komentar.index', $domisili_id)->with('success', 'Komentar berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit untuk komentar tertentu.
     */
    public function edit($domisili_id, $id)
    {
        $komentar = Komentar::where('domisili_id', $domisili_id)->findOrFail($id);

        return view('dashboard.komentars.edit', [
            'title' => 'Edit Komentar',
            'komentar' => $komentar
        ]);
    }

    /**
     * Memperbarui komentar.
     */
    public function update(Request $request, $domisili_id, $id)
    {
        $request->validate([
            'konten' => 'required|string',
        ]);

        $komentar = Komentar::where('domisili_id', $domisili_id)->findOrFail($id);
        $komentar->update([
            'konten' => $request->konten,
        ]);

        return redirect()->route('komentar.index', $domisili_id)->with('success', 'Komentar berhasil diperbarui');
    }

    /**
     * Menghapus komentar.
     */
    public function destroy($domisili_id, $id)
    {
        $komentar = Komentar::where('domisili_id', $domisili_id)->findOrFail($id);
        $komentar->delete();

        return redirect()->route('komentar.index', $domisili_id)->with('success', 'Komentar berhasil dihapus');
    }
}

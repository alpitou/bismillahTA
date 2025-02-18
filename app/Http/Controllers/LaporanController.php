<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use PDF;
use Log;

class LaporanController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $laporans = Laporan::when($user->hasRole(['Inspektur', 'Ketua Tim']), function ($query) {
            return $query->latest();
        }, function ($query) use ($user) {
            return $query->where('user_id', $user->id);
        })->latest()->paginate(8);

        return view('dashboard.laporans.index', [
            'title' => 'Laporan',
            'laporans' => $laporans,
            'totalLaporan' => $laporans->total(),
        ]);
    }

    public function create()
    {
        return view('dashboard.laporans.create', [
            'title' => 'Tambah Laporan',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kodeLaporan' => 'required|numeric',
            'nomor_lhp' => 'required|numeric',
            'judul' => 'required|string|max:255',
            'tgl_pemeriksaan' => 'required|date',
            'ringkasan_hasil' => 'required',
            'uraian_hasil' => 'required',
            'kesimpulan' => 'required',
            'saran' => 'required',
            'ttd' => 'required|max:255',
            'namaTtd' => 'required|max:255',
        ]);

        $validatedData['user_id'] = auth()->id();

        Laporan::create($validatedData);

        return redirect('/dashboard/laporan')->with('success', 'Laporan berhasil ditambahkan!');
    }

    public function show(Laporan $laporan)
    {
        $this->authorizeAccess($laporan);

        return view('dashboard.laporans.show', [
            'title' => 'Detail Laporan',
            'laporan' => $laporan,
        ]);
    }

    public function edit(Laporan $laporan)
    {
        $this->authorizeAccess($laporan);

        return view('dashboard.laporans.edit', [
            'title' => 'Edit Laporan',
            'laporan' => $laporan,
        ]);
    }

    public function update(Request $request, Laporan $laporan)
    {
        $this->authorizeAccess($laporan);

        $validatedData = $request->validate([
            'kodeLaporan' => 'required|numeric',
            'judul' => 'required|string|max:255',
            'tgl_pemeriksaan' => 'required|date',
            'ringkasan_hasil' => 'required',
            'uraian_hasil' => 'required',
            'kesimpulan' => 'required',
            'saran' => 'required',
            'ttd' => 'required|max:255',
            'namaTtd' => 'required|max:255',
        ]);

        $laporan->update($validatedData);

        return redirect('/dashboard/laporan')->with('success', 'Laporan berhasil diperbarui!');
    }

    public function destroy(Laporan $laporan)
    {
        $this->authorizeAccess($laporan);

        $laporan->delete();
        return redirect('/dashboard/laporan')->with('success', 'Laporan berhasil dihapus!');
    }

    public function cetak(Laporan $laporan)
    {
        $this->authorizeAccess($laporan);
        
        try {
            Log::info('PDF generation initiated for Laporan: ' . $laporan->kodeLaporan);
            set_time_limit(120);
            $pdf = PDF::loadView('dashboard.laporans.cetak', [
                'title' => 'Cetak Laporan',
                'laporan' => $laporan,
            ])->setPaper('a4', 'portrait');
            
            Log::info('PDF generation completed successfully for Laporan: ' . $laporan->kodeLaporan);
            return $pdf->stream('Laporan_' . $laporan->kodeLaporan . '.pdf');
        } catch (\Exception $e) {
            Log::error('Error generating PDF for Laporan: ' . $laporan->kodeLaporan, ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat mencetak laporan.');
        }
    }

    private function authorizeAccess(Laporan $laporan)
    {
        $user = auth()->user();
        if ($user->hasRole('Pegawai') && $laporan->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk laporan ini. Harap hubungi admin jika Anda memerlukan akses.');
        }
    }
}

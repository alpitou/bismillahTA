<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use PDF;
use Log;

class TugasController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $tugas = Tugas::when($user->hasRole(['Inspektur', 'Ketua Tim']), function ($query) {
            return $query->latest();
        }, function ($query) use ($user) {
            return $query->where('user_id', $user->id);
        })->latest()->paginate(8);

        return view('dashboard.tugas.index', [
            'title' => 'Tugas',
            'tugas' => $tugas,
            'totalTugas' => $tugas->total(),
        ]);
    }

    public function create()
    {
        return view('dashboard.tugas.create', [
            'title' => 'Tugas',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kodeSurat' => 'required|numeric',
            'noSurat' => 'required|numeric',
            'nama' => 'required|max:255',
            'nik' => 'required|numeric',
            'tempatTglLahir' => 'required|max:255',
            'pekerjaan' => 'required|max:255',
            'alamat' => 'required',
            'keterangan' => 'required',
            'tglSurat' => 'required|date',
            'ttd' => 'required|max:255',
            'namaTtd' => 'required|max:255',
        ]);

        $validatedData['user_id'] = auth()->id();

        Tugas::create($validatedData);

        return redirect('/dashboard/tugas')->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function show(Tugas $tugas)
    {
        $this->authorizeAccess($tugas);

        return view('dashboard.tugas.show', [
            'title' => 'Detail Tugas',
            'tugas' => $tugas,
        ]);
    }

    public function edit(Tugas $tugas)
    {
        $this->authorizeAccess($tugas);

        return view('dashboard.tugas.edit', [
            'title' => 'Edit Tugas',
            'tugas' => $tugas,
        ]);
    }

    public function update(Request $request, Tugas $tugas)
    {
        $this->authorizeAccess($tugas);

        $validatedData = $request->validate([
            'kodeSurat' => 'required|max:255',
            'noSurat' => 'required|numeric',
            'nama' => 'required|max:255',
            'nik' => 'required|numeric',
            'tempatTglLahir' => 'required|max:255',
            'pekerjaan' => 'required|max:255',
            'alamat' => 'required',
            'keterangan' => 'required',
            'tglSurat' => 'required|date',
            'ttd' => 'required|max:255',
            'namaTtd' => 'required|max:255',
        ]);

        $tugas->update($validatedData);

        return redirect('/dashboard/tugas')->with('success', 'Tugas berhasil diperbarui!');
    }

    public function destroy(Tugas $tugas)
    {
        $this->authorizeAccess($tugas);

        $tugas->delete();
        return redirect('/dashboard/tugas')->with('success', 'Tugas berhasil dihapus!');
    }

    public function cetak(Tugas $tugas)
    {
        $this->authorizeAccess($tugas);
        
        try {
            Log::info('PDF generation initiated for Tugas: ' . $tugas->kodeSurat);
            set_time_limit(120);
            $pdf = PDF::loadView('dashboard.tugas.cetak', [
                'title' => 'Cetak Tugas',
                'tugas' => $tugas,
            ])->setPaper('a4', 'portrait');
            
            Log::info('PDF generation completed successfully for Tugas: ' . $tugas->kodeSurat);
            return $pdf->stream('Tugas_' . $tugas->kodeSurat . '.pdf');
        } catch (\Exception $e) {
            Log::error('Error generating PDF for Tugas: ' . $tugas->kodeSurat, ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat mencetak tugas.');
        }
    }

    private function authorizeAccess(Tugas $tugas)
    {
        $user = auth()->user();
        if ($user->hasRole('Pegawai') && $tugas->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk tugas ini. Harap hubungi admin jika Anda memerlukan akses.');
        }
    }
}

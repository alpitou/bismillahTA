<?php

namespace App\Http\Controllers;

use App\Models\Sakit;
use Illuminate\Http\Request;
use Log;
use PDF;

class SakitController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $sakits = Sakit::when($user->hasRole(['Inspektur', 'Ketua Tim']), function ($query) {
            return $query->latest();
        }, function ($query) use ($user) {
            return $query->where('user_id', $user->id);
        })->latest()->paginate(8);

        return view('dashboard.sakits.index', [
            'title' => 'Sakit',
            'sakits' => $sakits,
            'totalSakit' => $sakits->total(),
        ]);
    }

    public function create()
    {
        return view('dashboard.sakits.create', [
            'title' => 'Tambah Surat Sakit',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kodeSurat' => 'required|numeric',
            'noSurat' => 'required|numeric|unique:sakits',
            'nama' => 'max:255',
            'nik' => 'numeric',
            'tempatTglLahir' => '',
            'pekerjaan' => '',
            'alamat' => '',
            'keterangan' => '',
            'tglSurat' => 'date',
            'ttd' => '',
            'namaTtd' => '',
        ]);

        $validatedData['user_id'] = auth()->id();

        Sakit::create($validatedData);

        return redirect('/dashboard/sakit')->with('success', 'Surat sakit berhasil ditambahkan!');
    }

    public function show(Sakit $sakit)
    {
        $this->authorizeAccess($sakit);
        return view('dashboard.sakits.show', [
            'title' => 'Detail Surat Sakit',
            'sakit' => $sakit,
        ]);
    }

    public function edit(Sakit $sakit)
    {
        $this->authorizeAccess($sakit);
        return view('dashboard.sakits.edit', [
            'title' => 'Edit Surat Sakit',
            'sakit' => $sakit,
        ]);
    }

    public function update(Request $request, Sakit $sakit)
    {
        $this->authorizeAccess($sakit);

        $rules = [
            'kodeSurat' => 'required|numeric',
            'nama' => 'required|max:255',
            'nik' => 'numeric',
            'tempatTglLahir' => '',
            'pekerjaan' => '',
            'alamat' => '',
            'keterangan' => '',
            'tglSurat' => 'date',
            'ttd' => 'max:255',
            'namaTtd' => 'max:255',
        ];

        if ($request->noSurat != $sakit->noSurat) {
            $rules['noSurat'] = 'required|numeric|unique:sakits';
        }

        $validatedData = $request->validate($rules);
        $sakit->update($validatedData);

        return redirect('/dashboard/sakit')->with('success', 'Surat sakit berhasil diperbarui!');
    }

    public function destroy(Sakit $sakit)
    {
        $this->authorizeAccess($sakit);
        $sakit->delete();
        return redirect('/dashboard/sakit')->with('success', 'Surat sakit berhasil dihapus!');
    }

    public function cetak(Sakit $sakit)
    {
        $this->authorizeAccess($sakit);

        try {
            Log::info('PDF generation initiated for Sakit No: ' . $sakit->noSurat);
            set_time_limit(120);

            $pdf = PDF::loadView('dashboard.sakits.cetak', [
                'title' => 'Cetak Surat Sakit',
                'sakit' => $sakit,
            ])->setPaper('a4', 'portrait');

            Log::info('PDF generation completed successfully for Sakit No: ' . $sakit->noSurat);
            return $pdf->stream('Sakit_' . $sakit->noSurat . '.pdf');
        } catch (\Exception $e) {
            Log::error('Error generating PDF for Sakit No: ' . $sakit->noSurat, [
                'error' => $e->getMessage(),
            ]);
            return back()->with('error', 'Terjadi kesalahan saat mencetak surat.');
        }
    }

    private function authorizeAccess(Sakit $sakit)
    {
        $user = auth()->user();
        if ($user->hasRole('Pegawai') && $sakit->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk melihat surat ini. Harap hubungi admin jika Anda memerlukan akses.');
        }
    }
}

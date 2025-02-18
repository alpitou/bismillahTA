<?php

namespace App\Http\Controllers;

use App\Models\Usaha;
use Illuminate\Http\Request;
use Log;
use PDF;

class DashboardUsaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $usahas = Usaha::when($user->hasRole(['Inspektur', 'Ketua Tim']), function ($query) {
            return $query->latest();
        }, function ($query) use ($user) {
            return $query->where('user_id', $user->id);
        })->latest()->paginate(8);

        return view('dashboard.usahas.index', [
            'title' => 'Usaha',
            'usahas' => $usahas,
            'totalUsaha' => $usahas->total(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.usahas.create', [
            'title' => 'Usaha',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        Usaha::create($validatedData);

        return redirect('/dashboard/usaha')->with('success', 'Surat berhasil ditambahkan!');
    }

    public function show(Usaha $usaha)
    {
        $this->authorizeAccess($usaha);
        return view('dashboard.usahas.show', [
            'title' => 'Usaha',
            'usaha' => $usaha,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usaha  $usaha
     * @return \Illuminate\Http\Response
     */
    public function edit(Usaha $usaha)
    {
        $this->authorizeAccess($usaha);

        return view('dashboard.usahas.edit', [
            'title' => 'Edit Usaha',
            'usaha' => $usaha,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usaha  $usaha
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usaha $usaha)
    {
        $this->authorizeAccess($usaha);

        $rules = [
            'kodeSurat' => 'required|numeric',
            'nama' => 'required|max:255',
            'nik' => 'required|numeric',
            'tempatTglLahir' => 'required|max:255',
            'pekerjaan' => 'required|max:255',
            'alamat' => 'required|max:255',
            'keterangan' => 'required|max:255',
            'tglSurat' => 'required|date',
            'ttd' => 'required|max:255',
            'namaTtd' => 'required|max:255',
        ];

        if ($request->noSurat != $usaha->noSurat) {
            $rules['noSurat'] = 'required|numeric|unique:usahas';
        }

        $validatedData = $request->validate($rules);

        $usaha->update($validatedData);

        return redirect('/dashboard/usaha')->with('success', 'Surat berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usaha  $usaha
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usaha $usaha)
    {
        $this->authorizeAccess($usaha);

        $usaha->delete();
        return redirect('/dashboard/usaha')->with('success', 'Surat berhasil dihapus!');
    }

    /**
     * Generate PDF for a specific Usaha resource.
     *
     * @param  \App\Models\Usaha  $usaha
     * @return \Illuminate\Http\Response
     */
    public function cetak(Usaha $usaha)
    {
        $this->authorizeAccess($usaha);

        try {
            Log::info('PDF generation initiated for Usaha No: ' . $usaha->noSurat);

            set_time_limit(120);
            $pdf = PDF::loadView('dashboard.usahas.cetak', [
                'title' => 'Cetak Usaha',
                'usaha' => $usaha,
            ])->setPaper('a4', 'portrait');

            Log::info('PDF generation completed successfully for Usaha No: ' . $usaha->noSurat);

            return $pdf->stream('Usaha_' . $usaha->noSurat . '.pdf');
        } catch (\Exception $e) {
            Log::error('Error generating PDF for Usaha No: ' . $usaha->noSurat, [
                'error' => $e->getMessage(),
            ]);

            return back()->with('error', 'Terjadi kesalahan saat mencetak surat.');
        }
    }

    /**
     * Authorize access for specific roles.
     *
     * @param  \App\Models\Usaha  $usaha
     * @return void
     */
    private function authorizeAccess(Usaha $usaha)
    {
        $user = auth()->user();

        if ($user->hasRole('Pegawai') && $usaha->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk melihat surat ini.');
        }
    }
}
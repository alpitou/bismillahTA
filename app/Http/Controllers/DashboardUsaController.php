<?php

namespace App\Http\Controllers;

use App\Models\Usaha;
use Illuminate\Http\Request;
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
            // Tampilkan surat milik pengguna biasa
            return $query->where('user_id', $user->id)->latest();
        })->paginate(8);

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
            'alamat' => 'required|max:255',
            'keterangan' => 'required|max:255',
            'tglSurat' => 'required|date',
            'ttd' => 'required|max:255',
            'namaTtd' => 'required|max:255',
        ]);

        Usaha::create($validatedData);

        return redirect('/dashboard/usaha')->with('success', 'Surat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usaha  $usaha
     * @return \Illuminate\Http\Response
     */
    public function show(Usaha $usaha)
    {
        return view('dashboard.usahas.show', [
            'title' => 'Usaha',
            'active' => 'usaha',
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
        return view('dashboard.usahas.edit', [
            'title' => 'Usaha',
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

        Usaha::where('id', $usaha->id)
            ->update($validatedData);

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
        Usaha::destroy($usaha->id);

        return redirect('/dashboard/usaha')->with('success', 'Surat berhasil dihapus!');
    }

    public function cetak(Usaha $usaha)
    {
        set_time_limit(120);
        $pdf = PDF::loadview('dashboard.usahas.cetak', [
            'title' => 'Cetak',
            'usaha' => $usaha,
        ])->setPaper('a4', 'potrait');
        return $pdf->stream('Usaha_' . $usaha->noSurat . '.pdf');
    }

    private function authorizeAccess(Usaha $usaha)
{
    $user = auth()->user();

    if ($user->hasRole('Pegawai') && $usaha->user_id !== $user->id) {
        abort(403, 'Anda tidak memiliki akses untuk melihat surat ini. Harap hubungi admin jika Anda memerlukan akses.');
    }
}
}

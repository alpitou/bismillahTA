<?php

namespace App\Http\Controllers;

use App\Models\Domisili;
use Illuminate\Http\Request;
use Log;
use PDF;

class DashboardDomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = auth()->user();

        // if ($user->hasRole(['Inspektur', 'Ketua Tim'])) {
        //     // Jika pengguna adalah Inspektur atau Ketua Tim, tampilkan semua surat
        //     $domisilis = Domisili::latest()->paginate(8);
        // } else {
        //     // Jika pengguna adalah Pegawai, hanya tampilkan surat yang dibuat oleh dirinya
        //     $domisilis = Domisili::where('id', $user->id)->latest()->paginate(8);
        // }

        // return view('dashboard.domisilis.index', [
        //     'title' => 'Domisili',
        //     'domisilis' => $domisilis,
        //     'totalDomisili' => $domisilis->total(), // Sesuai dengan data yang difilter
        // ]);

        return view('dashboard.domisilis.index', [
            'title' => 'Domisili',
            'domisilis' => Domisili::latest()->paginate(8),
            'totalDomisili' => Domisili::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.domisilis.create', [
            'title' => 'Domisili',
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

        $validatedData['user_id'] = auth()->id(); // Menambahkan user_id ke data yang divalidasi

        Domisili::create($validatedData);

        return redirect('/dashboard/domisili')->with('success', 'Surat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Domisili  $domisili
     * @return \Illuminate\Http\Response
     */
    public function show(Domisili $domisili)
    {
        $this->authorizeAccess($domisili);

        return view('dashboard.domisilis.show', [
            'title' => 'Domisili',
            'domisili' => $domisili,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Domisili  $domisili
     * @return \Illuminate\Http\Response
     */
    public function edit(Domisili $domisili)
    {
        $this->authorizeAccess($domisili);

        return view('dashboard.domisilis.edit', [
            'title' => 'Edit',
            'domisili' => $domisili,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Domisili  $domisili
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Domisili $domisili)
    {
        $this->authorizeAccess($domisili);

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

        if ($request->noSurat != $domisili->noSurat) {
            $rules['noSurat'] = 'required|numeric|unique:domisilis';
        }

        $validatedData = $request->validate($rules);

        $domisili->update($validatedData);

        return redirect('/dashboard/domisili')->with('success', 'Surat berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Domisili  $domisili
     * @return \Illuminate\Http\Response
     */
    public function destroy(Domisili $domisili)
    {
        $this->authorizeAccess($domisili);

        $domisili->delete();
        return redirect('/dashboard/domisili')->with('success', 'Surat berhasil dihapus!');
    }

    public function cetak(Domisili $domisili)
    {
        // Authorize access to the Domisili resource
        $this->authorizeAccess($domisili);
    
        try {
            // Log the start of PDF generation
            Log::info('PDF generation initiated for Domisili No: ' . $domisili->noSurat);
            
            set_time_limit(120);
            // Generate PDF
            $pdf = PDF::loadView('dashboard.domisilis.cetak', [
                'title' => 'Cetak',
                'domisili' => $domisili,
            ])
            ->setPaper('a4', 'portrait'); // Set paper size and orientation
    
            // Log successful PDF generation
            Log::info('PDF generation completed successfully for Domisili No: ' . $domisili->noSurat);
    
            // Stream the generated PDF to the browser
            return $pdf->stream('Domisili_' . $domisili->noSurat . '.pdf');
        } catch (\Exception $e) {
            // Log any errors that occur
            Log::error('Error generating PDF for Domisili No: ' . $domisili->noSurat, [
                'error' => $e->getMessage(),
            ]);
    
            // Handle error (return a friendly message or fallback behavior)
            return back()->with('error', 'Terjadi kesalahan saat mencetak surat.');
        }
    }
    
    
    

    /**
     * Authorize access for specific roles.
     *
     * @param  \App\Models\Domisili  $domisili
     * @return void
     */
    private function authorizeAccess(Domisili $domisili)
    {
        $user = auth()->user();

        if ($user->hasRole('Pegawai') && $domisili->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke surat ini.');
        }
    }
}

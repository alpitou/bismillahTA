<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\Request;
use PDF;
use Log;

class AuditController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $audits = Audit::when($user->hasRole(['Inspektur', 'Ketua Tim']), function ($query) {
            return $query->latest();
        }, function ($query) use ($user) {
            return $query->where('user_id', $user->id);
        })->latest()->paginate(8);

        return view('dashboard.audits.index', [
            'title' => 'Audit',
            'audits' => $audits,
            'totalAudit' => $audits->total(),
        ]);
    }

    public function create()
    {
        return view('dashboard.audits.create', [
            'title' => 'Tambah Audit',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kodeLaporan' => 'required|numeric',
            'nomor_lhp' => 'required|numeric',
            'judul' => 'required|string|max:255',
            'tgl_pemeriksaan' => 'required|date',
            'latar_belakang' => 'required',
            'tujuan' => 'required',
            'waktu' => 'required',
            'ruang_lingkup' => 'required',
            'hasil' => 'required',
            'rekomendasi' => 'required',
            'kesimpulan' => 'required',
        ]);

        $validatedData['user_id'] = auth()->id();

        Audit::create($validatedData);

        return redirect('/dashboard/audit')->with('success', 'Audit berhasil ditambahkan!');
    }

    public function show(Audit $audit)
    {
        $this->authorizeAccess($audit);

        return view('dashboard.audits.show', [
            'title' => 'Detail Audit',
            'audit' => $audit,
        ]);
    }

    public function edit(Audit $audit)
    {
        $this->authorizeAccess($audit);

        return view('dashboard.audits.edit', [
            'title' => 'Edit Audit',
            'audit' => $audit,
        ]);
    }

    public function update(Request $request, Audit $audit)
    {
        $this->authorizeAccess($audit);

        $rules = [
            'kodeLaporan' => 'required|numeric',
            'judul' => 'string|max:255',
            'tgl_pemeriksaan' => 'date',
            'latar_belakang' => '',
            'tujuan' => '',
            'waktu' => '',
            'ruang_lingkup' => '',
            'hasil' => '',
            'rekomendasi' => '',
            'kesimpulan' => '',
        ];

        if ($request->nomor_lhp != $audit->nomor_lhp) {
            $rules['nomor_lhp'] = 'required|numeric';
        }

        $validatedData = $request->validate($rules);

        $audit->update($validatedData);

        return redirect('/dashboard/audit')->with('success', 'Audit berhasil diperbarui!');
    }

    public function destroy(Audit $audit)
    {
        $this->authorizeAccess($audit);

        $audit->delete();
        return redirect('/dashboard/audit')->with('success', 'Audit berhasil dihapus!');
    }

    public function cetak(Audit $audit)
    {
        $this->authorizeAccess($audit);
        
        try {
            Log::info('PDF generation initiated for Audit: ' . $audit->kodeLaporan);
            set_time_limit(120);
            $pdf = PDF::loadView('dashboard.audits.cetak', [
                'title' => 'Cetak Audit',
                'audit' => $audit,
            ])->setPaper('a4', 'portrait');
            
            Log::info('PDF generation completed successfully for Audit: ' . $audit->kodeLaporan);
            return $pdf->stream('Audit_' . $audit->kodeLaporan . '.pdf');
        } catch (\Exception $e) {
            Log::error('Error generating PDF for Audit: ' . $audit->kodeLaporan, ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat mencetak audit.');
        }
    }

    private function authorizeAccess(Audit $audit)
    {
        $user = auth()->user();
        if ($user->hasRole('Pegawai') && $audit->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk audit ini. Harap hubungi admin jika Anda memerlukan akses.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\Domisili;
use App\Models\Laporan;
use App\Models\Usaha;
use App\Models\Sakit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'domisilis' => Domisili::latest()->paginate(5),
            'usahas' => Usaha::latest()->paginate(5),
            'sakits' => Sakit::latest()->paginate(5),
            'audits' => Audit::latest()->paginate(5),
            'laporans' => Laporan::latest()->paginate(5),
            'totalDomisili' => Domisili::count(),
            'totalLaporan' => Laporan::count(),
            'totalAudit' => Audit::count(),
            'totalUsaha' => Usaha::count(),
            'totalSakit' => Sakit::count(),
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model {
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'nomor_lhp';
    }

    protected $fillable = ['kodeLaporan','nomor_lhp', 'user_id', 'judul', 'tgl_pemeriksaan', 'ringkasan_hasil', 'uraian_hasil', 'kesimpulan', 'saran', 'user_id', 'ttd', 'namaTtd'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

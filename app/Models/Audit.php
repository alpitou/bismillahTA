<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'nomor_lhp';
    }

    protected $table = 'audits';

    protected $fillable = [
        'kodeLaporan',
        'nomor_lhp',
        'judul',
        'tgl_pemeriksaan',
        'latar_belakang',
        'tujuan',
        'waktu',
        'ruang_lingkup',
        'hasil',
        'rekomendasi',
        'kesimpulan',
        'user_id',
    ];

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

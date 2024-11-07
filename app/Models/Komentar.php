<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan penamaan konvensional
    protected $table = 'komentars';

    // Tentukan kolom-kolom yang dapat diisi
    protected $fillable = [
        'domisili_id',
        'user_id',
        'konten',
        'tanggal',
        'ttd',
        'namaTtd',
    ];

    /**
     * Relasi dengan model Domisili
     */
    public function domisili()
    {
        return $this->belongsTo(Domisili::class);
    }

    /**
     * Relasi dengan model User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

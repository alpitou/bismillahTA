<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    /**
     * Tentukan kolom-kolom yang boleh diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'jabatan',
        'email',
        'alamat',
    ];

    /**
     * Definisikan relasi atau metode tambahan sesuai kebutuhan aplikasi.
     * Contoh: jika Pegawai memiliki hubungan dengan tabel lain, misalnya Department.
     */

    // public function department()
    // {
    //     return $this->belongsTo(Department::class);
    // }

    /**
     * Definisikan aksesors, mutators, atau metode tambahan lainnya.
     */

    // Contoh accessor untuk nama lengkap (misalnya jika ingin menambah gelar atau format tertentu)
    // public function getFormattedNameAttribute()
    // {
    //     return $this->nama . ' (' . $this->jabatan . ')';
    // }
}

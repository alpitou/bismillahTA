<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tugas extends Model
{
    use HasFactory;

    protected $table = 'tugas';

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'noSurat';
    }

    protected $fillable = [
        'user_id',
        'kodeSurat',
        'noSurat',
        'nama',
        'nik',
        'tempatTglLahir',
        'pekerjaan',
        'alamat',
        'keterangan',
        'tglSurat',
        'ttd',
        'namaTtd',
    ];

    /**
     * Get the user that owns the Tugas.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

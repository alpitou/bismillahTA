<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sakit extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'noSurat';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id', 'kodeSurat', 'noSurat', 'nama', 'nik', 'tempatTglLahir',
        'pekerjaan', 'alamat', 'keterangan', 'tglSurat', 'ttd', 'namaTtd'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domisili extends Model
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

protected $fillable = ['noSurat', 'nama','tglSurat','user_id','komentar','kodeSurat','nik','tempatTglLahir','pekerjaan','alamat', 'keterangan', 'ttd','namaTtd'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'cutis';

    protected $fillable = [
        'id_pegawai', 'keterangan', 'dari', 'sampai'
    ];

    public static $rules = [
        'id_pegawai' => 'required|exists:pegawais,id',
        'keterangan' => 'nullable',
        'dari' => 'required|date',
        'sampai' => 'required|date|after_or_equal:dari',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
}

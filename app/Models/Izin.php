<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;

    protected $table = 'izins';

    protected $fillable = [
        'id_pegawai', 'keterangan', 'alasan'
    ];

    public static $rules = [
        'id_pegawai' => 'required|exists:pegawais,id',
        'alasan' => 'required|string',
        'keterangan' => 'nullable',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
}

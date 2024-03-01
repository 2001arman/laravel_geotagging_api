<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawais';

    protected $fillable = [
        'name', 'nip', 'email', 'password', 'gender', 'tanggal_lahir', 'phone', 'divisi'
    ];

    public static $rules = [
        'name' => 'required',
        'nip' => 'required',
        'email' => 'required|email|unique:pegawais,email|regex:/(.*)@(.*)\.(.*)/',
        'password' => 'required|min:6',
        'gender' => 'required|in:1,2', // assuming 1 = male, 2 = female
        'tanggal_lahir' => 'nullable|date',
        'phone' => 'nullable',
        'divisi' => 'nullable',
    ];
}

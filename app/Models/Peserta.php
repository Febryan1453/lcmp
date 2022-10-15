<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'telepon',
        'pekerjaan',
        'tempat_lahir',
        'tanggal_lahir',
        'image',
    ];
}

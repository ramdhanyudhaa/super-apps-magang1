<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $table = 'kehadirans'; // Pastikan tabel sesuai

    protected $fillable = [
        'user_id', 'shift', 'date', 'check_in', 'check_out', 'location',
    ];
}

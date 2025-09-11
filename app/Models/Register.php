<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'short_uuid',
        'nama_lengkap',
        'nim',
        'semester',
        'nomor_hp',
        'email_pribadi',
        'email_mahasiswa',
        'divisi_utama',
        'divisi_tambahan',
        'cv',
        'portofolio',
        'bukti_follow_instagram',
        'bukti_follow_linkedin',
        'username_instagram',
    ];

    protected static function booted()
    {
        static::creating(function ($registration) {
        $registration->short_uuid = substr(str_replace('-', '', (string) Str::uuid()), 0, 8);   
    });
    }
}
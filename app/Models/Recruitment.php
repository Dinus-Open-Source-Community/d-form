<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
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

    protected $rules = [
        'nama_lengkap' => [
            'required',
            'string',
            'max:255',
            'regex:/^[a-zA-Z\s.]+$/'
        ],
        'nim' => [
            'required',
            'string',
            'max:50',
            'unique:recruitments,nim',
            'regex:/^[0-9]{7,12}$/'
        ],
        'semester' => [
            'required',
            'in:1,3'
        ],
        'nomor_hp' => [
            'required',
            'string',
            'max:20',
            'regex:/^\+?(62|0)[0-9]{9,13}$/'
        ],
        'email_pribadi' => [
            'nullable',
            'email',
            'max:255',
            'different:email_mahasiswa'
        ],
        'email_mahasiswa' => [
            'required',
            'email',
            'max:255',
            'regex:/^[a-zA-Z0-9._%+-]+@student\.dinus\.ac\.id$/'
        ],
        'divisi_utama' => [
            'required',
            'in:Pemrograman,Jaringan,Media_Creative,Data'
        ],
        'divisi_tambahan' => [
            'required',
            'in:Pemrograman,Jaringan,Media_Creative,Data',
            'different:divisi_utama'
        ],
        'cv' => [
            'required',
            'file',
            'mimes:pdf,doc,docx',
            'max:10240'
        ],
        'portofolio' => [
            'nullable',
            'file',
            'mimes:pdf,doc,docx,zip,rar',
            'max:10240'
        ],
        'bukti_follow_instagram' => [
            'required',
            'file',
            'mimes:jpg,jpeg,png,pdf',
            'max:10240'
        ],
        'bukti_follow_linkedin' => [
            'nullable',
            'file',
            'mimes:jpg,jpeg,png,pdf',
            'max:10240'
        ],
        'username_instagram' => [
            'required',
            'string',
            'max:255',
            'regex:/^[A-Za-z0-9._]+$/'
        ],
    ];
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recruitment;
use Illuminate\Support\Str;

class RecruitmentSeeder extends Seeder
{
    public function run(): void
    {
        Recruitment::create([
            'short_uuid' => Str::upper(Str::random(8)),
            'nama_lengkap' => 'Limar Jailani',
            'nim' => 'A11.2024.84937',
            'semester' => '3', // ✅ hanya '1' atau '3'
            'nomor_hp' => '081814681067',
            'email_pribadi' => 'fujiati.ulva@yahoo.com',
            'email_mahasiswa' => 'pusamah@student.dinus.ac.id',
            'divisi_utama' => 'Medcrev',
            'divisi_tambahan' => json_encode([]), // ✅ isi JSON kosong, bukan string kosong/null
            'cv' => 'recruitments/cv/c8f0a177-1a81-3f7e-9d5d-e748f6d51aa0.pdf',
            'portofolio' => null, // kolom ini boleh null
            'bukti_follow_instagram' => 'recruitments/instagram/b44c9fb7-8a06-3ddb-8c6e-0f3242e56241.jpg',
            'bukti_follow_linkedin' => 'recruitments/linkedin/2af42375-8b3a-395a-bc88-a30f23a2bbce.jpg',
            'username_instagram' => '@natsir.panca',
            'status' => 'rejected',
            'catatan' => 'Portfolio tidak sesuai dengan divisi yang dipilih',
            'reviewed_by' => 2,
            'reviewed_at' => now()->subDays(10),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registrat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255|regex:/^[a-zA-Z\s.]+$/',
            'nim' => 'required|string|max:50',
            'semester' => 'required|in:1,3',
            'nomor_hp' => 'required|string|max:20|regex:/^\+?[0-9]{7,15}$/',
            'email_pribadi' => 'required|email',
            'email_mahasiswa' => 'required|email',
            'divisi_utama' => 'required|in:Pemrograman,Jaringan,Medcrev,Data',
            'divisi_tambahan' => 'required|in:Pemrograman,Jaringan,Medcrev,Data|different:divisi_utama',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'portofolio' => 'nullable|file|mimes:pdf,doc,docx,zip,rar|max:10240',
            'bukti_follow_instagram' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'bukti_follow_linkedin' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'username_instagram' => 'required|string|max:255',
            
        ],[
        'nama_lengkap.regex' => 'Nama hanya boleh berisi huruf, spasi, dan titik.',
        'nim.unique' => 'NIM sudah terdaftar.',
        'divisi_tambahan.different' => 'Pilihan divisi kedua harus berbeda dengan divisi pertama.',
        'nomor_hp.regex' => 'Format nomor HP tidak valid.',
        'cv.mimes' => 'CV harus berupa file dengan format: pdf, doc, docx.',
    ]);
    


        // Handle file uploads
        $validated['cv'] = $request->file('cv')->store('cv');
        if ($request->hasFile('portofolio')) {
            $validated['portofolio'] = $request->file('portofolio')->store('portofolio');
        }
        $validated['bukti_follow_instagram'] = $request->file('bukti_follow_instagram')->store('follow_instagram');
        $validated['bukti_follow_linkedin'] = $request->file('bukti_follow_linkedin')->store('follow_linkedin');
        $validated = $request->validate([
            'nim' => 'required|string|unique:registrations,nim',
        ]);
        Registration::create($validated);

        return redirect()->back()->with('success', 'Registrasi berhasil!');
    }
}
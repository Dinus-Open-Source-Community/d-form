<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Recruitment;
use Illuminate\Support\Str;

class RecruitmentForm extends Component
{
    use WithFileUploads;

    public $nama_lengkap, $nim, $semester, $nomor_hp, $email_pribadi, $email_mahasiswa,
           $divisi_utama, $divisi_tambahan, $cv, $portofolio, $bukti_follow_instagram,
           $bukti_follow_linkedin, $username_instagram;

    
    public function upload()
    {
        $path = $this->cv->store('cv', 'public'); // simpan di storage/app/public/cv
        // simpan $path ke database jika perlu
        $path = $this->portofolio->store('portofolio', 'public'); // simpan di storage/app/public/portofolio
        $path = $this->bukti_follow_instagram->store('follow_instagram', 'public'); // simpan di storage/app/public/follow_instagram
        $path = $this->bukti_follow_linkedin->store('follow_linkedin', 'public'); // simpan di storage/app/public/follow_linkedin
        
    }
    

    protected $rules = [
        'nama_lengkap' => ['required','string','max:255','regex:/^[a-zA-Z\s.]+$/'],
        'nim' => ['required','string','max:50','unique:recruitments,nim','regex:/^[0-9]{7,12}$/'],
        'semester' => ['required','in:1,3'],
        'nomor_hp' => ['required','string','max:20','regex:/^\+?(62|0)[0-9]{9,13}$/'],
        'email_pribadi' => ['nullable','email','max:255','different:email_mahasiswa'],
        'email_mahasiswa' => ['required','email','max:255','regex:/^[a-zA-Z0-9._%+-]+@student\.dinus\.ac\.id$/'],
        'divisi_utama' => ['required','in:Pemrograman,Jaringan,Medcrev,Data'],
        'divisi_tambahan' => ['required','in:Pemrograman,Jaringan,Medcrev,Data','different:divisi_utama'],
        'cv' => ['required','file','mimes:pdf,doc,docx','max:10240'],
        'portofolio' => ['nullable','file','mimes:pdf,doc,docx,zip,rar','max:10240'],
        'bukti_follow_instagram' => ['required','file','mimes:jpg,jpeg,png,pdf','max:10240'],
        'bukti_follow_linkedin' => ['nullable','file','mimes:jpg,jpeg,png,pdf','max:10240'],
        'username_instagram' => ['required','string','max:255','regex:/^[A-Za-z0-9._]+$/'],
    ];

    public function submit()
    {
        $validated = $this->validate();

        // Generate unique 8-char short_uuid
        do {
            $validated['short_uuid'] = Str::upper(Str::random(8));
        } while (Recruitment::where('short_uuid', $validated['short_uuid'])->exists());

        $validated['cv'] = $this->cv->store('cv');
        if ($this->portofolio) {
            $validated['portofolio'] = $this->portofolio->store('portofolio');
        }
        $validated['bukti_follow_instagram'] = $this->bukti_follow_instagram->store('follow_instagram');
        $validated['bukti_follow_linkedin'] = $this->bukti_follow_linkedin->store('follow_linkedin');

        Recruitment::create($validated);

        session()->flash('success', 'Recruitment berhasil!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.client.recruitment-form');
    }
}
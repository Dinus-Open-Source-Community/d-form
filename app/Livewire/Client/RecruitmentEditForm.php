<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\Recruitment;
use Livewire\WithFileUploads;

class RecruitmentEditForm extends Component
{
    use WithFileUploads;

    public $recruitment;
    public $nama_lengkap, $nim, $semester, $nomor_hp, $email_pribadi, $email_mahasiswa,
           $divisi_utama, $divisi_tambahan, $cv, $portofolio, $bukti_follow_instagram,
           $bukti_follow_linkedin, $username_instagram;

    public function mount($short_uuid)
    {
        $this->recruitment = Recruitment::where('short_uuid', $short_uuid)->first();
        if (!$this->recruitment) {
            session()->flash('error', 'Kode edit tidak ditemukan atau sudah tidak berlaku.');
            return redirect()->route('client.recruitment-form'); 
        }
        foreach ([
            'nama_lengkap', 'nim', 'semester', 'nomor_hp', 'email_pribadi', 'email_mahasiswa',
            'divisi_utama', 'divisi_tambahan', 'username_instagram', 'cv', 'portofolio', 'bukti_follow_instagram',
            'bukti_follow_linkedin'
        ] as $f) {
            $this->$f = $this->recruitment->$f;
        }
    }

    protected function rules()
    {
        return [
            'nama_lengkap' => ['required','string','max:255','regex:/^[a-zA-Z\s.]+$/'],
            'nim' => ['required','string','max:50','regex:/^[0-9]{7,12}$/','unique:recruitments,nim,'.$this->recruitment->id],
            'semester' => ['required','in:1,3'],
            'nomor_hp' => ['required','string','max:20','regex:/^\+?(62|0)[0-9]{9,13}$/'],
            'email_pribadi' => ['nullable','email','max:255','different:email_mahasiswa'],
            'email_mahasiswa' => [
                'required','email','max:255',
                'regex:/^[a-zA-Z0-9._%+-]+@student\.dinus\.ac\.id$/',
                'unique:recruitments,email_mahasiswa,'.$this->recruitment->id
            ],
            'divisi_utama' => ['required','in:Pemrograman,Jaringan,Medcrev,Data'],
            'divisi_tambahan' => ['required','in:Pemrograman,Jaringan,Medcrev,Data','different:divisi_utama'],
            'username_instagram' => ['required','string','max:255','regex:/^[A-Za-z0-9._]+$/'],
            'cv' => ['nullable','file','mimes:pdf,doc,docx','max:10240'],
            'portofolio' => ['nullable','file','mimes:pdf,doc,docx,zip,rar','max:10240'],
            'bukti_follow_instagram' => ['required','file','mimes:jpg,jpeg,png,pdf','max:10240'],
            'bukti_follow_linkedin' => ['nullable','file','mimes:jpg,jpeg,png,pdf','max:10240'],
        ];
    }

    public function update()
    {
        $validated = $this->validate();


        unset($validated['nim']);


        $fileFields = [
            'cv' => 'cv',
            'portofolio' => 'portofolio',
            'bukti_follow_instagram' => 'follow_instagram',
            'bukti_follow_linkedin' => 'follow_linkedin',
        ];

        
        foreach ($fileFields as $field => $folder) {
            if ($this->$field) {
                $validated[$field] = $this->$field->store($folder);
            } else {
                $validated[$field] = $this->recruitment->$field;
            }
        }

        $this->recruitment->update($validated);

        session()->flash('success', 'Data recruitment berhasil diupdate!');
    }

    public function render()
    {
        return view('livewire.client.recruitment-edit-form');
    }
}
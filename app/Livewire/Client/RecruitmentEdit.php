<?php

namespace App\Livewire\Client;

use App\Models\Recruitment;
use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Mail;
use App\Mail\RecruitmentVerificationMail;

class RecruitmentEdit extends Component
{
    use WithFileUploads;

    public $short_uuid, $recruitment, $input_short_uuid, $short_uuid_error, $nama_lengkap, $nim, $semester, $nomor_hp, $email_pribadi, $email_mahasiswa,
    $divisi_utama, $divisi_tambahan, $cv, $portofolio, $bukti_follow_instagram,
    $bukti_follow_linkedin, $username_instagram;

    public function mount($short_uuid)
    {
        $this->short_uuid = $short_uuid;
        $this->recruitment = Recruitment::where('short_uuid', $short_uuid)->firstOrFail();

        if (!$this->recruitment) {
            session()->flash('error', 'Kode edit tidak ditemukan atau sudah tidak berlaku.');
            return redirect()->route('client.recruitment-form');
        }
        foreach ([
            'nama_lengkap',
            'nim',
            'semester',
            'nomor_hp',
            'email_pribadi',
            'email_mahasiswa',
            'divisi_utama',
            'divisi_tambahan',
            'username_instagram',
            'cv',
            'portofolio',
            'bukti_follow_instagram',
            'bukti_follow_linkedin'
        ] as $f) {
            $this->$f = $this->recruitment->$f;
        }
    }

    public function checkShortUuid()
    {
        $this->short_uuid_error = '';
        $uuid = trim($this->input_short_uuid);

        if (!$uuid) {
            $this->short_uuid_error = 'Kode edit harus diisi.';
            return;
        }

        $exists = Recruitment::where('short_uuid', $uuid)->exists();

        if ($exists) {
            // Ganti route sesuai kebutuhan, misal: route('recruitment.edit', $uuid)
            return redirect()->route('recruitment.edit', ['short_uuid' => $uuid]);
        } else {
            $this->short_uuid_error = 'Kode edit tidak ditemukan.';
        }
    }

    protected $messages = [
        'nama_lengkap.required' => 'Nama lengkap harus diisi.',
        'nama_lengkap.string' => 'Nama lengkap harus berupa teks.',
        'nama_lengkap.max' => 'Nama lengkap maksimal 255 karakter.',
        'nama_lengkap.regex' => 'Nama lengkap hanya boleh mengandung huruf, spasi, dan titik.',
        'nim.required' => 'NIM harus diisi.',
        'nim.string' => 'NIM harus berupa teks.',
        'nim.max' => 'NIM maksimal 50 karakter.',
        'nim.unique' => 'NIM sudah terdaftar.',
        'nim.regex' => 'Format NIM tidak valid. Contoh format: ABC.2021.12345',
        'semester.required' => 'Semester harus dipilih.',
        'semester.in' => 'Semester yang dipilih tidak valid.',
        'nomor_hp.required' => 'Nomor HP harus diisi.',
        'nomor_hp.string' => 'Nomor HP harus berupa teks.',
        'nomor_hp.max' => 'Nomor HP maksimal 20 karakter.',
        'nomor_hp.regex' => 'Format Nomor HP tidak valid. Contoh format: +6281234567890 atau 081234567890',
        'email_pribadi.email' => 'Email pribadi tidak valid.',
        'email_pribadi.max' => 'Email pribadi maksimal 255 karakter.',
        'email_pribadi.different' => 'Email pribadi tidak boleh sama dengan email mahasiswa.',
        'email_mahasiswa.required' => 'Email mahasiswa harus diisi.',
        'email_mahasiswa.email' => 'Email mahasiswa tidak valid.',
        'email_mahasiswa.max' => 'Email mahasiswa maksimal 255 karakter.',
        'email_mahasiswa.regex' => 'Email mahasiswa harus berakhiran @student.dinus.ac.id',
        'email_mahasiswa.unique' => 'Email mahasiswa sudah terdaftar.',
        'divisi_utama.required' => 'Divisi utama harus dipilih.',
        'divisi_utama.in' => 'Divisi utama yang dipilih tidak valid.',
        'divisi_tambahan.required' => 'Divisi tambahan harus dipilih.',
        'divisi_tambahan.in' => 'Divisi tambahan yang dipilih tidak valid.',
        'divisi_tambahan.different' => 'Divisi tambahan tidak boleh sama dengan divisi utama.',
        'username_instagram.required' => 'Username Instagram harus diisi.',
        'username_instagram.string' => 'Username Instagram harus berupa teks.',
        'username_instagram.max' => 'Username Instagram maksimal 255 karakter.',
        'username_instagram.regex' => 'Username Instagram hanya boleh mengandung huruf, angka, titik, dan garis bawah.',
        'cv.file' => 'CV harus berupa file.',
        'cv.mimes' => 'CV harus berformat PDF, DOC, atau DOCX.',
        'cv.max' => 'Ukuran CV maksimal 10MB.',
        'portofolio.file' => 'Portofolio harus berupa file.',
        'portofolio.mimes' => 'Portofolio harus berformat PDF, DOC, DOCX, ZIP, atau RAR.',
        'portofolio.max' => 'Ukuran Portofolio maksimal 10MB.',
        'bukti_follow_instagram.required' => 'Bukti follow Instagram harus diunggah.',
        'bukti_follow_instagram.file' => 'Bukti follow Instagram harus berupa file.',
        'bukti_follow_instagram.mimes' => 'Bukti follow Instagram harus berformat JPG, JPEG, PNG, atau PDF.',
        'bukti_follow_instagram.max' => 'Ukuran bukti follow Instagram maksimal 10MB.',
        'bukti_follow_linkedin.file' => 'Bukti follow LinkedIn harus berupa file.',
        'bukti_follow_linkedin.mimes' => 'Bukti follow LinkedIn harus berformat JPG, JPEG, PNG, atau PDF.',
        'bukti_follow_linkedin.max' => 'Ukuran bukti follow LinkedIn maksimal 10MB.',
    ];

    protected function rules()
    {
        return [
            'nama_lengkap' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s.]+$/'],
            'nim' => ['required', 'string', 'max:50', 'unique:recruitments,nim,' . $this->recruitment->id, 'regex:/^[A-Za-z0-9]{3}\.\d{4}\.\d{5}$/'],
            'semester' => ['required', 'in:1,3'],
            'nomor_hp' => ['required', 'string', 'max:20', 'regex:/^\+?(62|0)[0-9]{9,13}$/'],
            'email_pribadi' => ['nullable', 'email', 'max:255', 'different:email_mahasiswa'],
            'email_mahasiswa' => [
                'required',
                'email',
                'max:255',
                'regex:/^[a-zA-Z0-9._%+-]+@mhs\.dinus\.ac\.id$/',
                'unique:recruitments,email_mahasiswa,' . $this->recruitment->id
            ],
            'divisi_utama' => ['required', 'in:Pemrograman,Jaringan,Medcrev,Data'],
            'divisi_tambahan' => ['required', 'in:Pemrograman,Jaringan,Medcrev,Data', 'different:divisi_utama'],
            'username_instagram' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z0-9._]+$/'],
            'cv' => [is_object($this->cv) ? 'file' : 'nullable', is_object($this->cv) ? 'mimes:pdf,doc,docx' : 'nullable', 'max:10240'],
            'portofolio' => [is_object($this->portofolio) ? 'file' : 'nullable', is_object($this->portofolio) ? 'mimes:pdf,doc,docx,zip,rar' : 'nullable', 'max:10240'],
            'bukti_follow_instagram' => [is_object($this->bukti_follow_instagram) ? 'file' : 'nullable', is_object($this->bukti_follow_instagram) ? 'mimes:jpg,jpeg,png,pdf' : 'nullable', 'max:10240'],
            'bukti_follow_linkedin' => [is_object($this->bukti_follow_linkedin) ? 'file' : 'nullable', is_object($this->bukti_follow_linkedin) ? 'mimes:jpg,jpeg,png,pdf' : 'nullable', 'max:10240'],
        ];
    }

    // public function testSendEmail()
    // {
    //     // Kirim email ke email mahasiswa yang sedang diedit
    //     Mail::to($this->email_mahasiswa)->send(
    //         new RecruitmentVerificationMail(
    //             $this->nama_lengkap,
    //             $this->nim,
    //             $this->short_uuid
    //         )
    //     );
    //     $this->dispatchBrowserEvent('notify', [
    //         'type' => 'success',
    //         'message' => 'Email test berhasil dikirim ke ' . $this->email_mahasiswa . '!'
    //     ]);
    // }

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
            if ($this->$field && is_object($this->$field)) {
                // Simpan file baru dengan nama asli + timestamp agar unik
                $validated[$field] = $this->$field->storeAs($folder, time() . '_' . $this->$field->getClientOriginalName(), 'public');
            } else {
                // Pakai file lama jika tidak upload baru
                $validated[$field] = $this->recruitment->$field;
            }
        }

        $this->recruitment->update($validated);

        sleep(1); // delay 1 detik

        session()->flash('success', 'Data recruitment berhasil diupdate!');
    }

    public function render()
    {
        return view('livewire.client.recruitment-edit');
    }
}

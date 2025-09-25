<?php

namespace App\Livewire\Client;

use App\Mail\RecruitmentVerificationMail;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Recruitment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class RecruitmentForm extends Component
{
    use WithFileUploads;

    public $nama_lengkap, $nim, $semester, $nomor_hp, $email_pribadi, $email_mahasiswa,
    $divisi_utama, $divisi_tambahan = null,
    $cv, $portofolio, $bukti_follow_instagram,
    $bukti_follow_linkedin, $username_instagram, $input_short_uuid, $short_uuid_error;

    protected $messages = [
        'nama_lengkap.required' => 'Nama lengkap wajib diisi',
        'nama_lengkap.regex' => 'Nama lengkap hanya boleh berisi huruf, spasi, dan titik',
        'nim.required' => 'NIM wajib diisi',
        'nim.unique' => 'NIM sudah terdaftar',
        'nim.regex' => 'Format NIM tidak valid. Contoh: A11.2020.12345',
        'semester.required' => 'Semester wajib dipilih',
        'semester.in' => 'Semester yang dipilih tidak valid',
        'nomor_hp.required' => 'Nomor HP wajib diisi',
        'nomor_hp.regex' => 'Format nomor HP tidak valid. Contoh: +6281234567890 atau 081234567890',
        'email_pribadi.email' => 'Format email pribadi tidak valid',
        'email_pribadi.different' => 'Email pribadi tidak boleh sama dengan email mahasiswa',
        'email_mahasiswa.required' => 'Email mahasiswa wajib diisi',
        'email_mahasiswa.email' => 'Format email mahasiswa tidak valid',
        'email_mahasiswa.unique' => 'Email mahasiswa sudah terdaftar',
        'email_mahasiswa.regex' => 'Email mahasiswa harus berakhiran @mhs.dinus.ac.id',
        'divisi_utama.required' => 'Divisi utama wajib dipilih',
        'divisi_utama.in' => 'Divisi utama yang dipilih tidak valid',
        'divisi_tambahan.in' => 'Divisi tambahan yang dipilih tidak valid.',
        'divisi_tambahan.different' => 'Divisi tambahan tidak boleh sama dengan divisi utama.',
        'cv.required' => 'CV wajib diunggah',
        'cv.file' => 'CV harus berupa file',
        'cv.mimes' => 'CV harus berformat pdf, doc, atau docx',
        'cv.max' => 'Ukuran CV maksimal 10MB',
        'portofolio.file' => 'Portofolio harus berupa file',
        'portofolio.mimes' => 'Portofolio harus berformat pdf, doc, docx, zip, atau rar',
        'portofolio.max' => 'Ukuran portofolio maksimal 10MB',
        'bukti_follow_instagram.required' => 'Bukti follow Instagram wajib diunggah',
        'bukti_follow_instagram.file' => 'Bukti follow Instagram harus berupa file',
        'bukti_follow_instagram.mimes' => 'Bukti follow Instagram harus berformat jpg, jpeg, png, atau pdf',
        'bukti_follow_instagram.max' => 'Ukuran bukti follow Instagram maksimal 10MB',
        'bukti_follow_linkedin.file' => 'Bukti follow LinkedIn harus berupa file',
        'bukti_follow_linkedin.mimes' => 'Bukti follow LinkedIn harus berformat jpg, jpeg, png, atau pdf',
        'bukti_follow_linkedin.max' => 'Ukuran bukti follow LinkedIn maksimal 10MB',
        'username_instagram.required' => 'Username Instagram wajib diisi',
        'username_instagram.regex' => 'Username Instagram hanya boleh berisi huruf, angka, titik, dan underscore',
    ];

    protected $rules = [
        'nama_lengkap' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s.]+$/'],
        'nim' => ['required', 'string', 'max:50', 'unique:recruitments,nim', 'regex:/^[A-Za-z0-9]{3}\.\d{4}\.\d{5}$/'],
        'semester' => ['required', 'in:1,3'],
        'nomor_hp' => ['required', 'string', 'max:20', 'regex:/^\+?(62|0)[0-9]{9,13}$/'],
        'email_pribadi' => ['nullable', 'email', 'max:255', 'different:email_mahasiswa'],
        'email_mahasiswa' => ['required', 'email', 'max:255', 'unique:recruitments,email_mahasiswa', 'regex:/^[a-zA-Z0-9._%+-]+@mhs\.dinus\.ac\.id$/'],
        'divisi_utama' => ['required', 'in:Pemrograman,Jaringan,Medcrev,Data'],
        'divisi_tambahan' => ['nullable', 'in:Pemrograman,Jaringan,Medcrev,Data', 'different:divisi_utama'],
        'cv' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
        'portofolio' => ['nullable', 'file', 'mimes:pdf,doc,docx,zip,rar', 'max:10240'],
        'bukti_follow_instagram' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],
        'bukti_follow_linkedin' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],
        'username_instagram' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z0-9._]+$/'],
    ];

public function submit()
{
    $validated = $this->validate();

    // Tangani divisi_tambahan: pastikan berupa array atau null
    if (!$this->divisi_tambahan || $this->divisi_tambahan === 'null') {
        $divisiTambahan = null;
    } else {
        // Bisa single string atau array
        $divisiTambahan = is_array($this->divisi_tambahan) 
            ? $this->divisi_tambahan 
            : [$this->divisi_tambahan];

        // Validasi isi array sesuai allowed list
        $allowedDivisi = ['Pemrograman', 'Jaringan', 'Medcrev', 'Data'];
        $divisiTambahan = array_values(array_intersect($divisiTambahan, $allowedDivisi));

        if (empty($divisiTambahan)) {
            $divisiTambahan = null;
        }
    }

    // Generate unique 8-char short_uuid
    do {
        $short_uuid = Str::upper(Str::random(8));
    } while (Recruitment::where('short_uuid', $short_uuid)->exists());

    // Upload file
    $cvPath = $this->cv->storeAs('cv', time().'_'.$this->cv->getClientOriginalName(), 'public');
    $portofolioPath = $this->portofolio ? $this->portofolio->storeAs('portofolio', time().'_'.$this->portofolio->getClientOriginalName(), 'public') : null;
    $buktiInstagramPath = $this->bukti_follow_instagram->storeAs('follow_instagram', time().'_'.$this->bukti_follow_instagram->getClientOriginalName(), 'public');
    $buktiLinkedinPath = $this->bukti_follow_linkedin ? $this->bukti_follow_linkedin->storeAs('follow_linkedin', time().'_'.$this->bukti_follow_linkedin->getClientOriginalName(), 'public') : null;

    // Simpan ke database
    $recruitment = Recruitment::create([
        'nama_lengkap' => $this->nama_lengkap,
        'nim' => $this->nim,
        'semester' => $this->semester,
        'nomor_hp' => $this->nomor_hp,
        'email_pribadi' => $this->email_pribadi,
        'email_mahasiswa' => $this->email_mahasiswa,
        'divisi_utama' => $this->divisi_utama,
        'divisi_tambahan' => $divisiTambahan ? json_encode($divisiTambahan) : null,
        'cv' => $cvPath,
        'portofolio' => $portofolioPath,
        'bukti_follow_instagram' => $buktiInstagramPath,
        'bukti_follow_linkedin' => $buktiLinkedinPath,
        'username_instagram' => $this->username_instagram,
        'short_uuid' => $short_uuid,
    ]);

    // Kirim email
    // $emailTo = $this->email_mahasiswa ?: $this->email_pribadi;
    // Mail::to($emailTo)->send(new RecruitmentVerificationMail(
    //     $this->nama_lengkap,
    //     $this->nim,
    //     $short_uuid
    // ));

    session()->flash('success', 'Pendaftaran berhasil! Kode edit telah dikirim ke email Anda.');
    $this->reset();
    return redirect()->route('client.home');
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
            return redirect()->route('client.recruitment.edit', ['short_uuid' => $uuid]);
        } else {
            $this->short_uuid_error = 'Kode edit tidak ditemukan.';
        }
    }

    public function render()
    {
        return view('livewire.client.recruitment-form');
}
}
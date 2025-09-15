<?php

namespace App\Livewire\Client;

use App\Mail\RecruitmentVerificationMail;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Recruitment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class RecruitmentForm extends Component
{
    use WithFileUploads;

    public $nama_lengkap, $nim, $semester, $nomor_hp, $email_pribadi, $email_mahasiswa,
    $divisi_utama, $divisi_tambahan = '', $cv, $portofolio, $bukti_follow_instagram,
    $bukti_follow_linkedin, $username_instagram, $input_short_uuid, $short_uuid_error;


    public function upload()
    {

        $path = $this->cv->store('cv', 'public'); // simpan di storage/app/public/cv
        // simpan $path ke database jika perlu
        $path = $this->portofolio->store('portofolio', 'public'); // simpan di storage/app/public/portofolio
        $path = $this->bukti_follow_instagram->store('follow_instagram', 'public'); // simpan di storage/app/public/follow_instagram
        $path = $this->bukti_follow_linkedin->store('follow_linkedin', 'public'); // simpan di storage/app/public/follow_linkedin

    }

    protected $messages = [
        'nama_lengkap.required' => 'Nama lengkap wajib diisi',
        'nama_lengkap.regex' => 'Nama lengkap hanya boleh berisi huruf, spasi, dan titik',
        'nim.required' => 'NIM wajib diisi',
        'nim.unique' => 'NIM sudah terdaftar',
        'nim.regex' => 'NIM harus berupa angka dengan panjang 7-12 digit',
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
        'divisi_tambahan' => ['nullable', 'string', 'in:Pemrograman,Jaringan,Medcrev,Data', 'different:divisi_utama'],
        'cv' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
        'portofolio' => ['nullable', 'file', 'mimes:pdf,doc,docx,zip,rar', 'max:10240'],
        'bukti_follow_instagram' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],
        'bukti_follow_linkedin' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],
        'username_instagram' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z0-9._]+$/'],
    ];

    public function submit()
    {
        $validated = $this->validate();

        // Generate unique 8-char short_uuid
        do {
            $validated['short_uuid'] = Str::upper(Str::random(8));
        } while (Recruitment::where('short_uuid', $validated['short_uuid'])->exists());

        $cvName = time() . '_' . $this->cv->getClientOriginalName();
        $validated['cv'] = $this->cv->storeAs('cv', $cvName, 'public');

        if ($this->portofolio) {
            $portofolioName = time() . '_' . $this->portofolio->getClientOriginalName();
            $validated['portofolio'] = $this->portofolio->storeAs('portofolio', $portofolioName, 'public');
        }
        $buktiFollowInstagramName = time() . '_' . $this->bukti_follow_instagram->getClientOriginalName();
        $validated['bukti_follow_instagram'] = $this->bukti_follow_instagram->storeAs('follow_instagram', $buktiFollowInstagramName, 'public');
        $buktiFollowLinkedinName = $this->bukti_follow_linkedin ? time() . '_' . $this->bukti_follow_linkedin->getClientOriginalName() : null;
        $validated['bukti_follow_linkedin'] = $this->bukti_follow_linkedin ? $this->bukti_follow_linkedin->storeAs('follow_linkedin', $buktiFollowLinkedinName, 'public') : null;

        Recruitment::create($validated);

        // Kirim email kode ke email pribadi (atau email mahasiswa jika email_pribadi null)
        $emailTo = $validated['email_mahasiswa'] ?: $validated['email_pribadi'];
        Mail::to($emailTo)->send(
            new RecruitmentVerificationMail(
                $validated['nama_lengkap'],
                $validated['nim'],
                $validated['short_uuid']
            )
        );

        session()->flash('short_uuid', $validated['short_uuid']);
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
            // Ganti route sesuai kebutuhan, misal: route('recruitment.edit', $uuid)
            return redirect()->route('client.recruitment.edit', ['short_uuid' => $uuid]);
        } else {
            $this->short_uuid_error = 'Kode edit tidak ditemukan.';
        }
    }



    public function render()
    {
        return view('livewire.client.recruitment-form');
    }
}// simpan di storage/app/public/follow_linkedin
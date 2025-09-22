<?php

namespace App\Livewire\Admin;

use App\Mail\GroupInvite;
use Livewire\Component;
use App\Models\Recruitment;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Mail;


class RecruitmentConvert extends Component
{
    use WithPagination;

    #[Layout('components.layouts.admin')]

    public function sendGroupInvite($recruitmentId)
    {
        $recruitment = Recruitment::findOrFail($recruitmentId);

        try {
            Mail::to($recruitment->email_mahasiswa)->send(
                new GroupInvite($recruitment->nama_lengkap)
            );

            session()->flash('success', 'Undangan grup berhasil dikirim ke ' . $recruitment->email_mahasiswa);
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }

    public function exportCsv()
    {
        $fileName = 'recruitments.csv';
        $recruitments = Recruitment::all();

        // Ambil semua kolom tabel 'recruitments'
        $fields = Schema::getColumnListing((new Recruitment)->getTable());

        return response()->streamDownload(function () use ($recruitments, $fields) {
            $handle = fopen('php://output', 'w');
            // Header
            fputcsv($handle, $fields);
            // Data
            foreach ($recruitments as $row) {
                $data = [];
                foreach ($fields as $field) {
                    $data[] = $row->$field;
                }
                fputcsv($handle, $data);
            }
            fclose($handle);
        }, $fileName, ['Content-Type' => 'text/csv']);
    }

    public function render()
    {
        return view('livewire.admin.recruitment-convert', [
            // GUNAKAN model Recruitment, BUKAN RecruitmentConvert
            'recruitments' => Recruitment::orderBy('created_at', 'desc')->paginate(20)
        ]);
    }
}
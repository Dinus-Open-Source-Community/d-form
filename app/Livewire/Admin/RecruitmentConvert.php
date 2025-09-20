<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Recruitment;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class RecruitmentConvert extends Component
{
    use WithPagination;

    public function exportCsv()
    {
        $fileName = 'recruitments_' . now()->format('Y_m_d_H_i_s') . '.csv';
        $recruitments = Recruitment::all();

        // Ambil semua kolom tabel 'recruitments'
        $fields = Schema::getColumnListing((new Recruitment)->getTable());

        // Field yang berupa file agar bisa diubah menjadi URL publik
        $fileFields = ['cv', 'portofolio', 'bukti_follow_instagram', 'bukti_follow_linkedin'];

        return response()->streamDownload(function () use ($recruitments, $fields, $fileFields) {
            $handle = fopen('php://output', 'w');

            // Header CSV
            fputcsv($handle, $fields);

            foreach ($recruitments as $row) {
                $data = [];
                foreach ($fields as $field) {
                    $value = $row->$field;

                    // Jika array, ubah jadi string
                    if (is_array($value)) {
                        $value = implode(', ', $value);
                    }

                    // Jika field file, buat URL publik
                    if (in_array($field, $fileFields) && $value) {
                        if (Storage::disk('public')->exists($value)) {
                            $value = asset('storage/' . $value);
                        } else {
                            $value = ''; // file tidak ada
                        }
                    }

                    $data[] = $value;
                }

                fputcsv($handle, $data);
            }

            fclose($handle);
        }, $fileName, ['Content-Type' => 'text/csv']);
    }

    public function render()
    {
        return view('livewire.admin.recruitment-convert', [
            'recruitments' => Recruitment::orderBy('created_at', 'desc')->paginate(20)
        ]);
    }
}

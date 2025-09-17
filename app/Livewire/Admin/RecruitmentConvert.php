<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Recruitment;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Schema;

class RecruitmentConvert extends Component
{
    use WithPagination;

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
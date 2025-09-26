<?php

namespace App\Livewire\Admin;

use App\Models\Recruitment;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RecruitmentExport;
use Carbon\Carbon;

class RecruitmentConvert extends Component
{
    use WithPagination;

    public string $selectedStatus = 'all';
    public string $selectedDivision = 'all';
    public int $perPage = 10;

    // Export properties
    public bool $showExportModal = false;
    public string $exportType = 'all';
    public string $exportFormat = 'csv';

    public function mount()
    {
        abort_unless(auth()->check(), 403);
    }

    public function updatedSelectedStatus()
    {
        $this->resetPage();
    }

    public function updatedSelectedDivision()
    {
        $this->resetPage();
    }

    public function getRecruitments()
    {
        $query = Recruitment::query();

        if ($this->selectedStatus !== 'all') {
            $query->where('status', $this->selectedStatus);
        }

        if ($this->selectedDivision !== 'all') {
            $query->where(function ($q) {
                $q->where('divisi_utama', $this->selectedDivision)
                  ->orWhere('divisi_tambahan', $this->selectedDivision);
            });
        }

        return $query->orderBy('created_at', 'desc')->paginate($this->perPage);
    }

    public function getStatistics()
    {
        $query = Recruitment::query();

        if ($this->selectedDivision !== 'all') {
            $query->where(function ($q) {
                $q->where('divisi_utama', $this->selectedDivision)
                  ->orWhere('divisi_tambahan', $this->selectedDivision);
            });
        }

        return [
            'total' => $query->count(),
            'approved' => $query->clone()->where('status', 'approved')->count(),
            'rejected' => $query->clone()->where('status', 'rejected')->count(),
            'pending' => $query->clone()->where('status', 'pending')->count(),
        ];
    }

    // Export methods
    public function showExportModal()
    {
        $this->showExportModal = true;
    }

    public function closeExportModal()
    {
        $this->showExportModal = false;
        $this->exportType = 'all';
        $this->exportFormat = 'csv';
    }

    public function exportCsv()
    {
        return $this->performExport('csv');
    }

    public function exportExcel()
    {
        return $this->performExport('xlsx');
    }

    public function exportFiltered()
    {
        return $this->performExport($this->exportFormat);
    }

    private function performExport($format)
    {
        $filters = [
            'status' => $this->selectedStatus,
            'division' => $this->selectedDivision,
        ];

        $exportType = match($this->selectedStatus) {
            'approved' => 'approved',
            'rejected' => 'rejected', 
            'pending' => 'pending',
            default => 'all'
        };

        $filename = $this->generateFilename($exportType, $format);

        if ($format === 'csv') {
            return $this->exportToCSV($filters, $filename);
        } else {
            $export = new RecruitmentExport($filters, $exportType);
            return Excel::download($export, $filename);
        }
    }

    private function exportToCSV($filters, $filename)
    {
        $query = Recruitment::query()->with('reviewer');

        if ($filters['status'] !== 'all') {
            $query->where('status', $filters['status']);
        }

        if ($filters['division'] !== 'all') {
            $query->where(function ($q) use ($filters) {
                $q->where('divisi_utama', $filters['division'])
                  ->orWhere('divisi_tambahan', $filters['division']);
            });
        }

        $recruitments = $query->orderBy('created_at', 'desc')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($recruitments) {
            $file = fopen('php://output', 'w');
            
            // Write BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Write headers
            fputcsv($file, [
                'ID', 'Short UUID', 'Nama Lengkap', 'NIM', 'Semester', 'Nomor HP',
                'Email Pribadi', 'Email Mahasiswa', 'Divisi Utama', 'Divisi Tambahan',
                'Username Instagram', 'Portfolio', 'Status', 'Catatan Review',
                'Reviewer', 'Tanggal Review', 'Tanggal Daftar'
            ]);

            // Write data
            foreach ($recruitments as $recruitment) {
                fputcsv($file, [
                    $recruitment->id,
                    $recruitment->short_uuid,
                    $recruitment->nama_lengkap,
                    $recruitment->nim,
                    $recruitment->semester,
                    $recruitment->nomor_hp,
                    $recruitment->email_pribadi,
                    $recruitment->email_mahasiswa,
                    $recruitment->divisi_utama,
                    $recruitment->divisi_tambahan ?? '-',
                    $recruitment->username_instagram,
                    $recruitment->portofolio ?? '-',
                    $this->getStatusLabel($recruitment->status),
                    $recruitment->catatan ?? '-',
                    $recruitment->reviewer?->name ?? '-',
                    $recruitment->reviewed_at?->format('d/m/Y H:i') ?? '-',
                    $recruitment->created_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function generateFilename($exportType, $format): string
    {
        $date = Carbon::now()->format('Y_m_d_His');
        $statusLabel = match($exportType) {
            'approved' => 'Diterima',
            'rejected' => 'Ditolak',
            'pending' => 'Menunggu',
            default => 'All'
        };
        
        $divisionLabel = $this->selectedDivision !== 'all' ? '_' . str_replace(' ', '', $this->selectedDivision) : '';
        
        return "recruitment_{$statusLabel}{$divisionLabel}_{$date}.{$format}";
    }

    private function getStatusLabel($status): string
    {
        return match($status) {
            'approved' => 'DITERIMA',
            'rejected' => 'DITOLAK',
            'pending' => 'MENUNGGU REVIEW',
            default => strtoupper($status)
        };
    }

    public function render()
    {
        return view('livewire.admin.recruitment-convert', [
            'recruitments' => $this->getRecruitments(),
            'statistics' => $this->getStatistics(),
            'divisions' => Recruitment::getDivisions(),
        ]);
    }
}
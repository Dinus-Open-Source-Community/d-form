<?php

namespace App\Livewire\Admin;

use App\Http\Controllers\Controller;
use App\Exports\RecruitmentExport;
use App\Models\Recruitment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class RecruitmentExportController extends Controller
{
    public function __invoke(Request $request)
    {
        abort_unless(auth()->user()->can('recruitment.export'), 403);

        $filters = $this->getFilters($request);
        $exportType = $request->get('export_type', 'all');
        $format = $request->get('format', 'xlsx');
        
        $filename = $this->generateFilename($exportType, $format);

        // Generate export based on format
        switch ($format) {
            case 'xlsx':
            case 'xls':
                return $this->exportExcel($filters, $exportType, $format, $filename);
                
            case 'csv':
                return $this->exportCSV($filters, $exportType, $filename);
                
            case 'pdf':
                return $this->exportPDF($filters, $exportType, $filename);
                
            default:
                abort(400, 'Invalid export format');
        }
    }

    private function getFilters(Request $request): array
    {
        return [
            'search' => $request->get('search'),
            'status' => $request->get('status', 'all'),
            'division' => $request->get('division', 'all'),
            'semester' => $request->get('semester', 'all'),
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
        ];
    }

    private function generateFilename($exportType, $format): string
    {
        $date = Carbon::now()->format('Y_m_d_His');
        $typeLabel = match($exportType) {
            'approved' => 'Diterima',
            'pending' => 'Menunggu',
            'rejected' => 'Ditolak',
            'by_status' => 'PerStatus',
            'by_division' => 'PerDivisi',
            'summary' => 'Summary',
            default => 'All'
        };
        
        return "recruitment_{$typeLabel}_{$date}.{$format}";
    }

    private function exportExcel($filters, $exportType, $format, $filename)
    {
        $export = new RecruitmentExport($filters, $exportType);
        
        return Excel::download($export, $filename, 
            $format === 'xlsx' ? \Maatwebsite\Excel\Excel::XLSX : \Maatwebsite\Excel\Excel::XLS
        );
    }

    private function exportCSV($filters, $exportType, $filename)
    {
        // For CSV, we'll export single sheet only
        $query = $this->buildQuery($filters);
        $recruitments = $query->with('reviewer')->get();
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($recruitments) {
            $file = fopen('php://output', 'w');
            
            // Write headers
            fputcsv($file, [
                'No', 'Tanggal Daftar', 'Short UUID', 'Nama Lengkap', 'NIM', 'Semester',
                'No HP', 'Email Pribadi', 'Email Mahasiswa', 'Divisi Utama', 'Divisi Tambahan',
                'Username Instagram', 'Portfolio', 'Status', 'Catatan', 'Reviewer', 'Tanggal Review'
            ]);

            // Write data
            $no = 1;
            foreach ($recruitments as $recruitment) {
                fputcsv($file, [
                    $no++,
                    $recruitment->created_at->format('d/m/Y H:i'),
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
                    $recruitment->reviewed_at?->format('d/m/Y H:i') ?? '-'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportPDF($filters, $exportType, $filename)
    {
        $query = $this->buildQuery($filters);
        $recruitments = $query->with('reviewer')->get();
        $statistics = $this->getStatistics($filters);
        
        $pdf = Pdf::loadView('admin.recruitment.pdf-export', [
            'recruitments' => $recruitments,
            'statistics' => $statistics,
            'filters' => $filters,
            'exportType' => $exportType,
            'generatedAt' => Carbon::now(),
        ]);

        return $pdf->download($filename);
    }

    private function buildQuery($filters)
    {
        $query = Recruitment::query();

        if (!empty($filters['search'])) {
            $query->search($filters['search']);
        }

        if (!empty($filters['status']) && $filters['status'] !== 'all') {
            $query->byStatus($filters['status']);
        }

        if (!empty($filters['division']) && $filters['division'] !== 'all') {
            $query->byDivision($filters['division']);
        }

        if (!empty($filters['semester']) && $filters['semester'] !== 'all') {
            $query->bySemester((int)$filters['semester']);
        }

        if (!empty($filters['date_from']) && !empty($filters['date_to'])) {
            $query->inDateRange($filters['date_from'], $filters['date_to']);
        }

        return $query->orderBy('created_at', 'desc');
    }

    private function getStatistics($filters): array
    {
        $query = $this->buildQuery($filters);
        
        return [
            'total' => $query->count(),
            'approved' => $query->clone()->where('status', 'approved')->count(),
            'rejected' => $query->clone()->where('status', 'rejected')->count(),
            'pending' => $query->clone()->where('status', 'pending')->count(),
        ];
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
}
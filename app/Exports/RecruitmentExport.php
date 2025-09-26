<?php

namespace App\Exports;

use App\Models\Recruitment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;

class RecruitmentExport implements WithMultipleSheets
{
    protected $filters;
    protected $exportType;

    public function __construct($filters = [], $exportType = 'all')
    {
        $this->filters = $filters;
        $this->exportType = $exportType;
    }

    public function sheets(): array
    {
        $sheets = [];

        // Export berdasarkan type
        switch ($this->exportType) {
            case 'all':
                $sheets[] = new RecruitmentSheet($this->filters, 'all', 'All Recruitments');
                break;
                
            case 'by_status':
                // Buat sheet terpisah untuk setiap status
                $statuses = [
                    'approved' => 'Diterima',
                    'pending' => 'Menunggu Review', 
                    'rejected' => 'Ditolak'
                ];
                
                foreach ($statuses as $status => $title) {
                    $filterWithStatus = array_merge($this->filters, ['status' => $status]);
                    $sheets[] = new RecruitmentSheet($filterWithStatus, $status, $title);
                }
                break;
                
            case 'by_division':
                // Buat sheet terpisah untuk setiap divisi
                $divisions = Recruitment::getDivisions();
                
                foreach ($divisions as $division) {
                    $filterWithDivision = array_merge($this->filters, ['division' => $division]);
                    $sheets[] = new RecruitmentSheet($filterWithDivision, 'division', $division);
                }
                break;
                
            case 'summary':
                $sheets[] = new RecruitmentSummarySheet($this->filters);
                break;
                
            default:
                // Single status export
                $filterWithStatus = array_merge($this->filters, ['status' => $this->exportType]);
                $statusTitle = match($this->exportType) {
                    'approved' => 'Diterima',
                    'pending' => 'Menunggu Review',
                    'rejected' => 'Ditolak',
                    default => ucfirst($this->exportType)
                };
                $sheets[] = new RecruitmentSheet($filterWithStatus, $this->exportType, $statusTitle);
                break;
        }

        return $sheets;
    }
}

// =============================================================================
// 2. RECRUITMENT SHEET CLASS - Individual sheet handler
// =============================================================================

class RecruitmentSheet implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle, ShouldAutoSize
{
    protected $filters;
    protected $sheetType;
    protected $title;

    public function __construct($filters, $sheetType, $title)
    {
        $this->filters = $filters;
        $this->sheetType = $sheetType;
        $this->title = $title;
    }

    public function collection()
    {
        return $this->getFilteredRecruitments();
    }

    private function getFilteredRecruitments()
    {
        $query = Recruitment::query()->with('reviewer');

        // Apply filters
        if (!empty($this->filters['search'])) {
            $query->search($this->filters['search']);
        }

        if (!empty($this->filters['status']) && $this->filters['status'] !== 'all') {
            $query->byStatus($this->filters['status']);
        }

        if (!empty($this->filters['division']) && $this->filters['division'] !== 'all') {
            $query->byDivision($this->filters['division']);
        }

        if (!empty($this->filters['semester']) && $this->filters['semester'] !== 'all') {
            $query->bySemester((int)$this->filters['semester']);
        }

        // Date range filter
        if (!empty($this->filters['date_from']) && !empty($this->filters['date_to'])) {
            $query->inDateRange($this->filters['date_from'], $this->filters['date_to']);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal Daftar',
            'Short UUID',
            'Nama Lengkap',
            'NIM', 
            'Semester',
            'No HP',
            'Email Pribadi',
            'Email Mahasiswa',
            'Divisi Utama',
            'Divisi Tambahan',
            'Username Instagram',
            'Portfolio',
            'Status',
            'Catatan Review',
            'Reviewer',
            'Tanggal Review',
            'File CV',
            'File Instagram',
            'File LinkedIn'
        ];
    }

    public function map($recruitment): array
    {
        static $no = 1;
        
        // Check file status
        $fileStatus = $recruitment->file_status;
        
        return [
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
            $recruitment->reviewed_at?->format('d/m/Y H:i') ?? '-',
            $fileStatus['cv']['exists'] ? 'Tersedia' : 'Tidak Ada',
            $fileStatus['instagram']['exists'] ? 'Tersedia' : 'Tidak Ada', 
            $fileStatus['linkedin']['exists'] ? 'Tersedia' : 'Tidak Ada',
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

    public function styles(Worksheet $sheet)
    {
        // Header styling
        $sheet->getStyle('A1:T1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4A90E2']
            ]
        ]);

        // Auto-color rows based on status if this is status-specific sheet
        if ($this->sheetType !== 'all') {
            $fillColor = match($this->sheetType) {
                'approved' => 'D4EDDA',
                'rejected' => 'F8D7DA', 
                'pending' => 'FFF3CD',
                default => 'F8F9FA'
            };

            $lastRow = $sheet->getHighestRow();
            $sheet->getStyle("A2:T{$lastRow}")->applyFromArray([
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => $fillColor]
                ]
            ]);
        }

        // Add borders
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle("A1:T{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ]
            ]
        ]);

        return [];
    }

    public function title(): string
    {
        return $this->title;
    }
}

// =============================================================================
// 3. RECRUITMENT SUMMARY SHEET - Statistics sheet
// =============================================================================

class RecruitmentSummarySheet implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle, ShouldAutoSize
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        // Generate summary data
        $summary = [];
        
        // Overall statistics
        $stats = $this->getStatistics();
        $summary[] = (object)[
            'type' => 'Total Pendaftar',
            'value' => $stats['total'],
            'percentage' => '100%'
        ];
        
        $summary[] = (object)[
            'type' => 'Diterima',
            'value' => $stats['approved'],
            'percentage' => $stats['total'] > 0 ? round(($stats['approved'] / $stats['total']) * 100, 2) . '%' : '0%'
        ];
        
        $summary[] = (object)[
            'type' => 'Ditolak', 
            'value' => $stats['rejected'],
            'percentage' => $stats['total'] > 0 ? round(($stats['rejected'] / $stats['total']) * 100, 2) . '%' : '0%'
        ];
        
        $summary[] = (object)[
            'type' => 'Menunggu Review',
            'value' => $stats['pending'],
            'percentage' => $stats['total'] > 0 ? round(($stats['pending'] / $stats['total']) * 100, 2) . '%' : '0%'
        ];

        // Division statistics
        $divisionStats = $this->getDivisionStatistics();
        $summary[] = (object)['type' => '', 'value' => '', 'percentage' => '']; // Empty row
        $summary[] = (object)['type' => 'STATISTIK PER DIVISI', 'value' => '', 'percentage' => ''];
        
        foreach ($divisionStats as $division => $stat) {
            $summary[] = (object)[
                'type' => $division,
                'value' => $stat['total'],
                'percentage' => "Diterima: {$stat['approved']}, Ditolak: {$stat['rejected']}, Pending: {$stat['pending']}"
            ];
        }

        return collect($summary);
    }

    private function getStatistics(): array
    {
        $query = $this->getBaseQuery();
        
        return [
            'total' => $query->count(),
            'approved' => $query->clone()->where('status', 'approved')->count(),
            'rejected' => $query->clone()->where('status', 'rejected')->count(),
            'pending' => $query->clone()->where('status', 'pending')->count(),
        ];
    }

    private function getDivisionStatistics(): array
    {
        $divisions = Recruitment::getDivisions();
        $stats = [];
        
        foreach ($divisions as $division) {
            $query = $this->getBaseQuery()->byDivision($division);
            
            $stats[$division] = [
                'total' => $query->count(),
                'approved' => $query->clone()->where('status', 'approved')->count(),
                'rejected' => $query->clone()->where('status', 'rejected')->count(),
                'pending' => $query->clone()->where('status', 'pending')->count(),
            ];
        }
        
        return $stats;
    }

    private function getBaseQuery()
    {
        $query = Recruitment::query();

        if (!empty($this->filters['search'])) {
            $query->search($this->filters['search']);
        }

        if (!empty($this->filters['status']) && $this->filters['status'] !== 'all') {
            $query->byStatus($this->filters['status']);
        }

        if (!empty($this->filters['division']) && $this->filters['division'] !== 'all') {
            $query->byDivision($this->filters['division']);
        }

        if (!empty($this->filters['semester']) && $this->filters['semester'] !== 'all') {
            $query->bySemester((int)$this->filters['semester']);
        }

        if (!empty($this->filters['date_from']) && !empty($this->filters['date_to'])) {
            $query->inDateRange($this->filters['date_from'], $this->filters['date_to']);
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'Kategori',
            'Jumlah', 
            'Detail/Persentase'
        ];
    }

    public function map($item): array
    {
        return [
            $item->type,
            $item->value,
            $item->percentage
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Header styling
        $sheet->getStyle('A1:C1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '28A745']
            ]
        ]);

        // Summary section styling
        $sheet->getStyle('A7:C7')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFC107']
            ]
        ]);

        return [];
    }

    public function title(): string
    {
        $date = Carbon::now()->format('d-m-Y');
        return "Summary {$date}";
    }
}

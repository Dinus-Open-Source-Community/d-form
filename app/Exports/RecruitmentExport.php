<?php

namespace App\Exports;

use App\Models\Recruitment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;

class RecruitmentExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        return Recruitment::query()
            ->with('reviewer')
            ->when($this->filters['search'] ?? false, fn($q) => $q->search($this->filters['search']))
            ->when(($this->filters['status'] ?? 'all') !== 'all', fn($q) => $q->byStatus($this->filters['status']))
            ->when(($this->filters['division'] ?? 'all') !== 'all', fn($q) => $q->byDivision($this->filters['division']))
            ->when(($this->filters['semester'] ?? 'all') !== 'all', fn($q) => $q->bySemester((int)$this->filters['semester']))
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
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
            'Catatan',
            'Reviewer',
            'Tgl Review',
            'Tgl Daftar'
        ];
    }

    public function map($recruitment): array
    {
        static $no = 1;
        
        return [
            $no++,
            $recruitment->short_uuid,
            $recruitment->nama_lengkap,
            $recruitment->nim,
            $recruitment->semester,
            $recruitment->nomor_hp,
            $recruitment->email_pribadi,
            $recruitment->email_mahasiswa,
            $recruitment->divisi_utama,
            $recruitment->divisi_tambahan,
            $recruitment->username_instagram,
            $recruitment->portofolio,
            ucfirst($recruitment->status),
            $recruitment->catatan,
            $recruitment->reviewer?->name,
            $recruitment->reviewed_at?->format('d/m/Y H:i'),
            $recruitment->created_at->format('d/m/Y H:i')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Recruitment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'short_uuid',
        'nama_lengkap',
        'nim',
        'semester',
        'nomor_hp',
        'email_pribadi',
        'email_mahasiswa',
        'divisi_utama',
        'divisi_tambahan',
        'cv',
        'portofolio',
        'bukti_follow_instagram',
        'bukti_follow_linkedin',
        'username_instagram',
        'status',
        'catatan',
        'reviewed_by',
        'reviewed_at',
        'deleted_at'
    ];

    protected $casts = [
        'semester' => 'string', // enum hanya berisi '1' atau '3'
        'divisi_tambahan' => 'string',
        'reviewed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    // RELATIONSHIPS
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    // ACCESSORS
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'yellow',
            'approved' => 'green',
            'rejected' => 'red',
            default => 'gray'
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Menunggu Review',
            'approved' => 'Diterima',
            'rejected' => 'Ditolak',
            default => 'Unknown'
        };
    }

    public function getCvUrlAttribute(): ?string
    {
        return $this->cv ? asset('storage/' . $this->cv) : null;
    }

    public function getInstagramProofUrlAttribute(): ?string
    {
        return $this->bukti_follow_instagram ? asset('storage/' . $this->bukti_follow_instagram) : null;
    }

    public function getLinkedinProofUrlAttribute(): ?string
    {
        return $this->bukti_follow_linkedin ? asset('storage/' . $this->bukti_follow_linkedin) : null;
    }

    // SCOPES
    public function scopeByStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    public function scopeByDivision(Builder $query, string $division): Builder
    {
        return $query->where('divisi_utama', $division)
            ->orWhere('divisi_tambahan', $division);
    }

    public function scopeBySemester(Builder $query, string $semester): Builder
    {
        return $query->where('semester', $semester);
    }

    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function ($q) use ($search) {
            $q->where('nama_lengkap', 'LIKE', "%{$search}%")
                ->orWhere('nim', 'LIKE', "%{$search}%")
                ->orWhere('email_pribadi', 'LIKE', "%{$search}%")
                ->orWhere('email_mahasiswa', 'LIKE', "%{$search}%")
                ->orWhere('nomor_hp', 'LIKE', "%{$search}%");
        });
    }

    public function scopeInDateRange(Builder $query, $startDate, $endDate): Builder
    {
        return $query->whereBetween('created_at', [
            Carbon::parse($startDate)->startOfDay(),
            Carbon::parse($endDate)->endOfDay()
        ]);
    }

    // STATIC HELPERS
    public static function getDivisions(): array
    {
        return ['Pemrograman', 'Data', 'Jaringan', 'Medcrev'];
    }

    public static function getStatistics(): array
    {
        return [
            'total' => self::count(),
            'pending' => self::byStatus('pending')->count(),
            'approved' => self::byStatus('approved')->count(),
            'rejected' => self::byStatus('rejected')->count(),
            'today' => self::whereDate('created_at', today())->count(),
            'this_week' => self::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => self::whereMonth('created_at', now()->month)->count(),
        ];
    }

    public static function getDivisionStatistics(): array
    {
        $divisions = self::getDivisions();
        $stats = [];

        foreach ($divisions as $division) {
            $stats[$division] = [
                'total' => self::byDivision($division)->count(),
                'approved' => self::byDivision($division)->byStatus('approved')->count(),
                'pending' => self::byDivision($division)->byStatus('pending')->count(),
                'rejected' => self::byDivision($division)->byStatus('rejected')->count(),
            ];
        }

        return $stats;
    }

    public static function getDailyRegistrationData(): array
    {
        $data = [];
        $labels = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->format('M d');
            $data[] = self::whereDate('created_at', $date)->count();
        }

        return ['labels' => $labels, 'data' => $data];
    }
}

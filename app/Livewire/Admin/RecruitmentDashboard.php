<?php

namespace App\Livewire\Admin;

use App\Models\Recruitment;
use Livewire\Component;
use Carbon\Carbon;

class RecruitmentDashboard extends Component
{
    public string $period = '30'; // days
    public array $chartData = [];
    public array $statistics = [];
    public array $divisionStats = [];

    public function mount()
    {
        $this->loadData();
    }

    public function updatedPeriod()
    {
        $this->loadData();
    }

    private function loadData()
    {
        // Basic statistics
        $this->statistics = Recruitment::getStatistics();
        
        // Division statistics
        $this->divisionStats = Recruitment::getDivisionStatistics();
        
        // Chart data based on period
        $this->chartData = $this->getChartData();
    }

    private function getChartData(): array
    {
        $data = [];
        $labels = [];
        $approvedData = [];
        $rejectedData = [];
        $pendingData = [];
        
        $days = (int) $this->period;
        
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->format('M d');
            
            $dayData = Recruitment::whereDate('created_at', $date)->get();
            
            $data[] = $dayData->count();
            $approvedData[] = $dayData->where('status', 'approved')->count();
            $rejectedData[] = $dayData->where('status', 'rejected')->count(); 
            $pendingData[] = $dayData->where('status', 'pending')->count();
        }
        
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Total Pendaftar',
                    'data' => $data,
                    'borderColor' => 'rgb(59, 130, 246)',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => true
                ],
                [
                    'label' => 'Diterima', 
                    'data' => $approvedData,
                    'borderColor' => 'rgb(34, 197, 94)',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.1)'
                ],
                [
                    'label' => 'Ditolak',
                    'data' => $rejectedData, 
                    'borderColor' => 'rgb(239, 68, 68)',
                    'backgroundColor' => 'rgba(239, 68, 68, 0.1)'
                ],
                [
                    'label' => 'Menunggu',
                    'data' => $pendingData,
                    'borderColor' => 'rgb(245, 158, 11)',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)'
                ]
            ]
        ];
    }

    public function render()
    {
        return view('livewire.admin.recruitment-dashboard', [
            'recentRecruitments' => Recruitment::with('reviewer')
                ->latest()
                ->limit(5)
                ->get()
        ]);
    }
}

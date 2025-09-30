<?php
?>
<div>
    {{-- Breadcrumb --}}
    <div class="px-8 py-6 bg-white z-10">
        <div class="flex items-center text-sm text-primary/50">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition-colors ease-in-out duration-200" wire:navigate>
                Dashboard
            </a>
            <span class="mx-2">/</span>
            <span class="text-primary font-semibold">Recruitment Dashboard</span>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 px-4 sm:px-6 lg:px-10 pb-6">
        <livewire:admin.components.stat-card
            title="Total Pendaftar"
            :count="$statistics['total']"
            bgColor="bg-gradient-to-br from-blue-500 to-blue-600"
        />
        <livewire:admin.components.stat-card
            title="Menunggu Review"
            :count="$statistics['pending']"
            bgColor="bg-gradient-to-br from-yellow-500 to-yellow-600"
        />
        <livewire:admin.components.stat-card
            title="Diterima"
            :count="$statistics['approved']"
            bgColor="bg-gradient-to-br from-green-500 to-green-600"
        />
        <livewire:admin.components.stat-card
            title="Ditolak"
            :count="$statistics['rejected']"
            bgColor="bg-gradient-to-br from-red-500 to-red-600"
        />
    </div>

    {{-- Chart & Recent Data --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 px-4 pt-6 sm:px-6 lg:px-10 pb-10">
        {{-- Chart Section --}}
        <div class="bg-white rounded-lg shadow-sm border">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Grafik Pendaftar</h3>
                    <div class="flex items-center space-x-2">
                        <label class="text-sm text-gray-600">Period:</label>
                        <select wire:model.live="period" class="text-sm border border-gray-300 rounded-md px-2 py-1">
                            <option value="7">7 Hari</option>
                            <option value="30">30 Hari</option>
                            <option value="90">90 Hari</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <canvas id="recruitmentChart" height="300"></canvas>
            </div>
        </div>

        {{-- Recent Recruitments --}}
        <div class="bg-white rounded-lg shadow-sm border">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Pendaftar Terbaru</h3>
                    <a href="{{ route('admin.recruitment') }}" wire:navigate class="text-primary hover:text-primary/80 text-sm font-medium">
                        Lihat Semua
                    </a>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($recentRecruitments as $recruitment)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-900">{{ $recruitment->nama_lengkap }}</h4>
                                <p class="text-sm text-gray-600">{{ $recruitment->divisi_utama }}</p>
                                <p class="text-xs text-gray-500">{{ $recruitment->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                @if($recruitment->status === 'approved') bg-green-100 text-green-800
                                @elseif($recruitment->status === 'rejected') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif
                            ">
                                {{ $recruitment->status_label }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <span class="material-icons text-4xl mb-2 opacity-50">inbox</span>
                            <p>Belum ada pendaftar</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Division Statistics --}}
    <div class="px-4 sm:px-6 lg:px-10 pb-10">
        <div class="bg-white rounded-lg shadow-sm border">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Statistik per Divisi</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach($divisionStats as $division => $stats)
                        <div class="bg-gradient-to-r from-primary/10 to-primary/5 rounded-lg p-4">
                            <h4 class="font-medium text-gray-900 mb-3">{{ $division }}</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Total:</span>
                                    <span class="font-medium">{{ $stats['total'] }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-green-600">Diterima:</span>
                                    <span class="font-medium text-green-600">{{ $stats['approved'] }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-yellow-600">Pending:</span>
                                    <span class="font-medium text-yellow-600">{{ $stats['pending'] }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-red-600">Ditolak:</span>
                                    <span class="font-medium text-red-600">{{ $stats['rejected'] }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Chart.js Script --}}
    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let chart;
            
            function updateChart() {
                const ctx = document.getElementById('recruitmentChart').getContext('2d');
                const chartData = @json($chartData);
                
                if (chart) {
                    chart.destroy();
                }
                
                chart = new Chart(ctx, {
                    type: 'line',
                    data: chartData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            intersect: false,
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }
            
            updateChart();
            
            // Update chart when period changes
            Livewire.on('chartDataUpdated', () => {
                updateChart();
            });
        });
    </script>
    @endpush
</div>

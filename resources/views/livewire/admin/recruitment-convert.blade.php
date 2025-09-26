
<div class="flex min-h-screen flex-col bg-gray-50">
    {{-- Breadcrumb --}}
    <div class="px-8 py-6 bg-white z-10">
        <div class="flex items-center text-sm text-primary/50">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition-colors ease-in-out duration-200" wire:navigate>
                Dashboard
            </a>
            <span class="mx-2">/</span>
            <span class="text-primary font-semibold">Export Recruitment</span>
        </div>
    </div>

    <div class="mx-auto mt-4 w-full max-w-7xl rounded-xl bg-white p-4 shadow-lg md:mt-12 md:p-8">
        <h2 class="mb-4 flex items-center text-xl font-bold text-gray-800 md:mb-6 md:text-2xl">
            <span class="material-icons mr-2 text-blue-500">download</span>
            Export Data Recruitment
        </h2>

        {{-- Statistics Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            @php $stats = $this->getStatistics(); @endphp
            
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-4 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-90">Total Pendaftar</p>
                        <p class="text-2xl font-bold">{{ number_format($stats['total']) }}</p>
                    </div>
                    <span class="material-icons text-3xl opacity-60">group</span>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-4 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-90">Diterima</p>
                        <p class="text-2xl font-bold">{{ number_format($stats['approved']) }}</p>
                    </div>
                    <span class="material-icons text-3xl opacity-60">check_circle</span>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg p-4 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-90">Menunggu Review</p>
                        <p class="text-2xl font-bold">{{ number_format($stats['pending']) }}</p>
                    </div>
                    <span class="material-icons text-3xl opacity-60">schedule</span>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-lg p-4 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-90">Ditolak</p>
                        <p class="text-2xl font-bold">{{ number_format($stats['rejected']) }}</p>
                    </div>
                    <span class="material-icons text-3xl opacity-60">cancel</span>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="bg-gray-50 rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Filter Data</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select wire:model.live="selectedStatus" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="all">Semua Status</option>
                        <option value="approved">Hanya yang Diterima</option>
                        <option value="pending">Hanya Menunggu Review</option>
                        <option value="rejected">Hanya yang Ditolak</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Divisi</label>
                    <select wire:model.live="selectedDivision" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="all">Semua Divisi</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division }}">{{ $division }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- Quick Export Buttons --}}
        <div class="flex flex-wrap gap-3 mb-6">
            <button wire:click="exportCsv" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                <span class="material-icons mr-2 text-sm">file_download</span>
                Export CSV
            </button>
            
            <button wire:click="exportExcel" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                <span class="material-icons mr-2 text-sm">table_chart</span>
                Export Excel
            </button>
            
            <button wire:click="showExportModal" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors">
                <span class="material-icons mr-2 text-sm">tune</span>
                Advanced Export
            </button>

            {{-- Status-specific quick buttons --}}
            @if($stats['approved'] > 0)
            <button wire:click="$set('selectedStatus', 'approved'); exportCsv();" class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors">
                <span class="material-icons mr-2 text-sm">check_circle</span>
                Export Diterima ({{ $stats['approved'] }})
            </button>
            @endif

            @if($stats['rejected'] > 0)
            <button wire:click="$set('selectedStatus', 'rejected'); exportCsv();" class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">
                <span class="material-icons mr-2 text-sm">cancel</span>
                Export Ditolak ({{ $stats['rejected'] }})
            </button>
            @endif

            @if($stats['pending'] > 0)
            <button wire:click="$set('selectedStatus', 'pending'); exportCsv();" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition-colors">
                <span class="material-icons mr-2 text-sm">schedule</span>
                Export Menunggu ({{ $stats['pending'] }})
            </button>
            @endif
        </div>

        {{-- Current Filter Display --}}
        @if($selectedStatus !== 'all' || $selectedDivision !== 'all')
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <div class="flex items-center">
                <span class="material-icons text-blue-600 mr-2">filter_alt</span>
                <span class="text-blue-900 font-medium">Filter Aktif:</span>
                @if($selectedStatus !== 'all')
                    <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 rounded text-sm">
                        Status: {{ ucfirst($selectedStatus) }}
                    </span>
                @endif
                @if($selectedDivision !== 'all')
                    <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 rounded text-sm">
                        Divisi: {{ $selectedDivision }}
                    </span>
                @endif
            </div>
        </div>
        @endif

        <div class="flex items-center justify-between mb-4">
            <p class="text-gray-600">
                Menampilkan: <span class="font-semibold">{{ $recruitments->total() }}</span> data
                @if($selectedStatus !== 'all')
                    dengan status <strong>{{ ucfirst($selectedStatus) }}</strong>
                @endif
                @if($selectedDivision !== 'all')
                    pada divisi <strong>{{ $selectedDivision }}</strong>
                @endif
            </p>

            <div class="flex items-center space-x-2">
                <label class="text-sm text-gray-600">Per halaman:</label>
                <select wire:model.live="perPage" class="px-2 py-1 border border-gray-300 rounded text-sm">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>
        </div>

        {{-- Recruitment Table (existing table code) --}}
        <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white">
            <table class="w-full min-w-[900px] border-collapse overflow-hidden rounded-lg bg-white text-black shadow-md md:text-sm">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm text-gray-700">
                        <th class="border-b px-3 py-3 md:px-4">ID</th>
                        <th class="border-b px-3 py-3 md:px-4">Short UUID</th>
                        <th class="border-b px-3 py-3 md:px-4">Nama Lengkap</th>
                        <th class="border-b px-3 py-3 md:px-4">NIM</th>
                        <th class="border-b px-3 py-3 md:px-4">Divisi Utama</th>
                        <th class="border-b px-3 py-3 md:px-4">Status</th>
                        <th class="border-b px-3 py-3 md:px-4">Tanggal Daftar</th>
                        <th class="border-b px-3 py-3 md:px-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-xs">
                    @forelse($recruitments as $item)
                        <tr class="transition hover:bg-gray-50">
                            <td class="px-3 py-2 md:px-4">{{ $item->id }}</td>
                            <td class="px-3 py-2 md:px-4 font-mono">{{ $item->short_uuid }}</td>
                            <td class="truncate px-3 py-2 md:px-4" title="{{ $item->nama_lengkap }}">
                                {{ $item->nama_lengkap }}
                            </td>
                            <td class="px-3 py-2 md:px-4 font-mono">{{ $item->nim }}</td>
                            <td class="px-3 py-2 md:px-4">{{ $item->divisi_utama }}</td>
                            <td class="px-3 py-2 md:px-4">
                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                                    @if($item->status === 'approved') bg-green-100 text-green-800
                                    @elseif($item->status === 'rejected') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800 @endif
                                ">
                                    {{ match($item->status) {
                                        'approved' => 'Diterima',
                                        'rejected' => 'Ditolak',
                                        'pending' => 'Menunggu',
                                        default => ucfirst($item->status)
                                    } }}
                                </span>
                            </td>
                            <td class="px-3 py-2 md:px-4">{{ $item->created_at->format('d/m/Y') }}</td>
                            <td class="px-3 py-2 md:px-4">
                                <div class="flex items-center space-x-2">
                                    @if($item->cv)
                                        <a class="text-blue-600 hover:text-blue-800" href="{{ Storage::url($item->cv) }}" target="_blank" title="Lihat CV">
                                            <span class="material-icons text-sm">description</span>
                                        </a>
                                    @endif
                                    
                                    @if($item->bukti_follow_instagram)
                                        <a class="text-pink-600 hover:text-pink-800" href="{{ Storage::url($item->bukti_follow_instagram) }}" target="_blank" title="Bukti IG">
                                            <span class="material-icons text-sm">camera_alt</span>
                                        </a>
                                    @endif
                                    
                                    @if($item->bukti_follow_linkedin)
                                        <a class="text-blue-700 hover:text-blue-900" href="{{ Storage::url($item->bukti_follow_linkedin) }}" target="_blank" title="Bukti LinkedIn">
                                            <span class="material-icons text-sm">business</span>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="py-8 text-center text-gray-500" colspan="8">
                                <div class="flex flex-col items-center">
                                    <span class="material-icons text-4xl mb-2 opacity-50">inbox</span>
                                    <p>Tidak ada data yang sesuai dengan filter</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($recruitments->hasPages())
        <div class="mt-6">
            {{ $recruitments->links() }}
        </div>
        @endif
    </div>

    {{-- Advanced Export Modal --}}
    @if($showExportModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Advanced Export</h3>
            </div>

            <form wire:submit="exportFiltered">
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Format File</label>
                        <select wire:model="exportFormat" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="csv">CSV (.csv)</option>
                            <option value="xlsx">Excel (.xlsx)</option>
                            <option value="xls">Excel Legacy (.xls)</option>
                        </select>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-sm font-semibold text-gray-900 mb-2">Data yang akan diexport:</h4>
                        <div class="text-sm text-gray-600">
                            <p>• Total: {{ $stats['total'] }} data</p>
                            <p>• Status: {{ $selectedStatus === 'all' ? 'Semua' : ucfirst($selectedStatus) }}</p>
                            <p>• Divisi: {{ $selectedDivision === 'all' ? 'Semua' : $selectedDivision }}</p>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3">
                    <button type="button" wire:click="closeExportModal" class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700" wire:loading.attr="disabled">
                        <span wire:loading.remove>Export</span>
                        <span wire:loading>Processing...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- Loading Overlay --}}
    <div class="fixed inset-0 z-40 items-center justify-center bg-black/30" wire:loading.flex wire:target="exportCsv,exportExcel,exportFiltered">
        <div class="rounded-lg bg-white px-6 py-4 text-center shadow-md">
            <span class="material-icons text-blue-600 mb-2 animate-spin text-4xl">autorenew</span>
            <p class="font-semibold text-gray-700">Mengexport data...</p>
        </div>
    </div>
</div>
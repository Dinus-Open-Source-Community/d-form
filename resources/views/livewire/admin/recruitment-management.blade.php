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
            <span class="text-primary font-semibold">Manage Recruitment</span>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 px-4 sm:px-6 lg:px-10 pb-6">
        <livewire:admin.components.stat-card
            title="Total Data"
            :count="$statistics['total']"
            bgColor="bg-gradient-to-br from-primary to-[#5a7ca3]"
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

    {{-- Filters & Search --}}
    <div class="px-4 sm:px-6 lg:px-10 pb-6">
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 gap-4">
                {{-- Search --}}
                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <div class="relative">
                        <span class="material-icons absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm">search</span>
                        <input type="text" wire:model.live.debounce.300ms="search" 
                               placeholder="Nama, NIM, Email..." 
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary">
                    </div>
                </div>

                {{-- Status Filter --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select wire:model.live="statusFilter" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="all">Semua Status</option>
                        <option value="pending">Menunggu</option>
                        <option value="approved">Diterima</option>
                        <option value="rejected">Ditolak</option>
                    </select>
                </div>

                {{-- Division Filter --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Divisi</label>
                    <select wire:model.live="divisionFilter" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="all">Semua Divisi</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division }}">{{ $division }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Semester Filter --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Semester</label>
                    <select wire:model.live="semesterFilter" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="all">Semua</option>
                        @foreach($semesters as $semester)
                            <option value="{{ $semester }}">{{ $semester }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Actions --}}
                <div class="flex items-end space-x-2">
                    <button wire:click="clearFilters" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                        <span class="material-icons text-sm">clear</span>
                    </button>
                    @can('recruitment.export')
                    <button wire:click="export" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                        <span class="material-icons text-sm">download</span>
                    </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    {{-- Table Actions --}}
    <div class="px-4 sm:px-6 lg:px-10 pb-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                @if(count($selectedIds) > 0)
                    <span class="text-sm text-gray-600">{{ count($selectedIds) }} item dipilih</span>
                    <button wire:click="showBulkAction" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary/90 transition-colors text-sm">
                        Bulk Action
                    </button>
                @endif
            </div>
            
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-600">Per halaman:</span>
                <select wire:model.live="perPage" class="px-2 py-1 border border-gray-300 rounded text-sm">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Main Table --}}
    <div class="px-4 sm:px-6 lg:px-10 pb-10">
        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-4 py-3 text-left">
                                <input type="checkbox" wire:model.live="selectAll" class="rounded border-gray-300 text-primary focus:ring-primary">
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('nama_lengkap')">
                                <div class="flex items-center space-x-1">
                                    <span>Nama</span>
                                    @if($sortField === 'nama_lengkap')
                                        <span class="material-icons text-sm">{{ $sortDirection === 'asc' ? 'arrow_upward' : 'arrow_downward' }}</span>
                                    @endif
                                </div>
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('nim')">
                                <div class="flex items-center space-x-1">
                                    <span>NIM</span>
                                    @if($sortField === 'nim')
                                        <span class="material-icons text-sm">{{ $sortDirection === 'asc' ? 'arrow_upward' : 'arrow_downward' }}</span>
                                    @endif
                                </div>
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Divisi</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('status')">
                                <div class="flex items-center space-x-1">
                                    <span>Status</span>
                                    @if($sortField === 'status')
                                        <span class="material-icons text-sm">{{ $sortDirection === 'asc' ? 'arrow_upward' : 'arrow_downward' }}</span>
                                    @endif
                                </div>
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('created_at')">
                                <div class="flex items-center space-x-1">
                                    <span>Tanggal</span>
                                    @if($sortField === 'created_at')
                                        <span class="material-icons text-sm">{{ $sortDirection === 'asc' ? 'arrow_upward' : 'arrow_downward' }}</span>
                                    @endif
                                </div>
                            </th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recruitments as $recruitment)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3">
                                    <input type="checkbox" wire:model.live="selectedIds" value="{{ $recruitment->id }}" class="rounded border-gray-300 text-primary focus:ring-primary">
                                </td>
                                <td class="px-4 py-3">
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $recruitment->nama_lengkap }}</div>
                                        <div class="text-sm text-gray-500">{{ $recruitment->email_pribadi }}</div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="font-mono text-sm">{{ $recruitment->nim }}</div>
                                    <div class="text-xs text-gray-500">Semester {{ $recruitment->semester }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-sm">{{ $recruitment->divisi_utama }}</div>
                                    @if($recruitment->divisi_tambahan)
                                        <div class="text-xs text-gray-500">+ {{ $recruitment->divisi_tambahan }}</div>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                                        @if($recruitment->status === 'approved') bg-green-100 text-green-800
                                        @elseif($recruitment->status === 'rejected') bg-red-100 text-red-800
                                        @else bg-yellow-100 text-yellow-800 @endif
                                    ">
                                        {{ $recruitment->status_label }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-500">
                                    {{ $recruitment->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        {{-- Detail Button --}}
                                        <button wire:click="showDetail({{ $recruitment->id }})" class="text-blue-600 hover:text-blue-800" title="Detail">
                                            <span class="material-icons text-sm">visibility</span>
                                        </button>

                                        {{-- Review Buttons --}}
                                        @if($recruitment->status === 'pending')
                                            @can('recruitment.approve')
                                            <button wire:click="showReview({{ $recruitment->id }}, 'approve')" class="text-green-600 hover:text-green-800" title="Approve">
                                                <span class="material-icons text-sm">check_circle</span>
                                            </button>
                                            @endcan
                                            
                                            @can('recruitment.reject')
                                            <button wire:click="showReview({{ $recruitment->id }}, 'reject')" class="text-red-600 hover:text-red-800" title="Reject">
                                                <span class="material-icons text-sm">cancel</span>
                                            </button>
                                            @endcan
                                        @endif

                                        {{-- Delete Button --}}
                                        @can('recruitment.delete')
                                        <button wire:click="confirmDelete({{ $recruitment->id }})" class="text-red-600 hover:text-red-800" title="Delete">
                                            <span class="material-icons text-sm">delete</span>
                                        </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <span class="material-icons text-4xl text-gray-400 mb-2">inbox</span>
                                        <p class="text-gray-500">Data tidak ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($recruitments->hasPages())
                <div class="px-4 py-3 border-t">
                    {{ $recruitments->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Modals will be included in next part --}}
    @include('livewire.admin.recruitment.modals')

    {{-- Toast Notifications --}}
    <div x-data="{ show: false, message: '', type: 'success' }" 
         x-on:recruitment-reviewed.window="show = true; message = $event.detail.message; type = 'success'; setTimeout(() => show = false, 3000)"
         x-on:recruitment-deleted.window="show = true; message = $event.detail.message; type = 'success'; setTimeout(() => show = false, 3000)"
         x-on:bulk-action-completed.window="show = true; message = $event.detail.message; type = 'success'; setTimeout(() => show = false, 3000)"
         x-on:alert.window="show = true; message = $event.detail.message; type = $event.detail.type; setTimeout(() => show = false, 3000)"
         x-show="show" 
         x-transition
         class="fixed top-4 right-4 z-50">
        <div class="rounded-md p-4 shadow-lg"
             :class="type === 'success' ? 'bg-green-50 border border-green-200' : 
                     type === 'error' ? 'bg-red-50 border border-red-200' : 
                     'bg-yellow-50 border border-yellow-200'">
            <div class="flex items-center">
                <span class="material-icons mr-2" 
                      :class="type === 'success' ? 'text-green-500' : 
                              type === 'error' ? 'text-red-500' : 
                              'text-yellow-500'"
                      x-text="type === 'success' ? 'check_circle' : 
                             type === 'error' ? 'error' : 
                             'warning'"></span>
                <p class="font-medium" 
                   :class="type === 'success' ? 'text-green-800' : 
                           type === 'error' ? 'text-red-800' : 
                           'text-yellow-800'"
                   x-text="message"></p>
                <button @click="show = false" class="ml-auto">
                    <span class="material-icons text-sm text-gray-400 hover:text-gray-600">close</span>
                </button>
            </div>
        </div>
    </div>
</div>

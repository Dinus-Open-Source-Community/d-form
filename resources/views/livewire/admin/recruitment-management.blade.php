<?php

?>
<div>
    {{-- Breadcrumb --}}
    <div class="z-10 bg-white px-8 py-6">
        <div class="text-primary/50 flex items-center text-sm">
            <a class="hover:text-primary transition-colors duration-200 ease-in-out" href="{{ route('admin.dashboard') }}"
                wire:navigate>
                Dashboard
            </a>
            <span class="mx-2">/</span>
            <span class="text-primary font-semibold">Manage Recruitment</span>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 gap-4 px-4 pb-8 sm:grid-cols-2 sm:gap-6 sm:px-6 lg:grid-cols-4 lg:px-10">
        <livewire:admin.components.stat-card title="Total Data" :count="$statistics['total']"
            bgColor="bg-gradient-to-br from-primary to-[#5a7ca3]" />
        <livewire:admin.components.stat-card title="Menunggu Review" :count="$statistics['pending']"
            bgColor="bg-gradient-to-br from-yellow-500 to-yellow-600" />
        <livewire:admin.components.stat-card title="Diterima" :count="$statistics['approved']"
            bgColor="bg-gradient-to-br from-green-500 to-green-600" />
        <livewire:admin.components.stat-card title="Ditolak" :count="$statistics['rejected']"
            bgColor="bg-gradient-to-br from-red-500 to-red-600" />
    </div>

    {{-- Filters & Search --}}
    <div class="px-4 pt-8 pb-6 sm:px-6 lg:px-10">
        <div class="rounded-lg border bg-white p-6 pt-10 shadow-sm">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6">
                {{-- Search --}}
                <div class="lg:col-span-2">
                    <label class="mb-1 block text-sm font-medium text-gray-700">Search</label>
                    <div class="relative">
                        <span
                            class="material-icons absolute left-3 top-1/2 -translate-y-1/2 transform text-sm text-gray-400">search</span>
                        <input
                            class="focus:ring-primary focus:border-primary w-full rounded-md border border-gray-300 py-2 pl-10 pr-4 focus:ring-2"
                            type="text" wire:model.live.debounce.300ms="search" placeholder="Nama, NIM, Email...">
                </div>
                </div>

                {{-- Status Filter --}}
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Status</label>
                    <select
                        class="focus:ring-primary focus:border-primary w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-2"
                        wire:model.live="statusFilter">
                        <option value="all">Semua Status</option>
                        <option value="pending">Menunggu</option>
                        <option value="approved">Diterima</option>
                        <option value="rejected">Ditolak</option>
                    </select>
                </div>

                {{-- Division Filter --}}
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Divisi</label>
                    <select
                        class="focus:ring-primary focus:border-primary w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-2"
                        wire:model.live="divisionFilter">
                        <option value="all">Semua Divisi</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division }}">{{ $division }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Semester Filter --}}
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Semester</label>
                    <select
                        class="focus:ring-primary focus:border-primary w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-2"
                        wire:model.live="semesterFilter">
                        <option value="all">Semua</option>
                        @foreach ($semesters as $semester)
                            <option value="{{ $semester }}">{{ $semester }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Actions --}}
                <div class="flex items-end space-x-2">
                    <button class="rounded-md bg-gray-500 px-4 py-2 text-white transition-colors hover:bg-gray-600"
                        wire:click="clearFilters">
                        <span class="material-icons text-sm">clear</span>
                    </button>
                    @can('recruitment.export')
                        <button class="rounded-md bg-green-600 px-4 py-2 text-white transition-colors hover:bg-green-700"
                            wire:click="export">
                            <span class="material-icons text-sm">download</span>
                        </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    {{-- Table Actions --}}
    <div class="px-4 pb-4 sm:px-6 lg:px-10">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                @if (count($selectedIds) > 0)
                    <span class="text-sm text-gray-600">{{ count($selectedIds) }} item dipilih</span>
                    <button
                        class="bg-primary hover:bg-primary/90 rounded-md px-4 py-2 text-sm text-white transition-colors"
                        wire:click="showBulkAction">
                        Bulk Action
                    </button>
                @endif
            </div>

            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-600">Per halaman:</span>
                <select class="rounded border border-gray-300 px-2 py-1 text-sm" wire:model.live="perPage">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Main Table --}}
    <div class="px-4 pb-10 sm:px-6 lg:px-10">
        <div class="overflow-hidden rounded-lg border bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left">
                                <input class="text-primary focus:ring-primary rounded border-gray-300" type="checkbox"
                                    wire:model.live="selectAll">
                            </th>
                            <th class="cursor-pointer px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                wire:click="sortBy('nama_lengkap')">
                                <div class="flex items-center space-x-1">
                                    <span>Nama</span>
                                    @if ($sortField === 'nama_lengkap')
                                        <span
                                            class="material-icons text-sm">{{ $sortDirection === 'asc' ? 'arrow_upward' : 'arrow_downward' }}</span>
                                    @endif
                                </div>
                            </th>
                            <th class="cursor-pointer px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                wire:click="sortBy('nim')">
                                <div class="flex items-center space-x-1">
                                    <span>NIM</span>
                                    @if ($sortField === 'nim')
                                        <span
                                            class="material-icons text-sm">{{ $sortDirection === 'asc' ? 'arrow_upward' : 'arrow_downward' }}</span>
                                    @endif
                                </div>
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Divisi</th>
                            <th class="cursor-pointer px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                wire:click="sortBy('status')">
                                <div class="flex items-center space-x-1">
                                    <span>Status</span>
                                    @if ($sortField === 'status')
                                        <span
                                            class="material-icons text-sm">{{ $sortDirection === 'asc' ? 'arrow_upward' : 'arrow_downward' }}</span>
                                    @endif
                                </div>
                            </th>
                            <th class="cursor-pointer px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                wire:click="sortBy('created_at')">
                                <div class="flex items-center space-x-1">
                                    <span>Tanggal</span>
                                    @if ($sortField === 'created_at')
                                        <span
                                            class="material-icons text-sm">{{ $sortDirection === 'asc' ? 'arrow_upward' : 'arrow_downward' }}</span>
                                    @endif
                                </div>
                            </th>
                            <th
                                class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($recruitments as $recruitment)
                            <tr class="transition-colors hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <input class="text-primary focus:ring-primary rounded border-gray-300"
                                        type="checkbox" value="{{ $recruitment->id }}" wire:model.live="selectedIds">
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
                                    @if ($recruitment->divisi_tambahan)
                                        <div class="text-xs text-gray-500">+ {{ $recruitment->divisi_tambahan }}</div>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <span
                                        class="@if ($recruitment->status === 'approved') bg-green-100 text-green-800
                                        @elseif($recruitment->status === 'rejected') bg-red-100 text-red-800
                                        @else bg-yellow-100 text-yellow-800 @endif inline-flex rounded-full px-2 py-1 text-xs font-medium">
                                        {{ $recruitment->status_label }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-500">
                                    {{ $recruitment->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        {{-- Detail Button --}}
                                        <button class="text-blue-600 hover:text-blue-800" title="Detail"
                                            wire:click="showDetail({{ $recruitment->id }})">
                                            <span class="material-icons text-sm">visibility</span>
                                        </button>

                                        {{-- Review Buttons --}}
                                        @if ($recruitment->status === 'pending')
                                            @can('recruitment.approve')
                                                <button class="text-green-600 hover:text-green-800" title="Approve"
                                                    wire:click="showReview({{ $recruitment->id }}, 'approve')">
                                                    <span class="material-icons text-sm">check_circle</span>
                                                </button>
                                            @endcan

                                            @can('recruitment.reject')
                                                <button class="text-red-600 hover:text-red-800" title="Reject"
                                                    wire:click="showReview({{ $recruitment->id }}, 'reject')">
                                                    <span class="material-icons text-sm">cancel</span>
                                                </button>
                                            @endcan
                                        @endif

                                        {{-- Delete Button --}}
                                        @can('recruitment.delete')
                                            <button class="text-red-600 hover:text-red-800" title="Delete"
                                                wire:click="confirmDelete({{ $recruitment->id }})">
                                                <span class="material-icons text-sm">delete</span>
                                            </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-4 py-12 text-center" colspan="7">
                                    <div class="flex flex-col items-center">
                                        <span class="material-icons mb-2 text-4xl text-gray-400">inbox</span>
                                        <p class="text-gray-500">Data tidak ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($recruitments->hasPages())
                <div class="border-t px-4 py-3">
                    {{ $recruitments->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Modals will be included in next part --}}
    @include('livewire.admin.recruitment.modals')

    {{-- Toast Notifications --}}
    <div class="fixed right-4 top-4 z-50" x-data="{ show: false, message: '', type: 'success' }"
        x-on:recruitment-reviewed.window="show = true; message = $event.detail.message; type = 'success'; setTimeout(() => show = false, 3000)"
        x-on:recruitment-deleted.window="show = true; message = $event.detail.message; type = 'success'; setTimeout(() => show = false, 3000)"
        x-on:bulk-action-completed.window="show = true; message = $event.detail.message; type = 'success'; setTimeout(() => show = false, 3000)"
        x-on:alert.window="show = true; message = $event.detail.message; type = $event.detail.type; setTimeout(() => show = false, 3000)"
        x-show="show" x-transition>
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
                <button class="ml-auto" @click="show = false">
                    <span class="material-icons text-sm text-gray-400 hover:text-gray-600">close</span>
                </button>
            </div>
        </div>
    </div>
</div>

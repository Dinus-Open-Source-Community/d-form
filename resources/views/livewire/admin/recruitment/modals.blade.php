<?php

?>
{{-- Detail Modal --}}
<div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;"
    x-show="$wire.showDetailModal" x-transition.opacity>
    <div class="mx-4 max-h-[90vh] w-full max-w-4xl overflow-y-auto rounded-lg bg-white shadow-xl">
        <div class="sticky top-0 flex items-center justify-between border-b border-gray-200 bg-white px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-900">Detail Pendaftar</h3>
            <button class="text-gray-400 hover:text-gray-600" wire:click="closeDetailModal">
                <span class="material-icons">close</span>
            </button>
        </div>

        @if ($selectedRecruitment)
            <div class="p-6">
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    {{-- Personal Info --}}
                    <div class="space-y-4">
                        <h4 class="border-b pb-2 font-semibold text-gray-900">Informasi Pribadi</h4>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $selectedRecruitment->nama_lengkap }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">NIM</label>
                                <p class="mt-1 font-mono text-sm text-gray-900">{{ $selectedRecruitment->nim }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Semester</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $selectedRecruitment->semester }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">No HP</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $selectedRecruitment->nomor_hp }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email Pribadi</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $selectedRecruitment->email_pribadi }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email Mahasiswa</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $selectedRecruitment->email_mahasiswa }}</p>
                            </div>
                        </div>

                        {{-- Division Info --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Divisi Utama</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $selectedRecruitment->divisi_utama }}</p>
                        </div>
                        @if ($selectedRecruitment->divisi_tambahan)
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Divisi Tambahan</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $selectedRecruitment->divisi_tambahan }}</p>
                            </div>
                        @endif

                        {{-- Portfolio - Fixed URL --}}
                        @if ($selectedRecruitment->portofolio)
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Portfolio</label>
                                <a class="text-primary hover:text-primary/80 mt-1 inline-flex items-center text-sm"
                                    href="{{ asset('storage/' . $selectedRecruitment->portofolio) }}" target="_blank">
                                    <span class="material-icons mr-1 text-sm">open_in_new</span>
                                    Lihat Portfolio
                                </a>
                            </div>
                        @endif

                        {{-- Instagram --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Username Instagram</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $selectedRecruitment->username_instagram }}</p>
                        </div>
                    </div>

                    {{-- Files & Status --}}
                    <div class="space-y-4">
                        <h4 class="border-b pb-2 font-semibold text-gray-900">Dokumen & Status</h4>

                        {{-- Files - Fixed Preview --}}
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">CV</label>
                                @if ($selectedRecruitment->cv)
                                    <div class="mt-1 space-x-2">
                                        <button
                                            class="text-primary hover:text-primary/80 inline-flex items-center text-sm"
                                            @click.prevent="$dispatch('preview-file', { url: '{{ asset('storage/' . $selectedRecruitment->cv) }}', type: 'cv', name: '{{ basename($selectedRecruitment->cv) }}' })">
                                            <span class="material-icons mr-1 text-sm">visibility</span>
                                            Preview CV
                                        </button>
                                        <a class="inline-flex items-center text-sm text-green-600 hover:text-green-800"
                                            href="{{ asset('storage/' . $selectedRecruitment->cv) }}" target="_blank">
                                            <span class="material-icons mr-1 text-sm">open_in_new</span>
                                            Buka di Tab Baru
                                        </a>
                                    </div>
                                @else
                                    <p class="mt-1 text-sm text-gray-400">Tidak ada CV</p>
                                @endif
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Bukti Follow Instagram</label>
                                @if ($selectedRecruitment->bukti_follow_instagram)
                                    <div class="mt-1 space-x-2">
                                        <button
                                            class="text-primary hover:text-primary/80 inline-flex items-center text-sm"
                                            @click.prevent="$dispatch('preview-file', { url: '{{ asset('storage/' . $selectedRecruitment->bukti_follow_instagram) }}', type: 'image', name: '{{ basename($selectedRecruitment->bukti_follow_instagram) }}' })">
                                            <span class="material-icons mr-1 text-sm">visibility</span>
                                            Preview Gambar
                                        </button>
                                        <a class="inline-flex items-center text-sm text-green-600 hover:text-green-800"
                                            href="{{ asset('storage/' . $selectedRecruitment->bukti_follow_instagram) }}"
                                            target="_blank">
                                            <span class="material-icons mr-1 text-sm">open_in_new</span>
                                            Buka di Tab Baru
                                        </a>
                                    </div>
                                @else
                                    <p class="mt-1 text-sm text-gray-400">Tidak ada bukti</p>
                                @endif
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Bukti Follow LinkedIn</label>
                                @if ($selectedRecruitment->bukti_follow_linkedin)
                                    <div class="mt-1 space-x-2">
                                        <button
                                            class="text-primary hover:text-primary/80 inline-flex items-center text-sm"
                                            @click.prevent="$dispatch('preview-file', { url: '{{ asset('storage/' . $selectedRecruitment->bukti_follow_linkedin) }}', type: 'image', name: '{{ basename($selectedRecruitment->bukti_follow_linkedin) }}' })">
                                            <span class="material-icons mr-1 text-sm">visibility</span>
                                            Preview Gambar
                                        </button>
                                        <a class="inline-flex items-center text-sm text-green-600 hover:text-green-800"
                                            href="{{ asset('storage/' . $selectedRecruitment->bukti_follow_linkedin) }}"
                                            target="_blank">
                                            <span class="material-icons mr-1 text-sm">open_in_new</span>
                                            Buka di Tab Baru
                                        </a>
                                    </div>
                                @else
                                    <p class="mt-1 text-sm text-gray-400">Tidak ada bukti</p>
                                @endif
                            </div>
                        </div>

                        {{-- Status Info --}}
                        <div class="rounded-lg bg-gray-50 p-4">
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Status</label>
                                    <span
                                        class="@if ($selectedRecruitment->status === 'approved') bg-green-100 text-green-800
                                    @elseif($selectedRecruitment->status === 'rejected') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800 @endif mt-1 inline-flex rounded-full px-2 py-1 text-xs font-medium">
                                        {{ $selectedRecruitment->status_label }}
                                    </span>
                                </div>

                                @if ($selectedRecruitment->reviewed_by)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Direview oleh</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            {{ $selectedRecruitment->reviewer->name }}</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Tanggal Review</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            {{ $selectedRecruitment->reviewed_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                @endif

                                @if ($selectedRecruitment->catatan)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Catatan</label>
                                        <p class="mt-1 rounded border bg-white p-2 text-sm text-gray-900">
                                            {{ $selectedRecruitment->catatan }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Timestamps --}}
                        <div class="space-y-1 text-xs text-gray-500">
                            <p>Terdaftar: {{ $selectedRecruitment->created_at->format('d/m/Y H:i') }}</p>
                            <p>UUID: {{ $selectedRecruitment->short_uuid }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Review Modal --}}
<div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;"
    x-show="$wire.showReviewModal" x-transition.opacity>
    <div class="mx-4 w-full max-w-md rounded-lg bg-white shadow-xl">
        <div class="border-b border-gray-200 px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-900">
                {{ $reviewAction === 'approve' ? 'Terima Pendaftar' : 'Tolak Pendaftar' }}
            </h3>
        </div>

        <form wire:submit="submitReview">
            <div class="p-6">
                @if ($selectedRecruitment)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600">Anda akan
                            <span
                                class="{{ $reviewAction === 'approve' ? 'text-green-600' : 'text-red-600' }} font-semibold">
                                {{ $reviewAction === 'approve' ? 'menerima' : 'menolak' }}
                            </span>
                            pendaftar:
                        </p>
                        <p class="mt-1 font-medium text-gray-900">{{ $selectedRecruitment->nama_lengkap }}</p>
                        <p class="text-sm text-gray-500">{{ $selectedRecruitment->divisi_utama }}</p>
                    </div>
                @endif

                <div class="mb-4">
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Catatan {{ $reviewAction === 'reject' ? '(Wajib)' : '(Opsional)' }}
                    </label>
                    <textarea
                        class="focus:ring-primary focus:border-primary w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-2"
                        wire:model="reviewNote" rows="3"
                        placeholder="{{ $reviewAction === 'approve' ? 'Selamat! Anda diterima di...' : 'Alasan penolakan...' }}"></textarea>
                    @error('reviewNote')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-xs text-gray-500">
                    <p>• Email notifikasi akan dikirim otomatis ke pendaftar</p>
                    <p>• Tindakan ini tidak dapat dibatalkan</p>
                </div>
            </div>

            <div class="flex justify-end space-x-3 bg-gray-50 px-6 py-4">
                <button class="rounded-md border border-gray-300 bg-white px-4 py-2 text-gray-700 hover:bg-gray-50"
                    type="button" wire:click="closeReviewModal">
                    Batal
                </button>
                <button
                    class="{{ $reviewAction === 'approve' ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }} rounded-md px-4 py-2 text-white"
                    type="submit" wire:loading.attr="disabled">
                    <span wire:loading.remove">{{ $reviewAction === 'approve' ? 'Terima' : 'Tolak' }}</span>
                    <span wire:loading>Processing...</span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Delete Modal --}}
<div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;"
    x-show="$wire.showDeleteModal" x-transition.opacity>
    <div class="mx-4 w-full max-w-md rounded-lg bg-white shadow-xl">
        <div class="border-b border-gray-200 px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-900">Hapus Data</h3>
        </div>

        <div class="p-6">
            @if ($selectedRecruitment)
                <div class="mb-4 flex items-center">
                    <span class="material-icons mr-3 text-red-500">warning</span>
                    <div>
                        <p class="text-sm text-gray-600">Anda akan menghapus data pendaftar:</p>
                        <p class="font-medium text-gray-900">{{ $selectedRecruitment->nama_lengkap }}</p>
                        <p class="text-sm text-gray-500">{{ $selectedRecruitment->nim }}</p>
                    </div>
                </div>
            @endif

            <div class="rounded-md border border-yellow-200 bg-yellow-50 p-3">
                <p class="text-sm text-yellow-800">Data akan dipindahkan ke recycle bin dan dapat dipulihkan kembali.
                </p>
            </div>
        </div>

        <div class="flex justify-end space-x-3 bg-gray-50 px-6 py-4">
            <button class="rounded-md border border-gray-300 bg-white px-4 py-2 text-gray-700 hover:bg-gray-50"
                wire:click="closeDeleteModal">
                Batal
            </button>
            <button class="rounded-md bg-red-600 px-4 py-2 text-white hover:bg-red-700" wire:click="deleteRecruitment"
                wire:loading.attr="disabled">
                <span wire:loading.remove>Hapus</span>
                <span wire:loading>Menghapus...</span>
            </button>
        </div>
    </div>
</div>

{{-- Bulk Action Modal --}}
<div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;"
    x-show="$wire.showBulkActionModal" x-transition.opacity>
    <div class="mx-4 w-full max-w-md rounded-lg bg-white shadow-xl">
        <div class="border-b border-gray-200 px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-900">Bulk Action</h3>
        </div>

        <form wire:submit="submitBulkAction">
            <div class="p-6">
                <div class="mb-4">
                    <p class="mb-2 text-sm text-gray-600">
                        {{ count($selectedIds) }} data akan diproses
                    </p>
                </div>

                <div class="mb-4">
                    <label class="mb-2 block text-sm font-medium text-gray-700">Pilih Aksi</label>
                    <select
                        class="focus:ring-primary focus:border-primary w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-2"
                        wire:model.live="bulkAction">
                        <option value="">-- Pilih Aksi --</option>
                        <option value="approve">Terima Semua</option>
                        <option value="reject">Tolak Semua</option>
                        <option value="delete">Hapus Semua</option>
                    </select>
                    @error('bulkAction')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                @if (in_array($bulkAction, ['approve', 'reject']))
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Catatan {{ $bulkAction === 'reject' ? '(Wajib)' : '(Opsional)' }}
                        </label>
                        <textarea
                            class="focus:ring-primary focus:border-primary w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-2"
                            wire:model="bulkNote" rows="3" placeholder="Catatan untuk semua data yang dipilih..."></textarea>
                        @error('bulkNote')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                @if ($bulkAction)
                    <div class="text-xs text-gray-500">
                        @if ($bulkAction === 'delete')
                            <p>• Data akan dipindahkan ke recycle bin</p>
                        @else
                            <p>• Email notifikasi akan dikirim ke semua pendaftar</p>
                        @endif
                        <p>• Tindakan ini tidak dapat dibatalkan</p>
                    </div>
                @endif
            </div>

            <div class="flex justify-end space-x-3 bg-gray-50 px-6 py-4">
                <button class="rounded-md border border-gray-300 bg-white px-4 py-2 text-gray-700 hover:bg-gray-50"
                    type="button" wire:click="closeBulkActionModal">
                    Batal
                </button>
                <button
                    class="@if ($bulkAction === 'approve') bg-green-600 hover:bg-green-700
                        @elseif($bulkAction === 'reject') bg-red-600 hover:bg-red-700
                        @else bg-gray-600 hover:bg-gray-700 @endif rounded-md px-4 py-2 text-white"
                    type="submit" wire:loading.attr="disabled" @disabled(!$bulkAction)>
                    <span wire:loading.remove">Proses</span>
                    <span wire:loading>Processing...</span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- File Preview Modal - Fixed and Improved --}}
<div class="fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-80 p-2" style="display: none;"
    x-data="{
        show: false,
        fileUrl: '',
        fileType: '',
        fileName: '',
        loading: false,
        open(url, type, name) {
            this.fileUrl = url;
            this.fileType = type;
            this.fileName = name;
            this.show = true;
            this.loading = true;
            this.$nextTick(() => {
                setTimeout(() => { this.loading = false }, 400);
            });
        },
        close() {
            this.show = false;
            this.fileUrl = '';
            this.fileType = '';
            this.fileName = '';
        }
    }" x-show="show"
    @preview-file.window="open($event.detail.url, $event.detail.type, $event.detail.name)"
    @keydown.window.escape="close()">
    <div class="relative max-h-[98vh] w-full max-w-7xl overflow-hidden rounded-xl bg-white shadow-2xl"
        @click.away="close()">
        {{-- Sticky Header --}}
        <div class="sticky top-0 z-10 flex items-center justify-between border-b bg-white p-4 shadow-sm">
            <div class="flex-1">
                <h3 class="truncate pr-4 text-lg font-semibold text-gray-900" x-text="fileName"></h3>
                <p class="text-sm font-medium text-gray-500" x-text="fileType.toUpperCase()"></p>
            </div>
            <div class="ml-4 flex items-center space-x-2">
                <a class="inline-flex items-center rounded-lg bg-gray-100 px-3 py-2 text-sm font-medium text-gray-700 transition-colors duration-200 hover:bg-gray-200"
                    title="Download File" :href="fileUrl" :download="fileName" target="_blank">
                    <span class="material-icons mr-1 text-sm">download</span>
                    Download
                </a>
                <button
                    class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-gray-400 transition-colors duration-200 hover:bg-gray-100 hover:text-gray-600"
                    title="Tutup Preview" @click="close()">
                    <span class="material-icons text-xl">close</span>
                </button>
            </div>
        </div>
        {{-- Content Area --}}
        <div class="relative flex items-center justify-center bg-gray-50" style="height: calc(98vh - 100px);">
            <template x-if="loading">
                <div class="absolute inset-0 z-10 flex items-center justify-center bg-white bg-opacity-90">
                    <div class="text-center">
                        <div
                            class="mx-auto mb-4 h-12 w-12 animate-spin rounded-full border-4 border-gray-300 border-t-blue-500">
                        </div>
                        <p class="font-medium text-gray-600">Memuat preview...</p>
                    </div>
                </div>
            </template>
            <template x-if="!loading && (fileType === 'cv' || fileName.toLowerCase().includes('.pdf'))">
                <div class="h-full w-full p-4">
                    <iframe class="h-full w-full rounded-lg border-0 bg-white shadow-inner" title="PDF Preview"
                        :src="fileUrl + '#toolbar=1&navpanes=1&scrollbar=1&view=FitH'"></iframe>
                </div>
            </template>
            <template x-if="!loading && !(fileType === 'cv' || fileName.toLowerCase().includes('.pdf'))">
                <div class="flex h-full w-full items-center justify-center p-4">
                    <div class="relative max-h-full max-w-full">
                        <img class="max-h-full max-w-full rounded-lg object-contain shadow-lg transition-opacity duration-300"
                            :src="fileUrl" :alt="fileName" />
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

<?php

?>
{{-- Detail Modal --}}
<div x-show="$wire.showDetailModal" 
     x-transition.opacity
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
     style="display: none;">
    <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Detail Pendaftar</h3>
            <button wire:click="closeDetailModal" class="text-gray-400 hover:text-gray-600">
                <span class="material-icons">close</span>
            </button>
        </div>

        @if($selectedRecruitment)
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Personal Info --}}
                <div class="space-y-4">
                    <h4 class="font-semibold text-gray-900 border-b pb-2">Informasi Pribadi</h4>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $selectedRecruitment->nama_lengkap }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIM</label>
                            <p class="mt-1 text-sm text-gray-900 font-mono">{{ $selectedRecruitment->nim }}</p>
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
                    @if($selectedRecruitment->divisi_tambahan)
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Divisi Tambahan</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $selectedRecruitment->divisi_tambahan }}</p>
                    </div>
                    @endif

                    {{-- Portfolio --}}
                    @if($selectedRecruitment->portofolio)
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Portfolio</label>
                            <a href="{{ asset('storage/portofolio/' . $selectedRecruitment->portofolio) }}" 
                            target="_blank" 
                            class="mt-1 inline-flex items-center text-sm text-primary hover:text-primary/80">
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
                    <h4 class="font-semibold text-gray-900 border-b pb-2">Dokumen & Status</h4>
                    
                    {{-- Files --}}
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">CV</label>
                            <button wire:click="previewFile({{ $selectedRecruitment->id }}, 'cv')"
                                    class="mt-1 inline-flex items-center text-sm text-primary hover:text-primary/80">
                                <span class="material-icons mr-1 text-sm">description</span>
                                Preview CV
                            </button>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Bukti Follow Instagram</label>
                            <button wire:click="previewFile({{ $selectedRecruitment->id }}, 'instagram')"
                                    class="mt-1 inline-flex items-center text-sm text-primary hover:text-primary/80">
                                <span class="material-icons mr-1 text-sm">image</span>
                                Preview Gambar
                            </button>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Bukti Follow LinkedIn</label>
                            <button wire:click="previewFile({{ $selectedRecruitment->id }}, 'linkedin')"
                                    class="mt-1 inline-flex items-center text-sm text-primary hover:text-primary/80">
                                <span class="material-icons mr-1 text-sm">image</span>
                                Preview Gambar
                            </button>
                        </div>
                    </div>

                    {{-- Status Info --}}
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full mt-1
                                    @if($selectedRecruitment->status === 'approved') bg-green-100 text-green-800
                                    @elseif($selectedRecruitment->status === 'rejected') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800 @endif
                                ">
                                    {{ $selectedRecruitment->status_label }}
                                </span>
                            </div>
                            
                            @if($selectedRecruitment->reviewed_by)
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Direview oleh</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $selectedRecruitment->reviewer->name }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Review</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $selectedRecruitment->reviewed_at->format('d/m/Y H:i') }}</p>
                            </div>
                            @endif
                            
                            @if($selectedRecruitment->catatan)
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Catatan</label>
                                <p class="mt-1 text-sm text-gray-900 bg-white p-2 rounded border">{{ $selectedRecruitment->catatan }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Timestamps --}}
                    <div class="text-xs text-gray-500 space-y-1">
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
<div x-show="$wire.showReviewModal" 
     x-transition.opacity
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
     style="display: none;">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">
                {{ $reviewAction === 'approve' ? 'Terima Pendaftar' : 'Tolak Pendaftar' }}
            </h3>
        </div>

        <form wire:submit="submitReview">
            <div class="p-6">
                @if($selectedRecruitment)
                <div class="mb-4">
                    <p class="text-sm text-gray-600">Anda akan 
                        <span class="font-semibold {{ $reviewAction === 'approve' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $reviewAction === 'approve' ? 'menerima' : 'menolak' }}
                        </span> 
                        pendaftar:
                    </p>
                    <p class="font-medium text-gray-900 mt-1">{{ $selectedRecruitment->nama_lengkap }}</p>
                    <p class="text-sm text-gray-500">{{ $selectedRecruitment->divisi_utama }}</p>
                </div>
                @endif

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Catatan {{ $reviewAction === 'reject' ? '(Wajib)' : '(Opsional)' }}
                    </label>
                    <textarea wire:model="reviewNote" 
                              rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary"
                              placeholder="{{ $reviewAction === 'approve' ? 'Selamat! Anda diterima di...' : 'Alasan penolakan...' }}"></textarea>
                    @error('reviewNote')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-xs text-gray-500">
                    <p>• Email notifikasi akan dikirim otomatis ke pendaftar</p>
                    <p>• Tindakan ini tidak dapat dibatalkan</p>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3">
                <button type="button" wire:click="closeReviewModal" class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit" 
                        class="px-4 py-2 text-white rounded-md {{ $reviewAction === 'approve' ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }}"
                        wire:loading.attr="disabled">
                    <span wire:loading.remove>{{ $reviewAction === 'approve' ? 'Terima' : 'Tolak' }}</span>
                    <span wire:loading>Processing...</span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Delete Modal --}}
<div x-show="$wire.showDeleteModal" 
     x-transition.opacity
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
     style="display: none;">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Hapus Data</h3>
        </div>

        <div class="p-6">
            @if($selectedRecruitment)
            <div class="flex items-center mb-4">
                <span class="material-icons text-red-500 mr-3">warning</span>
                <div>
                    <p class="text-sm text-gray-600">Anda akan menghapus data pendaftar:</p>
                    <p class="font-medium text-gray-900">{{ $selectedRecruitment->nama_lengkap }}</p>
                    <p class="text-sm text-gray-500">{{ $selectedRecruitment->nim }}</p>
                </div>
            </div>
            @endif

            <div class="bg-yellow-50 border border-yellow-200 rounded-md p-3">
                <p class="text-sm text-yellow-800">Data akan dipindahkan ke recycle bin dan dapat dipulihkan kembali.</p>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3">
            <button wire:click="closeDeleteModal" class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                Batal
            </button>
            <button wire:click="deleteRecruitment" 
                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700"
                    wire:loading.attr="disabled">
                <span wire:loading.remove>Hapus</span>
                <span wire:loading>Menghapus...</span>
            </button>
        </div>
    </div>
</div>

{{-- Bulk Action Modal --}}
<div x-show="$wire.showBulkActionModal" 
     x-transition.opacity
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
     style="display: none;">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Bulk Action</h3>
        </div>

        <form wire:submit="submitBulkAction">
            <div class="p-6">
                <div class="mb-4">
                    <p class="text-sm text-gray-600 mb-2">
                        {{ count($selectedIds) }} data akan diproses
                    </p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Aksi</label>
                    <select wire:model.live="bulkAction" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="">-- Pilih Aksi --</option>
                        <option value="approve">Terima Semua</option>
                        <option value="reject">Tolak Semua</option>
                        <option value="delete">Hapus Semua</option>
                    </select>
                    @error('bulkAction')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                @if(in_array($bulkAction, ['approve', 'reject']))
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Catatan {{ $bulkAction === 'reject' ? '(Wajib)' : '(Opsional)' }}
                    </label>
                    <textarea wire:model="bulkNote" 
                              rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary"
                              placeholder="Catatan untuk semua data yang dipilih..."></textarea>
                    @error('bulkNote')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                @endif

                @if($bulkAction)
                <div class="text-xs text-gray-500">
                    @if($bulkAction === 'delete')
                        <p>• Data akan dipindahkan ke recycle bin</p>
                    @else
                        <p>• Email notifikasi akan dikirim ke semua pendaftar</p>
                    @endif
                    <p>• Tindakan ini tidak dapat dibatalkan</p>
                </div>
                @endif
            </div>

            <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3">
                <button type="button" wire:click="closeBulkActionModal" class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit" 
                        class="px-4 py-2 text-white rounded-md
                        @if($bulkAction === 'approve') bg-green-600 hover:bg-green-700
                        @elseif($bulkAction === 'reject') bg-red-600 hover:bg-red-700
                        @else bg-gray-600 hover:bg-gray-700 @endif"
                        wire:loading.attr="disabled"
                        @disabled(!$bulkAction)>
                    <span wire:loading.remove>Proses</span>
                    <span wire:loading>Processing...</span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- File Preview Modal --}}
<div x-data="{ showFileModal: false, fileUrl: '', fileType: '', fileName: '' }"
     x-on:preview-file.window="showFileModal = true; fileUrl = $event.detail.url; fileType = $event.detail.type; fileName = $event.detail.name"
     x-show="showFileModal" 
     x-transition.opacity
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75"
     style="display: none;">
    <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-hidden">
        <div class="flex justify-between items-center p-4 border-b">
            <div>
                <h3 class="text-lg font-semibold text-gray-900" x-text="fileName"></h3>
                <p class="text-sm text-gray-500" x-text="fileType.toUpperCase()"></p>
            </div>
            <button @click="showFileModal = false" class="text-gray-400 hover:text-gray-600">
                <span class="material-icons">close</span>
            </button>
        </div>
        <div class="p-4" style="height: calc(90vh - 80px);">
            <template x-if="fileType === 'cv'">
                <iframe :src="fileUrl" class="w-full h-full border-0"></iframe>
            </template>
            <template x-if="fileType !== 'cv'">
                <img :src="fileUrl" :alt="fileName" class="max-w-full max-h-full mx-auto object-contain">
            </template>
        </div>
    </div>
</div>

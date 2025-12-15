<?php

?>
{{-- Detail Modal --}}
<div x-show="$wire.showDetailModal" 
     x-transition.opacity
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4"
     style="display: none;">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-3xl max-h-[85vh] overflow-hidden flex flex-col">
        <div class="sticky top-0 bg-white border-b border-gray-200 px-4 py-3 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Detail Pendaftar</h3>
            <button wire:click="closeDetailModal" class="text-gray-400 hover:text-gray-600 transition-colors">
                <span class="material-icons text-xl">close</span>
            </button>
        </div>

        @if($selectedRecruitment)
        <div class="flex-1 overflow-y-auto p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Personal Info --}}
                <div class="space-y-3">
                    <h4 class="font-semibold text-gray-900 border-b pb-1 text-sm">Informasi Pribadi</h4>
                    
                    <div class="grid grid-cols-1 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Nama Lengkap</label>
                            <p class="mt-0.5 text-sm text-gray-900 font-medium">{{ $selectedRecruitment->nama_lengkap }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">NIM</label>
                            <p class="mt-0.5 text-sm text-gray-900 font-mono">{{ $selectedRecruitment->nim }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-500">Semester</label>
                                <p class="mt-0.5 text-sm text-gray-900">{{ $selectedRecruitment->semester }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500">No HP</label>
                                <p class="mt-0.5 text-sm text-gray-900">{{ $selectedRecruitment->nomor_hp }}</p>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Email Pribadi</label>
                            <p class="mt-0.5 text-sm text-gray-900 truncate">{{ $selectedRecruitment->email_pribadi }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Email Mahasiswa</label>
                            <p class="mt-0.5 text-sm text-gray-900 truncate">{{ $selectedRecruitment->email_mahasiswa }}</p>
                        </div>
                    </div>

                    {{-- Division Info --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500">Divisi Utama</label>
                        <p class="mt-0.5 text-sm text-gray-900 font-medium">{{ $selectedRecruitment->divisi_utama }}</p>
                    </div>
                    @if($selectedRecruitment->divisi_tambahan)
                    <div>
                        <label class="block text-xs font-medium text-gray-500">Divisi Tambahan</label>
                        <p class="mt-0.5 text-sm text-gray-900">{{ $selectedRecruitment->divisi_tambahan }}</p>
                    </div>
                    @endif

                    {{-- Portfolio - Fixed URL --}}
                    @if($selectedRecruitment->portofolio)
                    <div>
                        <label class="block text-xs font-medium text-gray-500">Portfolio</label>
                        <a href="{{ asset('storage/' . $selectedRecruitment->portofolio) }}" 
                           target="_blank" 
                           class="mt-0.5 inline-flex items-center text-sm text-primary hover:text-primary/80 transition-colors">
                            <span class="material-icons mr-1 text-base">open_in_new</span>
                            Lihat Portfolio
                        </a>
                    </div>
                    @endif

                    {{-- Instagram --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500">Username Instagram</label>
                        <p class="mt-0.5 text-sm text-gray-900">{{ $selectedRecruitment->username_instagram }}</p>
                    </div>
                </div>

                {{-- Files & Status --}}
                <div class="space-y-3">
                    <h4 class="font-semibold text-gray-900 border-b pb-1 text-sm">Dokumen & Status</h4>
                    
                    {{-- Files - Fixed Preview --}}
                    <div class="space-y-2">
                        <div>
                            <label class="block text-xs font-medium text-gray-500">CV</label>
                            @if($selectedRecruitment->cv)
                                <div class="mt-0.5 flex flex-wrap gap-2">
                                    <!-- <button onclick="previewFile('{{ asset('storage/' . $selectedRecruitment->cv) }}', 'cv', '{{ basename($selectedRecruitment->cv) }}')"
                                            class="inline-flex items-center text-xs text-primary hover:text-primary/80 transition-colors">
                                        <span class="material-icons mr-1 text-sm">visibility</span>
                                        Preview CV
                                    </button> -->
                                    <a href="{{ asset('storage/' . $selectedRecruitment->cv) }}" 
                                       target="_blank"
                                       class="mt-0.5 inline-flex items-center text-sm text-primary hover:text-primary/80 transition-colors">
                                        <span class="material-icons mr-1 text-sm">open_in_new</span>
                                        lihat cv
                                    </a>
                                </div>
                            @else
                                <p class="mt-0.5 text-xs text-gray-400">Tidak ada CV</p>
                            @endif
                        </div>
                        
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Bukti Follow Instagram</label>
                            @if($selectedRecruitment->bukti_follow_instagram)
                                <div class="mt-0.5 flex flex-wrap gap-2">
                                    <!-- <button onclick="previewFile('{{ asset('storage/' . $selectedRecruitment->bukti_follow_instagram) }}', 'image', '{{ basename($selectedRecruitment->bukti_follow_instagram) }}')"
                                            class="inline-flex items-center text-xs text-primary hover:text-primary/80 transition-colors">
                                        <span class="material-icons mr-1 text-sm">visibility</span>
                                        Preview Gambar
                                    </button> -->
                                    <a href="{{ asset('storage/' . $selectedRecruitment->bukti_follow_instagram) }}" 
                                       target="_blank"
                                        class="mt-0.5 inline-flex items-center text-sm text-primary hover:text-primary/80 transition-colors">                                        <span class="material-icons mr-1 text-sm">open_in_new</span>
                                        lihat lihat bukti instagram
                                    </a>
                                </div>
                            @else
                                <p class="mt-0.5 text-xs text-gray-400">Tidak ada bukti</p>
                            @endif
                        </div>
                        
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Bukti Follow LinkedIn</label>
                            @if($selectedRecruitment->bukti_follow_linkedin)
                                <div class="mt-0.5 flex flex-wrap gap-2">
                                    <!-- <button onclick="previewFile('{{ asset('storage/' . $selectedRecruitment->bukti_follow_linkedin) }}', 'image', '{{ basename($selectedRecruitment->bukti_follow_linkedin) }}')"
                                            class="inline-flex items-center text-xs text-primary hover:text-primary/80 transition-colors">
                                        <span class="material-icons mr-1 text-sm">visibility</span>
                                        Preview Gambar
                                    </button> -->
                                    <a href="{{ asset('storage/' . $selectedRecruitment->bukti_follow_linkedin) }}" 
                                       target="_blank"
                                        class="mt-0.5 inline-flex items-center text-sm text-primary hover:text-primary/80 transition-colors">                                        <span class="material-icons mr-1 text-sm">open_in_new</span>
                                        lihat bukti linkedin
                                    </a>
                                </div>
                            @else
                                <p class="mt-0.5 text-xs text-gray-400">Tidak ada bukti</p>
                            @endif
                        </div>
                    </div>

                    {{-- Status Info --}}
                    <div class="bg-gray-50 rounded-lg p-3 mt-2">
                        <div class="space-y-2">
                            <div>
                                <label class="block text-xs font-medium text-gray-500">Status</label>
                                <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full mt-0.5
                                    @if($selectedRecruitment->status === 'approved') bg-green-100 text-green-800
                                    @elseif($selectedRecruitment->status === 'rejected') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800 @endif
                                ">
                                    {{ $selectedRecruitment->status_label }}
                                </span>
                            </div>
                            
                            @if($selectedRecruitment->reviewed_by)
                            <div>
                                <label class="block text-xs font-medium text-gray-500">Direview oleh</label>
                                <p class="mt-0.5 text-sm text-gray-900">{{ $selectedRecruitment->reviewer->name }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-500">Tanggal Review</label>
                                <p class="mt-0.5 text-sm text-gray-900">{{ $selectedRecruitment->reviewed_at->format('d/m/Y H:i') }}</p>
                            </div>
                            @endif
                            
                            @if($selectedRecruitment->catatan)
                            <div>
                                <label class="block text-xs font-medium text-gray-500">Catatan</label>
                                <p class="mt-0.5 text-sm text-gray-900 bg-white p-2 rounded border text-xs">{{ $selectedRecruitment->catatan }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Timestamps --}}
                    <div class="text-xs text-gray-500 space-y-0.5 mt-2">
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
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4"
     style="display: none;">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="px-4 py-3 border-b border-gray-200">
            <h3 class="text-base font-semibold text-gray-900">
                {{ $reviewAction === 'approve' ? 'Terima Pendaftar' : 'Tolak Pendaftar' }}
            </h3>
        </div>

        <form wire:submit="submitReview">
            <div class="p-4">
                @if($selectedRecruitment)
                <div class="mb-3">
                    <p class="text-sm text-gray-600">Anda akan 
                        <span class="font-semibold {{ $reviewAction === 'approve' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $reviewAction === 'approve' ? 'menerima' : 'menolak' }}
                        </span> 
                        pendaftar:
                    </p>
                    <p class="font-medium text-gray-900 mt-0.5 text-sm">{{ $selectedRecruitment->nama_lengkap }}</p>
                    <p class="text-xs text-gray-500">{{ $selectedRecruitment->divisi_utama }}</p>
                </div>
                @endif

                <div class="mb-3">
                    <label class="block text-xs font-medium text-gray-700 mb-1">
                        Catatan {{ $reviewAction === 'reject' ? '(Wajib)' : '(Opsional)' }}
                    </label>
                    <textarea wire:model="reviewNote" 
                              rows="3" 
                              class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary"
                              placeholder="{{ $reviewAction === 'approve' ? 'Selamat! Anda diterima di...' : 'Alasan penolakan...' }}"></textarea>
                    @error('reviewNote')
                        <p class="text-xs text-red-600 mt-0.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-xs text-gray-500">
                    <p>• Email notifikasi akan dikirim otomatis ke pendaftar</p>
                    <p>• Tindakan ini tidak dapat dibatalkan</p>
                </div>
            </div>

            <div class="px-4 py-3 bg-gray-50 flex justify-end space-x-2">
                <button type="button" wire:click="closeReviewModal" class="px-3 py-1.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button type="submit" 
                        class="px-3 py-1.5 text-sm text-white rounded-md {{ $reviewAction === 'approve' ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }} transition-colors"
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
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4"
     style="display: none;">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="px-4 py-3 border-b border-gray-200">
            <h3 class="text-base font-semibold text-gray-900">Hapus Data</h3>
        </div>

        <div class="p-4">
            @if($selectedRecruitment)
            <div class="flex items-start mb-3">
                <span class="material-icons text-red-500 mr-2 text-lg">warning</span>
                <div>
                    <p class="text-sm text-gray-600">Anda akan menghapus data pendaftar:</p>
                    <p class="font-medium text-gray-900 text-sm">{{ $selectedRecruitment->nama_lengkap }}</p>
                    <p class="text-xs text-gray-500">{{ $selectedRecruitment->nim }}</p>
                </div>
            </div>
            @endif

            <div class="bg-yellow-50 border border-yellow-200 rounded-md p-2 text-xs">
                <p class="text-yellow-800">Data akan dipindahkan ke recycle bin dan dapat dipulihkan kembali.</p>
            </div>
        </div>

        <div class="px-4 py-3 bg-gray-50 flex justify-end space-x-2">
            <button wire:click="closeDeleteModal" class="px-3 py-1.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">
                Batal
            </button>
            <button wire:click="deleteRecruitment" 
                    class="px-3 py-1.5 text-sm bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors"
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
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4"
     style="display: none;">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="px-4 py-3 border-b border-gray-200">
            <h3 class="text-base font-semibold text-gray-900">Bulk Action</h3>
        </div>

        <form wire:submit="submitBulkAction">
            <div class="p-4">
                <div class="mb-3">
                    <p class="text-sm text-gray-600 mb-1">
                        {{ count($selectedIds) }} data akan diproses
                    </p>
                </div>

                <div class="mb-3">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Pilih Aksi</label>
                    <select wire:model.live="bulkAction" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="">-- Pilih Aksi --</option>
                        <option value="approve">Terima Semua</option>
                        <option value="reject">Tolak Semua</option>
                        <option value="delete">Hapus Semua</option>
                    </select>
                    @error('bulkAction')
                        <p class="text-xs text-red-600 mt-0.5">{{ $message }}</p>
                    @enderror
                </div>

                @if(in_array($bulkAction, ['approve', 'reject']))
                <div class="mb-3">
                    <label class="block text-xs font-medium text-gray-700 mb-1">
                        Catatan {{ $bulkAction === 'reject' ? '(Wajib)' : '(Opsional)' }}
                    </label>
                    <textarea wire:model="bulkNote" 
                              rows="3" 
                              class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary"
                              placeholder="Catatan untuk semua data yang dipilih..."></textarea>
                    @error('bulkNote')
                        <p class="text-xs text-red-600 mt-0.5">{{ $message }}</p>
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

            <div class="px-4 py-3 bg-gray-50 flex justify-end space-x-2">
                <button type="button" wire:click="closeBulkActionModal" class="px-3 py-1.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button type="submit" 
                        class="px-3 py-1.5 text-sm text-white rounded-md
                        @if($bulkAction === 'approve') bg-green-600 hover:bg-green-700
                        @elseif($bulkAction === 'reject') bg-red-600 hover:bg-red-700
                        @else bg-gray-600 hover:bg-gray-700 @endif transition-colors"
                        wire:loading.attr="disabled"
                        @disabled(!$bulkAction)>
                    <span wire:loading.remove>Proses</span>
                    <span wire:loading>Processing...</span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- File Preview Modal - Fixed and Improved --}}
<div id="filePreviewModal" 
     class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black bg-opacity-80 p-2"
     onclick="closeFilePreview(event)">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl max-h-[95vh] overflow-hidden relative" 
         onclick="event.stopPropagation()">
         
        {{-- Sticky Header --}}
        <div class="sticky top-0 flex justify-between items-center p-3 border-b bg-white shadow-sm z-10">
            <div class="flex-1">
                <h3 id="fileName" class="text-base font-semibold text-gray-900 truncate pr-4"></h3>
                <p id="fileType" class="text-xs text-gray-500 font-medium"></p>
            </div>
            <div class="flex items-center space-x-1 ml-3">
                <a id="downloadBtn" 
                   href="#" 
                   download
                   class="inline-flex items-center px-2 py-1.5 text-xs font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200"
                   title="Download File">
                    <span class="material-icons text-xs mr-1">download</span>
                    Download
                </a>
                <button onclick="closeFilePreview()" 
                        class="inline-flex items-center justify-center w-8 h-8 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200"
                        title="Tutup Preview">
                    <span class="material-icons text-lg">close</span>
                </button>
            </div>
        </div>
        
        {{-- Content Area --}}
        <div id="fileContent" class="relative bg-gray-50" style="height: calc(95vh - 80px);">
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-gray-500">
                    <div class="animate-spin w-6 h-6 border-2 border-gray-300 border-t-blue-500 rounded-full mx-auto mb-2"></div>
                    <p class="text-xs">Memuat file...</p>
                </div>
            </div>
        </div>
        
        {{-- Loading Overlay --}}
        <div id="loadingOverlay" class="absolute inset-0 bg-white bg-opacity-90 flex items-center justify-center hidden">
            <div class="text-center">
                <div class="animate-spin w-8 h-8 border-2 border-gray-300 border-t-blue-500 rounded-full mx-auto mb-2"></div>
                <p class="text-gray-600 text-sm">Memuat preview...</p>
            </div>
        </div>
    </div>
</div>
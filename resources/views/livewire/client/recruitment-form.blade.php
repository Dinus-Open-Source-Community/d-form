<div>
    <div class="mx-auto max-w-7xl">
        <div class="relative overflow-hidden rounded-3xl border border-gray-200/50 bg-white p-6 shadow-xl sm:p-8">
            <div class="mb-6 flex justify-center text-lg font-bold text-gray-700">
                <p>FORM REGISTRASI</p>
            </div>

            {{-- field form --}}
            <form wire:submit.prevent="submit" enctype="multipart/form-data">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2" x-data="{
                    divisiUtama: @entangle('divisi_utama'),
                    divisiTambahan: @entangle('divisi_tambahan'),
                }" x-init="$watch('divisiUtama', value => {
                    if (divisiTambahan === value) {
                        divisiTambahan = '';
                    }
                })">
                    {{-- Nama Lengkap --}}
                    <div class="relative">
                        <label class="mb-1 block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <div class="relative">
                            <span
                                class="material-icons absolute left-3 top-1/2 -translate-y-1/2 transform text-lg text-gray-400">person</span>
                            <input
                                class="focus:ring-primary focus:border-primary w-full rounded-lg border border-gray-200 py-2.5 pl-10 pr-4 text-gray-900 placeholder-gray-400 transition duration-200 focus:ring-2"
                                type="text" wire:model="nama_lengkap" placeholder="Elsandro Revalito" />
                        </div>
                        @error('nama_lengkap')
                            <span class="mt-1 block text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- NIM --}}
                    <div class="relative">
                        <label class="mb-1 block text-sm font-medium text-gray-700">NIM</label>
                        <div class="relative">
                            <span
                                class="material-icons absolute left-3 top-1/2 -translate-y-1/2 transform text-lg text-gray-400">badge</span>
                            <input
                                class="focus:ring-primary focus:border-primary w-full rounded-lg border border-gray-200 py-2.5 pl-10 pr-4 text-gray-900 placeholder-gray-400 transition duration-200 focus:ring-2"
                                type="text" wire:model="nim" placeholder="A11.2025.12345" />
                        </div>
                        @error('nim')
                            <span class="mt-1 block text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Semester --}}
                    <div class="relative">
                        <label class="mb-1 block text-sm font-medium text-gray-700">Semester</label>
                        <div class="flex items-center gap-6 py-2.5 pl-2">
                            <label class="inline-flex cursor-pointer items-center">
                                <input class="form-radio text-primary focus:ring-primary" name="semester" type="radio"
                                    value="1" wire:model="semester">
                                <span class="ml-2 text-gray-700">Semester 1</span>
                            </label>
                            <label class="inline-flex cursor-pointer items-center">
                                <input class="form-radio text-primary focus:ring-primary" name="semester" type="radio"
                                    value="3" wire:model="semester">
                                <span class="ml-2 text-gray-700">Semester 3</span>
                            </label>
                        </div>
                        @error('semester')
                            <span class="mt-1 block text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- nomor WhatsApp --}}
                    <div class="relative">
                        <label class="mb-1 block text-sm font-medium text-gray-700">Nomor WhatsApp</label>
                        <div class="relative">
                            <span
                                class="material-icons absolute left-3 top-1/2 -translate-y-1/2 transform text-lg text-gray-400">phone</span>
                            <input
                                class="focus:ring-primary focus:border-primary no-spinner w-full rounded-lg border border-gray-200 py-2.5 pl-10 pr-4 text-gray-900 placeholder-gray-400 transition duration-200 focus:ring-2"
                                type="number" wire:model="nomor_hp" placeholder="081234567890" />
                        </div>
                        @error('nomor_hp')
                            <span class="mt-1 block text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- email mahasiswa --}}
                    <div class="relative">
                        <label class="mb-1 block text-sm font-medium text-gray-700">Email Mahasiswa</label>
                        <div class="relative">
                            <span
                                class="material-icons absolute left-3 top-1/2 -translate-y-1/2 transform text-lg text-gray-400">school</span>
                            <input
                                class="focus:ring-primary focus:border-primary w-full rounded-lg border border-gray-200 py-2.5 pl-10 pr-4 text-gray-900 placeholder-gray-400 transition duration-200 focus:ring-2"
                                type="text" wire:model="email_mahasiswa"
                                placeholder="111202512345@mhs.dinus.ac.id" />
                        </div>
                        @error('email_mahasiswa')
                            <span class="mt-1 block text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- email pribadi --}}
                    <div class="relative">
                        <label class="mb-1 block text-sm font-medium text-gray-700">Email Pribadi</label>
                        <div class="relative">
                            <span
                                class="material-icons absolute left-3 top-1/2 -translate-y-1/2 transform text-lg text-gray-400">email</span>
                            <input
                                class="focus:ring-primary focus:border-primary w-full rounded-lg border border-gray-200 py-2.5 pl-10 pr-4 text-gray-900 placeholder-gray-400 transition duration-200 focus:ring-2"
                                type="text" wire:model="email_pribadi" placeholder="example@gmail.com" />
                        </div>
                        @error('email_pribadi')
                            <span class="mt-1 block text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- divisi utama --}}
                    <div class="relative">
                        <label class="mb-1 block text-sm font-medium text-gray-700">Divisi Pilihan Pertama</label>
                        <div class="grid grid-cols-2 gap-6 pl-2 lg:grid-cols-4">
                            <label class="inline-flex cursor-pointer items-center">
                                <input class="form-radio text-primary focus:ring-primary" name="divisi_utama"
                                    type="radio" value="Pemrograman" x-model="divisiUtama">
                                <span class="ml-2 text-gray-700">Pemrograman</span>
                            </label>
                            <label class="inline-flex cursor-pointer items-center">
                                <input class="form-radio text-primary focus:ring-primary" name="divisi_utama"
                                    type="radio" value="Jaringan" x-model="divisiUtama">
                                <span class="ml-2 text-gray-700">Jaringan</span>
                            </label>
                            <label class="inline-flex cursor-pointer items-center">
                                <input class="form-radio text-primary focus:ring-primary" name="divisi_utama"
                                    type="radio" value="Medcrev" x-model="divisiUtama">
                                <span class="ml-2 text-gray-700">Medcrev</span>
                            </label>
                            <label class="inline-flex cursor-pointer items-center">
                                <input class="form-radio text-primary focus:ring-primary" name="divisi_utama"
                                    type="radio" value="Data" x-model="divisiUtama">
                                <span class="ml-2 text-gray-700">Data</span>
                            </label>
                        </div>
                        @error('divisi_utama')
                            <span class="mt-1 block text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- divisi pilihan --}}
                    <div class="relative">
                        <label class="mb-1 block text-sm font-medium text-gray-700">Divisi Pilihan Kedua</label>
                        <div class="grid grid-cols-2 gap-6 pl-2 lg:grid-cols-4">
                            <template x-for="divisi in ['Pemrograman', 'Jaringan', 'Medcrev', 'Data']"
                                :key="divisi">
                                <label class="inline-flex cursor-pointer items-center">
                                    <input class="form-radio text-primary focus:ring-primary" name="divisi_tambahan"
                                        type="radio" :value="divisi" x-model="divisiTambahan"
                                        :disabled="divisiUtama === divisi">
                                    <span class="ml-2 text-gray-700"
                                        :class="(divisiUtama === divisi) ? 'opacity-50' : ''" x-text="divisi"></span>
                                </label>
                            </template>
                        </div>
                        @error('divisi_tambahan')
                            <span class="mt-1 block text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- cv --}}
                    <div class="relative">
                        <label class="mb-1 block text-sm font-medium text-gray-700">CV</label>
                        <div class="relative" x-data="{ fileName: '' }">
                            <div
                                class="focus-within:ring-primary flex w-full overflow-hidden rounded-lg border border-gray-200 bg-white py-0.5 focus-within:ring-2">
                                <label
                                    class="flex cursor-pointer items-center bg-gray-50 px-4 py-2 transition-colors hover:bg-gray-100">
                                    <span class="material-icons text-lg text-gray-400">description</span>
                                    <span class="font-medium text-gray-400">Pilih File</span>
                                    <input class="hidden" type="file" wire:model="cv"
                                        @change="fileName = $event.target.files[0]?.name || ''">
                                </label>
                                <div class="flex min-w-0 flex-1 items-center border-l border-gray-200 px-4">
                                    <span class="truncate text-gray-700"
                                        x-text="fileName || 'Belum ada file dipilih'">Belum ada file dipilih</span>
                                </div>
                            </div>
                        </div>
                        @error('cv')
                            <span class="mt-1 block text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- portofolio --}}
                    <div class="relative">
                        <label class="mb-1 block text-sm font-medium text-gray-700">Portofolio</label>
                        <div class="relative" x-data="{ fileName: '' }">
                            <div
                                class="focus-within:ring-primary flex w-full overflow-hidden rounded-lg border border-gray-200 bg-white py-0.5 focus-within:ring-2">
                                <label
                                    class="flex cursor-pointer items-center bg-gray-50 px-4 py-2 transition-colors hover:bg-gray-100">
                                    <span class="material-icons text-lg text-gray-400">description</span>
                                    <span class="font-medium text-gray-400">Pilih File</span>
                                    <input class="hidden" type="file" wire:model="portofolio"
                                        @change="fileName = $event.target.files[0]?.name || ''">
                                </label>
                                <div class="flex min-w-0 flex-1 items-center border-l border-gray-200 px-4">
                                    <span class="truncate text-gray-700"
                                        x-text="fileName || 'Belum ada file dipilih'">Belum ada file dipilih</span>
                                </div>
                            </div>
                        </div>
                        @error('portofolio')
                            <span class="mt-1 block text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex w-full flex-col-reverse justify-between gap-3 lg:flex-row">
                        {{-- bukti follow instagram --}}
                        <div class="relative w-full lg:w-3/5">
                            <label class="mb-1 block text-sm font-medium text-gray-700">Bukti Follow Instagram</label>
                            <div class="relative" x-data="{ fileName: '' }">
                                <div
                                    class="focus-within:ring-primary flex w-full overflow-hidden rounded-lg border border-gray-200 bg-white py-0.5 focus-within:ring-2">
                                    <label
                                        class="flex cursor-pointer items-center bg-gray-50 px-4 py-2 transition-colors hover:bg-gray-100">
                                        <span class="material-icons text-lg text-gray-400">description</span>
                                        <span class="font-medium text-gray-400">Pilih File</span>
                                        <input class="hidden" type="file" wire:model="bukti_follow_instagram"
                                            @change="fileName = $event.target.files[0]?.name || ''">
                                    </label>
                                    <div class="flex min-w-0 flex-1 items-center border-l border-gray-200 px-4">
                                        <span class="truncate text-gray-700"
                                            x-text="fileName || 'Belum ada file dipilih'">Belum ada file dipilih</span>
                                    </div>
                                </div>
                            </div>
                            @error('bukti_follow_instagram')
                                <span class="mt-1 block text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- username instagram --}}
                        <div class="relative w-full lg:w-2/5">
                            <label class="mb-1 block text-sm font-medium text-gray-700">Username Instagram</label>
                            <div class="relative">
                                <span
                                    class="material-icons absolute left-3 top-1/2 -translate-y-1/2 transform text-lg text-gray-400">alternate_email</span>
                                <input
                                    class="focus:ring-primary focus:border-primary w-full rounded-lg border border-gray-200 py-2.5 pl-10 pr-4 text-gray-900 placeholder-gray-400 transition duration-200 focus:ring-2"
                                    type="text" wire:model="username_instagram" placeholder="sndro_" />
                            </div>
                            @error('username_instagram')
                                <span class="mt-1 block text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- bukti follow linkedin --}}
                    <div class="relative">
                        <label class="mb-1 block text-sm font-medium text-gray-700">Bukti Follow LinkedIn</label>
                        <div class="relative" x-data="{ fileName: '' }">
                            <div
                                class="focus-within:ring-primary flex w-full overflow-hidden rounded-lg border border-gray-200 bg-white py-0.5 focus-within:ring-2">
                                <label
                                    class="flex cursor-pointer items-center bg-gray-50 px-4 py-2 transition-colors hover:bg-gray-100">
                                    <span class="material-icons text-lg text-gray-400">description</span>
                                    <span class="font-medium text-gray-400">Pilih File</span>
                                    <input class="hidden" type="file" wire:model="bukti_follow_linkedin"
                                        @change="fileName = $event.target.files[0]?.name || ''">
                                </label>
                                <div class="flex min-w-0 flex-1 items-center border-l border-gray-200 px-4">
                                    <span class="truncate text-gray-700"
                                        x-text="fileName || 'Belum ada file dipilih'">Belum ada file dipilih</span>
                                </div>
                            </div>
                        </div>
                        @error('bukti_follow_linkedin')
                            <span class="mt-1 block text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-4 md:col-span-2">

                        <!-- Modal -->
                        <div x-data="{ showEditModal: false }" x-cloak>
                            <!-- Edit Button triggers modal -->
                            <button
                                class="rounded-lg border border-gray-300 px-6 py-2 text-sm font-semibold text-gray-700 transition duration-200 hover:bg-gray-100"
                                type="button" @click="showEditModal = true">
                                Edit
                            </button>

                            <!-- Modal Overlay -->
                            <div class="fixed inset-0 z-40 flex items-center justify-center bg-white/50 backdrop-blur-sm"
                                x-show="showEditModal" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                @click.self="showEditModal = false">
                                <!-- Modal Content -->
                                <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-xl"
                                    x-transition:enter="transition ease-out duration-200 transform"
                                    x-transition:enter-start="scale-95 opacity-0"
                                    x-transition:enter-end="scale-100 opacity-100"
                                    x-transition:leave="transition ease-in duration-150 transform"
                                    x-transition:leave-start="scale-100 opacity-100"
                                    x-transition:leave-end="scale-95 opacity-0">
                                    <div class="mb-4 flex items-center justify-between">
                                        <h2 class="text-lg font-semibold text-gray-700">Edit Data</h2>
                                        <button class="text-gray-400 hover:text-gray-600"
                                            @click="showEditModal = false">
                                            <span class="material-icons">close</span>
                                        </button>
                                    </div>
                                    <!-- Modal Body -->
                                    {{-- Input Short UUID untuk Edit --}}
                                    <div class="mb-6 flex items-center justify-center gap-2">
                                        <input
                                            class="focus:border-primary focus:ring-primary w-64 rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2"
                                            type="text" x-data wire:model.defer="input_short_uuid"
                                            placeholder="Masukkan kode edit" />

                                    </div>
                                    @if ($short_uuid_error)
                                        <div class="mb-4 text-center text-sm text-red-500">{{ $short_uuid_error }}
                                        </div>
                                    @endif
                                    <div class="mt-6 flex justify-center gap-3">
                                        <button
                                            class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-100"
                                            @click="showEditModal = false">
                                            Tutup
                                        </button>
                                        <button
                                            class="bg-primary rounded-lg px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#3B5C80]"
                                            wire:click="checkShortUuid">
                                            Edit Recruitment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button
                            class="bg-primary focus:ring-primary/30 rounded-lg px-6 py-2 text-sm font-semibold text-white transition duration-200 hover:bg-[#3B5C80] focus:ring-2"
                            type="submit" wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                            wire:loading.class.remove="hover:bg-[#3B5C80]">
                            <span wire:loading.remove wire:target="submit">Upload</span>
                            <span class="animate-pulse" wire:loading wire:target="submit">Uploading...</span>
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <!-- Overlay loading saat update -->
    <div class="fixed inset-0 z-50 flex h-screen items-center justify-center bg-black/40 backdrop-blur-sm"
        wire:loading.delay.longest wire:target="submit">
        <div>
            <div class="flex h-full flex-col items-center">
                <x-spinner />
                <span class="text-lg font-semibold text-white">Mengupload...</span>
            </div>
        </div>
    </div>
</div>

<div class="flex min-h-screen flex-col bg-gray-50">
    {{-- Main content --}}
    <div class="flex flex-1 flex-col items-center justify-center px-2 py-6">
        <div class="mx-auto mt-4 w-full max-w-7xl rounded-xl bg-white p-4 shadow-lg md:mt-12 md:p-8">
            <h2 class="mb-4 flex items-center text-xl font-bold text-gray-800 md:mb-6 md:text-2xl">
                {{-- <span class="material-icons mr-2 text-blue-500">download</span> --}}
                Daftar Recruitment Member
            </h2>

            <div class="flex items-center justify-between">
                <p>Jumlah Pendaftar: <span>{{ $recruitments->total() }}</span></p>

                {{-- Export Button --}}
                <div class="mb-4 flex flex-col justify-end md:flex-row">
                    <button
                        class="bg-primary flex items-center rounded-lg px-4 py-2 font-semibold text-white transition-colors duration-200 hover:bg-blue-700 md:px-6"
                        wire:click="exportCsv">
                        <span class="material-icons mr-2">file_download</span>
                        Download CSV
                    </button>
                </div>
            </div>

            {{-- Recruitment Table --}}
            <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white">
                <table
                    class="w-full min-w-[900px] border-collapse overflow-hidden rounded-lg bg-white text-xs text-black shadow-md md:text-sm">
                    <thead>
                        <tr class="bg-gray-100 text-left text-gray-700">
                            <th class="border-b px-3 py-3 md:px-4">ID</th>
                            <th class="border-b px-3 py-3 md:px-4">Short UUID</th>
                            <th class="border-b px-3 py-3 md:px-4">Nama Lengkap</th>
                            <th class="border-b px-3 py-3 md:px-4">NIM</th>
                            <th class="border-b px-3 py-3 md:px-4">Semester</th>
                            <th class="border-b px-3 py-3 md:px-4">Nomor HP</th>
                            <th class="border-b px-3 py-3 md:px-4">Email Pribadi</th>
                            <th class="border-b px-3 py-3 md:px-4">Email Mahasiswa</th>
                            <th class="border-b px-3 py-3 md:px-4">Divisi Utama</th>
                            <th class="border-b px-3 py-3 md:px-4">Divisi Tambahan</th>
                            <th class="border-b px-3 py-3 md:px-4">Username IG</th>
                            <th class="border-b px-3 py-3 md:px-4">Tanggal Daftar</th>
                            <th class="border-b px-3 py-3 md:px-4">CV</th>
                            <th class="border-b px-3 py-3 md:px-4">Portofolio</th>
                            <th class="border-b px-3 py-3 md:px-4">Bukti Follow IG</th>
                            <th class="border-b px-3 py-3 md:px-4">Bukti Follow LinkedIn</th>
                            <th class="border-b px-3 py-3 md:px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($recruitments as $item)
                            <tr class="transition hover:bg-gray-50">
                                <td class="px-3 py-2 md:px-4">{{ $item->id }}</td>
                                <td class="px-3 py-2 md:px-4">{{ $item->short_uuid }}</td>
                                <td class="whitespace-nowrap px-3 py-2 md:px-4">{{ $item->nama_lengkap }}</td>
                                <td class="px-3 py-2 md:px-4">{{ $item->nim }}</td>
                                <td class="px-3 py-2 md:px-4">{{ $item->semester }}</td>
                                <td class="px-3 py-2 md:px-4">{{ $item->nomor_hp }}</td>
                                <td class="px-3 py-2 md:px-4">{{ $item->email_pribadi }}</td>
                                <td class="px-3 py-2 md:px-4">{{ $item->email_mahasiswa }}</td>
                                <td class="px-3 py-2 md:px-4">{{ $item->divisi_utama }}</td>
                                <td class="px-3 py-2 md:px-4">
                                    @if (is_array($item->divisi_tambahan))
                                        {{ implode(', ', $item->divisi_tambahan) }}
                                    @else
                                        {{ $item->divisi_tambahan }}
                                    @endif
                                </td>
                                <td class="px-3 py-2 md:px-4">{{ $item->username_instagram }}</td>
                                <td class="whitespace-nowrap px-3 py-2 md:px-4">
                                    {{ $item->created_at->format('d-m-Y') }}</td>
                                <td class="px-3 py-2 text-center md:px-4">
                                    @if ($item->cv)
                                        <a class="text-gray-600 hover:text-gray-800"
                                            href="{{ Storage::url($item->cv) }}" target="_blank">
                                            <span class="material-icons align-middle">visibility</span>
                                        </a>
                                    @endif
                                </td>
                                <td class="px-3 py-2 text-center md:px-4">
                                    @if ($item->portofolio)
                                        <a class="text-gray-600 hover:text-gray-800"
                                            href="{{ Storage::url($item->portofolio) }}" target="_blank">
                                            <span class="material-icons align-middle">visibility</span>
                                        </a>
                                    @endif
                                </td>
                                <td class="px-3 py-2 text-center md:px-4">
                                    @if ($item->bukti_follow_instagram)
                                        <a class="text-gray-600 hover:text-gray-800"
                                            href="{{ Storage::url($item->bukti_follow_instagram) }}" target="_blank">
                                            <span class="material-icons align-middle">visibility</span>
                                        </a>
                                    @endif
                                </td>
                                <td class="px-3 py-2 text-center md:px-4">
                                    @if ($item->bukti_follow_linkedin)
                                        <a class="text-gray-600 hover:text-gray-800"
                                            href="{{ Storage::url($item->bukti_follow_linkedin) }}" target="_blank">
                                            <span class="material-icons align-middle">visibility</span>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <button
                                        class="flex cursor-pointer items-center justify-center px-2 py-2 text-gray-600 transition duration-200 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50"
                                        type="button" title="Kirim Email"
                                        wire:click="sendGroupInvite({{ $item->id }})" wire:loading.attr="disabled"
                                        wire:target="sendGroupInvite({{ $item->id }})">
                                        <span class="material-icons" wire:loading.remove
                                            wire:target="sendGroupInvite({{ $item->id }})">send</span>
                                        <span class="material-icons animate-spin" wire:loading
                                            wire:target="sendGroupInvite({{ $item->id }})">autorenew</span>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="py-4 text-center text-gray-500" colspan="17">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="fixed inset-0 z-50 items-center justify-center bg-black/30" wire:loading.flex
                    wire:target="sendGroupInvite">
                    <div class="rounded-lg bg-white px-6 py-4 text-center opacity-100 shadow-md">
                        <span class="material-icons text-primary mb-2 animate-spin text-4xl">autorenew</span>
                        <p class="font-semibold text-gray-700">Mengirim email...</p>
                    </div>
                </div>
                @if (session('success'))
                    <div class="fixed bottom-5 right-5 rounded-lg bg-green-500 px-4 py-2 text-white shadow-md"
                        x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            {{-- Pagination (jika pakai pagination) --}}
            <div class="mt-4">
                {{ $recruitments->links() }}
            </div>
        </div>
    </div>
</div>

<div class="flex flex-col min-h-screen bg-gray-50">
    {{-- Main content --}}
    <div class="flex-1 flex flex-col items-center justify-center py-6 px-2">
        <div class="bg-white rounded-xl shadow-lg p-4 md:p-8 w-full max-w-7xl mx-auto mt-4 md:mt-12">
            <h2 class="text-xl md:text-2xl font-bold mb-4 md:mb-6 text-gray-800 flex items-center">
                <span class="material-icons mr-2 text-blue-500">download</span>
                Export Recruitment Data
            </h2>

            {{-- Export Button --}}
            <div class="mb-4 flex flex-col md:flex-row justify-end">
                <button wire:click="exportCsv"
                    class="bg-primary hover:bg-blue-700 text-white font-semibold py-2 px-4 md:px-6 rounded-lg flex items-center transition-colors duration-200">
                    <span class="material-icons mr-2">file_download</span>
                    Download CSV
                </button>
            </div>

            {{-- Recruitment Table --}}
            <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white">
                <table class="min-w-[900px] w-full bg-white text-black text-xs md:text-sm">
                    <thead>
                        <tr>
                            <th class="py-2 px-2 md:px-4 border-b">ID</th>
                            <th class="py-2 px-2 md:px-4 border-b">Short UUID</th>
                            <th class="py-2 px-2 md:px-4 border-b">Nama Lengkap</th>
                            <th class="py-2 px-2 md:px-4 border-b">NIM</th>
                            <th class="py-2 px-2 md:px-4 border-b">Semester</th>
                            <th class="py-2 px-2 md:px-4 border-b">Nomor HP</th>
                            <th class="py-2 px-2 md:px-4 border-b">Email Pribadi</th>
                            <th class="py-2 px-2 md:px-4 border-b">Email Mahasiswa</th>
                            <th class="py-2 px-2 md:px-4 border-b">Divisi Utama</th>
                            <th class="py-2 px-2 md:px-4 border-b">Divisi Tambahan</th>
                            <th class="py-2 px-2 md:px-4 border-b">CV</th>
                            <th class="py-2 px-2 md:px-4 border-b">Portofolio</th>
                            <th class="py-2 px-2 md:px-4 border-b">Bukti Follow IG</th>
                            <th class="py-2 px-2 md:px-4 border-b">Bukti Follow LinkedIn</th>
                            <th class="py-2 px-2 md:px-4 border-b">Username IG</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recruitments as $item)
                            <tr>
                                <td class="py-2 px-2 md:px-4 border-b">{{ $item->id }}</td>
                                <td class="py-2 px-2 md:px-4 border-b">{{ $item->short_uuid }}</td>
                                <td class="py-2 px-2 md:px-4 border-b">{{ $item->nama_lengkap }}</td>
                                <td class="py-2 px-2 md:px-4 border-b">{{ $item->nim }}</td>
                                <td class="py-2 px-2 md:px-4 border-b">{{ $item->semester }}</td>
                                <td class="py-2 px-2 md:px-4 border-b">{{ $item->nomor_hp }}</td>
                                <td class="py-2 px-2 md:px-4 border-b">{{ $item->email_pribadi }}</td>
                                <td class="py-2 px-2 md:px-4 border-b">{{ $item->email_mahasiswa }}</td>
                                <td class="py-2 px-2 md:px-4 border-b">{{ $item->divisi_utama }}</td>
                                <td class="py-2 px-2 md:px-4 border-b">{{ $item->divisi_tambahan }}</td>
                                <td class="py-2 px-2 md:px-4 border-b">
                                    @if($item->cv)
                                        <a href="{{ $item->cv }}" target="_blank" class="text-blue-600 underline">Lihat</a>
                                    @endif
                                </td>
                                <td class="py-2 px-2 md:px-4 border-b">
                                    @if($item->portofolio)
                                        <a href="{{ $item->portofolio }}" target="_blank" class="text-blue-600 underline">Lihat</a>
                                    @endif
                                </td>
                                <td class="py-2 px-2 md:px-4 border-b">
                                    @if($item->bukti_follow_instagram)
                                        <a href="{{ $item->bukti_follow_instagram }}" target="_blank" class="text-blue-600 underline">Lihat</a>
                                    @endif
                                </td>
                                <td class="py-2 px-2 md:px-4 border-b">
                                    @if($item->bukti_follow_linkedin)
                                        <a href="{{ $item->bukti_follow_linkedin }}" target="_blank" class="text-blue-600 underline">Lihat</a>
                                    @endif
                                </td>
                                <td class="py-2 px-2 md:px-4 border-b">{{ $item->username_instagram }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="17" class="text-center py-4">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination (jika pakai pagination) --}}
            <div class="mt-4">
                {{ $recruitments->links() }}
            </div>
        </div>
    </div>
</div>
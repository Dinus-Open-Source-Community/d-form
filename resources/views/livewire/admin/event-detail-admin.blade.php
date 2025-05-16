<div class="p-4">
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

    <div class="col-span-1 md:col-span-2 lg:col-span-3 ">

      <h1 class="text-3xl font-bold text-[#343434] mb-5">{{ $event->name }}</h1>

      <div class="flex flex-wrap gap-6 text-[#343434]">
        <div class="flex items-start gap-2">
          <span class="material-icons">calendar_month</span>
          <span>
            <strong>{{ $eventDate }}</strong>
          </span>
        </div>

        <div class="flex items-center gap-2">
          <span class="material-icons">schedule</span>
          {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} -
          {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
        </div>

        <div class="flex items-center gap-2">
          <span class="material-icons">location_on</span>
          {{ $event->address }}
        </div>

        <div class="flex items-center gap-2">
          <span class="material-icons">groups</span>
          <strong>{{ $event->participants }}</strong> Participants
        </div>
      </div>

      <hr class="my-6 border-gray-300">

      <div class="mt-6 text-[#000000]">
        {!! nl2br(e($event->description)) !!}
      </div>
    </div>



    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4 mt-10 col-span-1 md:col-span-2 lg:col-span-1">
      <a href="{{ route('admin.event-edit', $event->id) }}"
        class="bg-white border border-black px-4 py-2 rounded-lg hover:bg-gray-200 cursor-pointer text-center">
        Edit
      </a>
      @if ($showTable)
        <button wire:click="$set('showReuploadForm', true)"
          class="bg-white border border-black px-4 py-2 rounded-lg hover:bg-gray-200 cursor-pointer"> Reupload CSV
        </button>
        <button class="bg-white border border-black px-4 py-2 rounded-lg hover:bg-gray-200 cursor-pointer">
          Download CSV
        </button>
        <button wire:click="downloadBarcode"
          class="bg-white border border-black px-4 py-2 rounded-lg hover:bg-gray-200 mb-4">
          Download All QR Codes
        </button>
      @endif

      <a href="{{ route('admin.scanqr', $event->id) }}"
        class="text-center bg-white border border-black px-4 py-2 rounded-lg hover:bg-gray-200">
        Scan QR
      </a>

      <button id="copyRegUrlBtn" type="button"
        class="bg-white border border-black px-4 py-2 rounded-lg hover:bg-gray-200 cursor-pointer"
        onclick="copyRegUrl('{{ $event->gform_url }}')">
        Registration URL
        <span class="material-icons align-middle ml-2">content_copy</span>
      </button>
    </div>
  </div>


  @if ($showTable && $showReuploadForm)
    {{-- Tampilkan form upload ulang --}}

    <form wire:submit.prevent="handleUploadCSV"
      class="bg-white border border-gray-300 rounded-xl shadow-md max-w-xl mx-auto p-6 flex flex-col items-center space-y-4 mt-10">
      <label class="w-full cursor-pointer">
        <div
          class="flex justify-center items-center w-full border-2 border-dashed border-gray-300 p-6 rounded-lg hover:border-gray-500 transition">
          <span class="material-icons text-4xl text-gray-500 mr-3">upload_file</span>
          <div class="text-left">
            <p class="text-sm font-medium text-gray-700">Pilih file CSV</p>
            <p class="text-xs text-gray-400">Maks 2MB. Format: .csv</p>
          </div>
        </div>
        <input type="file" wire:model="csvFile" class="hidden" />
      </label>

      @error('csvFile')
        <span class="text-red-600 text-sm">{{ $message }}</span>
      @enderror

      @if ($csvFile)
        <div class="text-sm text-green-700">
          File terpilih: <strong>{{ $csvFile->getClientOriginalName() }}</strong>
        </div>
      @endif

      <div class="flex gap-4">
        <button type="submit"
          class="flex items-center bg-[#343434] text-white px-6 py-2 rounded-lg hover:bg-[#2a2a2a] transition disabled:opacity-50"
          wire:loading.attr="disabled" wire:target="csvFile">
          <span wire:loading.remove wire:target="csvFile" class="flex items-center">
            <span class="material-icons mr-2">publish</span> Upload Ulang
          </span>
          <span wire:loading wire:target="csvFile" class="animate-pulse flex items-center">
            <span class="material-icons mr-2">hourglass_top</span> Mengunggah...
          </span>
        </button>

        <button type="button" wire:click="$set('showReuploadForm', false)"
          class="bg-white border border-gray-400 px-4 py-2 rounded-lg hover:bg-gray-100">
          Batal
        </button>
      </div>
    </form>
  @endif

  @if ($showTable)
    <div class="mt-10 overflow-x-auto border-2 border-gray-500 rounded-xl">
      <div class="text-center font-medium text-gray-600 my-4">
        Peserta Event (CSV Upload)
      </div>
      <table class="min-w-full border-collapse border border-gray-300 shadow-md">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-2 border">No</th>
            <th class="px-4 py-2 border">Nama</th>
            <th class="px-4 py-2 border">Asal Sekolah</th>
            <th class="px-4 py-2 border">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($event->participantList as $i => $participant)
            <tr>
              <td class="px-4 py-2 border">{{ $i + 1 }}</td>
              <td class="px-4 py-2 border">{{ $participant->name }}</td>
              <td class="px-4 py-2 border">{{ $participant->school }}</td>
              <td class="px-4 py-2 border">
                <button wire:click="downloadBarcode('{{ $participant->id }}')"
                  class="bg-blue-500 text-white px-2 py-1 rounded">
                  Download QR
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @else
    <div class="pt-32 pb-10 text-center text-gray-600">
      <h2 class="text-2xl font-semibold mb-2">Belum ada peserta diunggah</h2>
      <p class="mb-6">Silakan upload file CSV untuk menambahkan peserta pada event ini.</p>

      <form wire:submit.prevent="handleUploadCSV"
        class="bg-white border border-gray-300 rounded-xl shadow-md max-w-xl mx-auto p-6 flex flex-col items-center space-y-4">

        <label class="w-full cursor-pointer">
          <div
            class="flex justify-center items-center w-full border-2 border-dashed border-gray-300 p-6 rounded-lg hover:border-gray-500 transition">
            <span class="material-icons text-4xl text-gray-500 mr-3">upload_file</span>
            <div class="text-left">
              <p class="text-sm font-medium text-gray-700">Pilih file CSV</p>
              <p class="text-xs text-gray-400">Maks 1MB. Format: .csv</p>
            </div>
          </div>
          <input type="file" wire:model="csvFile" class="hidden" />
        </label>

        @error('csvFile')
          <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror

        @if ($csvFile)
          <div class="text-sm text-green-700">
            File terpilih: <strong>{{ $csvFile->getClientOriginalName() }}</strong>
          </div>
        @endif

        <button type="submit"
          class="flex items-center bg-[#343434] text-white px-6 py-2 rounded-lg hover:bg-[#2a2a2a] transition disabled:opacity-50"
          wire:loading.attr="disabled" wire:target="csvFile">
          <span wire:loading.remove wire:target="csvFile" class="flex items-center">
            <span class="material-icons mr-2">publish</span> Upload
          </span>
          <span wire:loading wire:target="csvFile" class="animate-pulse flex items-center">
            <span class="material-icons mr-2">hourglass_top</span> Mengunggah...
          </span>
        </button>
      </form>
    </div>
  @endif



</div>

@push('scripts')
  <script>
    function copyRegUrl(url) {
      if (!url) return;
      navigator.clipboard.writeText(url).then(function() {
        Swal.fire({
          toast: true,
          icon: 'success',
          title: 'URL copied successfully!',
          text: 'Registration URL has been copied to clipboard.',
          showConfirmButton: false,
          timer: 2000,
          timerProgressBar: true,
          position: 'top-end',
        });
      }, function() {
        Swal.fire({
          toast: true,
          icon: 'error',
          title: 'Failed to copy URL',
          text: 'Please try again.',
          showConfirmButton: false,
          timer: 2000,
          timerProgressBar: true,
          position: 'top-end',
        });
      });
    }
  </script>
@endpush

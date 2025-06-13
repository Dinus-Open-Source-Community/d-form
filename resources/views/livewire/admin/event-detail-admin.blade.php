<div class="p-4 sm:p-6 lg:p-8 bg-gray-100">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Main Content -->
        <div class="col-span-1 lg:col-span-3">
            <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8 border border-gray-200/30">
                <!-- Cover Event Image -->
                @if ($event->cover_event)
                    <div class="mb-6">
                        <img
                            src="{{ $event->cover_event }}"
                            alt="{{ $event->name }} Cover"
                            class="max-w-full h-auto rounded-lg shadow-md object-cover w-full max-h-96"
                        />
                    </div>
                @endif

                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">{{ $event->name }}</h1>

                <!-- Event Info -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700 mb-6">
                    <div class="flex items-start gap-3">
                        <span class="material-icons text-primary text-xl">calendar_month</span>
                        <div>
                            <span class="font-semibold">Event Date</span><br>
                            {{ $eventDate }}
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-icons text-primary text-xl">schedule</span>
                        <div>
                            <span class="font-semibold">Time</span><br>
                            {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-icons text-primary text-xl">location_on</span>
                        <div>
                            <span class="font-semibold">Location</span><br>
                            {{ $event->address }}
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-icons text-primary text-xl">groups</span>
                        <div>
                            <span class="font-semibold">Participants</span><br>
                            {{ $event->participants }}
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-icons text-primary text-xl">attach_money</span>
                        <div>
                            <span class="font-semibold">Price</span><br>
                            {{ $event->price == 0 ? 'Free' : 'Rp ' . number_format($event->price, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-icons text-primary text-xl">category</span>
                        <div>
                            <span class="font-semibold">Division</span><br>
                            {{ $event->division }}
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-icons text-primary text-xl">label</span>
                        <div>
                            <span class="font-semibold">Type</span><br>
                            {{ $event->type }}
                        </div>
                    </div>
                </div>

                <hr class="my-6 border-gray-200">

                <!-- Description -->
                <div class="text-gray-800 prose max-w-none">
                    {!! nl2br(e($event->description)) !!}
                </div>
            </div>

            <!-- Participant Table or Upload Form -->
            @if ($showTable)
                 <!-- Reupload CSV Form -->
                @if ($showReuploadForm)
                    <div class="mt-6 bg-white rounded-xl shadow-lg p-6 border border-gray-200/30" x-data="{ isDragging: false, fileName: '' }">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 text-center">Reupload Participant CSV</h3>
                        <form wire:submit.prevent="handleUploadCSV" class="flex flex-col items-center space-y-4">
                            <label
                                for="csvFile"
                                class="w-full cursor-pointer"
                                :class="{ 'bg-gray-50 border-primary border-dashed': isDragging, 'hover:bg-gray-50': !isDragging }"
                                @dragover.prevent="isDragging = true"
                                @dragenter.prevent="isDragging = true"
                                @dragleave.prevent="isDragging = false"
                                @drop.prevent="isDragging = false; $refs.fileInput.files = $event.dataTransfer.files; $refs.fileInput.dispatchEvent(new Event('change')); fileName = $event.dataTransfer.files[0]?.name || ''"
                            >
                                <div
                                    class="flex justify-center items-center w-full border-2 border-dashed border-gray-300 p-6 rounded-lg transition">
                                    <span class="material-icons text-4xl text-gray-500 mr-3">upload_file</span>
                                    <div class="text-left">
                                        <p class="text-sm font-medium text-gray-700" x-text="fileName ? `Dropped: ${fileName}` : 'Click or drag CSV file to upload'"></p>
                                        <p class="text-xs text-gray-400">Max 2MB. Format: .csv</p>
                                    </div>
                                </div>
                                <input
                                    id="csvFile"
                                    type="file"
                                    wire:model="csvFile"
                                    class="hidden"
                                    x-ref="fileInput"
                                    accept=".csv"
                                    @change="fileName = $event.target.files[0]?.name || ''"
                                />
                            </label>

                            @error('csvFile')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror

                            @if ($csvFile)
                                <div class="text-sm text-green-700">
                                    Selected: <strong>{{ $csvFile->getClientOriginalName() }}</strong>
                                </div>
                            @endif

                            <div class="flex gap-4">
                                <button
                                    type="submit"
                                    class="flex items-center bg-primary text-white px-6 py-2 rounded-lg hover:bg-[#3B5C80] transition duration-200 disabled:opacity-50 text-sm"
                                    wire:loading.attr="disabled"
                                    wire:target="csvFile"
                                >
                                    <span wire:loading.remove wire:target="csvFile" class="flex items-center">
                                        <span class="material-icons mr-2 text-lg">publish</span> Upload
                                    </span>
                                    <span wire:loading wire:target="csvFile" class="animate-pulse flex items-center">
                                        <span class="material-icons mr-2 text-lg">hourglass_top</span> Uploading...
                                    </span>
                                </button>
                                <button
                                    type="button"
                                    wire:click="$set('showReuploadForm', false)"
                                    class="bg-white border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-100 text-sm transition duration-200"
                                >
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                <div class="mt-6 bg-white rounded-xl shadow-lg border border-gray-200/30 overflow-hidden">
                    <div class="text-center font-semibold text-gray-900 py-4 bg-gray-50">
                        Event Participants (CSV Upload)
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-semibold border-b border-gray-200">No</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold border-b border-gray-200">Name</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold border-b border-gray-200">School</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold border-b border-gray-200">Presence</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold border-b border-gray-200">Presence At</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold border-b border-gray-200">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($this->participants as $i => $participant)
                                    <tr class="{{ $i % 2 == 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100 transition duration-200">
                                        <td class="px-4 py-3 border-b border-gray-200 text-sm">
                                            {{ ($this->participants->currentPage() - 1) * $this->participants->perPage() + $i + 1 }}
                                        </td>
                                        <td class="px-4 py-3 border-b border-gray-200 text-sm">{{ $participant->name }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200 text-sm">{{ $participant->school }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200 text-sm">
                                            <span class="inline-flex items-center p-1 rounded-full text-xs font-semibold
                                                {{ $participant->is_presence ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                <span class="material-icons text-base">
                                                    {{ $participant->is_presence ? 'check_circle' : 'cancel' }}
                                                </span>
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 border-b border-gray-200 text-sm">
                                            <span class="mt-1 text-xs text-gray-500">
                                                {{ $participant->presence_at ? \Carbon\Carbon::parse($participant->presence_at)->format('d/m/y H:i') : '-' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 border-b border-gray-200 text-sm">
                                            <button wire:click="downloadBarcode('{{ $participant->id }}')"
                                                class="bg-primary text-white px-3 py-1 rounded-lg hover:bg-[#3B5C80] transition duration-200 flex items-center text-xs">
                                                <span class="material-icons text-sm mr-1">qr_code</span> Download QR
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-4 py-2">
                            {{ $this->participants->links('livewire::tailwind') }}
                        </div>
                    </div>
                </div>

               
            @else
                <!-- Initial CSV Upload Form -->
                <div class="mt-6 bg-white rounded-xl shadow-lg p-6 border border-gray-200/30" x-data="{ isDragging: false, fileName: '' }">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 text-center">Upload Participant CSV</h3>
                    <p class="text-sm text-gray-600 text-center mb-6">No participants uploaded yet. Upload a CSV file to add participants.</p>
                    <form wire:submit.prevent="handleUploadCSV" class="flex flex-col items-center space-y-4">
                        <label
                            for="csvFile"
                            class="w-full cursor-pointer"
                            :class="{ 'bg-gray-50 border-primary border-dashed': isDragging, 'hover:bg-gray-50': !isDragging }"
                            @dragover.prevent="isDragging = true"
                            @dragenter.prevent="isDragging = true"
                            @dragleave.prevent="isDragging = false"
                            @drop.prevent="isDragging = false; $refs.fileInput.files = $event.dataTransfer.files; $refs.fileInput.dispatchEvent(new Event('change')); fileName = $event.dataTransfer.files[0]?.name || ''"
                        >
                            <div
                                class="flex justify-center items-center w-full border-2 border-dashed border-gray-300 p-6 rounded-lg transition">
                                <span class="material-icons text-4xl text-gray-500 mr-3">upload_file</span>
                                <div class="text-left">
                                    <p class="text-sm font-medium text-gray-700" x-text="fileName ? `Dropped: ${fileName}` : 'Click or drag CSV file to upload'"></p>
                                    <p class="text-xs text-gray-400">Max 2MB. Format: .csv</p>
                                </div>
                            </div>
                            <input
                                id="csvFile"
                                type="file"
                                wire:model="csvFile"
                                class="hidden"
                                x-ref="fileInput"
                                accept=".csv"
                                @change="fileName = $event.target.files[0]?.name || ''"
                            />
                        </label>

                        @error('csvFile')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror

                        @if ($csvFile)
                            <div class="text-sm text-green-700">
                                Selected: <strong>{{ $csvFile->getClientOriginalName() }}</strong>
                            </div>
                        @endif

                        <button
                            type="submit"
                            class="flex items-center bg-primary text-white px-6 py-2 rounded-lg hover:bg-[#3B5C80] transition duration-200 disabled:opacity-50 text-sm"
                            wire:loading.attr="disabled"
                            wire:target="csvFile"
                        >
                            <span wire:loading.remove wire:target="csvFile" class="flex items-center">
                                <span class="material-icons mr-2 text-lg">publish</span> Upload
                            </span>
                            <span wire:loading wire:target="csvFile" class="animate-pulse flex items-center">
                                <span class="material-icons mr-2 text-lg">hourglass_top</span> Uploading...
                            </span>
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <!-- Sidebar Actions -->
        <div class="col-span-1">
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200/30 sticky top-6">
                <div class="grid grid-cols-1 gap-3">
                    <a wire:navigate href="{{ route('admin.event-edit', $event->id) }}"
                        class="flex items-center justify-center bg-primary text-white px-4 py-2 rounded-lg hover:bg-[#3B5C80] transition duration-200 text-sm font-semibold">
                        <span class="material-icons mr-2 text-lg">edit</span> Edit Event
                    </a>
                    @if ($showTable)
                        <button wire:click="$set('showReuploadForm', true)"
                            class="flex items-center justify-center bg-primary text-white px-4 py-2 rounded-lg hover:bg-[#3B5C80] transition duration-200 text-sm font-semibold">
                            <span class="material-icons mr-2 text-lg">upload_file</span> Reupload CSV
                        </button>
                        <button class="flex items-center justify-center bg-primary text-white px-4 py-2 rounded-lg hover:bg-[#3B5C80] transition duration-200 text-sm font-semibold">
                            <span class="material-icons mr-2 text-lg">download</span> Download CSV
                        </button>
                        <button wire:click="downloadBarcode"
                            class="flex items-center justify-center bg-primary text-white px-4 py-2 rounded-lg hover:bg-[#3B5C80] transition duration-200 text-sm font-semibold">
                            <span class="material-icons mr-2 text-lg">qr_code</span> Download All QR Codes
                        </button>
                    @endif
                    <a href="{{ route('admin.scanqr', $event->id) }}"
                        class="flex items-center justify-center bg-primary text-white px-4 py-2 rounded-lg hover:bg-[#3B5C80] transition duration-200 text-sm font-semibold">
                        <span class="material-icons mr-2 text-lg">qr_code_scanner</span> Scan QR
                    </a>
                    <button id="copyRegUrlBtn" type="button"
                        class="flex items-center justify-center bg-primary text-white px-4 py-2 rounded-lg hover:bg-[#3B5C80] transition duration-200 text-sm font-semibold"
                        onclick="copyRegUrl('{{ $event->gform_url }}')">
                        <span class="material-icons mr-2 text-lg">content_copy</span> Copy Registration URL
                    </button>
                </div>
            </div>
        </div>
    </div>
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
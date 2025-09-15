<div class="p-4 sm:p-6 lg:p-8">
    <!-- Flash Message Toast -->
    @if (session()->has('saved'))
        <div class="fixed right-4 top-4 z-50 max-w-sm rounded-lg bg-green-600 p-4 text-white shadow-lg"
            x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4">
            <div class="flex items-start">
                <span class="material-icons mr-2 text-xl">check_circle</span>
                <div>
                    <h4 class="text-sm font-semibold">{{ session('saved')['title'] }}</h4>
                    <p class="text-xs">{{ session('saved')['text'] }}</p>
                </div>
                <button class="ml-auto text-white hover:text-gray-200" @click="show = false">
                    <span class="material-icons text-sm">close</span>
                </button>
            </div>
        </div>
    @endif

    <form
        class="mx-auto grid max-w-5xl grid-cols-1 gap-6 rounded-xl border border-gray-200/30 bg-white p-6 shadow-lg sm:gap-8 sm:p-8 md:grid-cols-3"
        wire:submit.prevent="updateEvent" autocomplete="off">
        <!-- Left Column -->
        <div class="space-y-4">
            <!-- Event Name -->
            <div class="relative">
                <label class="mb-1 block text-sm font-medium text-gray-700">Event Name</label>
                <div class="relative">
                    <span
                        class="material-icons absolute left-3 top-1/2 -translate-y-1/2 transform text-lg text-gray-400">event</span>
                    <input
                        class="focus:ring-primary focus:border-primary w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-4 text-sm font-medium text-gray-800 placeholder-gray-400 transition duration-200 focus:outline-none focus:ring-2"
                        type="text" wire:model="name" placeholder="Event Name" />
                </div>
                @error('name')
                    <span class="mt-1 block text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Google Form URL -->
            <div class="relative">
                <label class="mb-2 block text-sm font-medium text-gray-700">Google Form URL</label>
                <div class="relative">
                    <span
                        class="material-icons absolute left-3 top-1/2 -translate-y-1/2 transform text-lg text-gray-400">link</span>
                    <input
                        class="focus:ring-primary focus:border-primary w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-4 text-sm font-medium text-gray-800 placeholder-gray-400 transition duration-200 focus:outline-none focus:ring-2"
                        type="url" wire:model="googleFormUrl" placeholder="Google Form URL" />
                </div>
                @error('googleFormUrl')
                    <span class="mt-1 block text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Registration and Event Date -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="relative">
                    <label class="mb-2 block text-sm font-medium text-gray-700">Registration Date</label>
                    <input
                        class="focus:ring-primary focus:border-primary w-full rounded-lg border border-gray-300 py-2.5 pl-4 pr-3 text-sm font-medium text-gray-800 transition duration-200 focus:outline-none focus:ring-2"
                        type="date" wire:model="registrationDate" />
                    @error('registrationDate')
                        <span class="mt-1 block text-xs text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="relative">
                    <label class="mb-2 block text-sm font-medium text-gray-700">Event Date</label>
                    <input
                        class="focus:ring-primary focus:border-primary w-full rounded-lg border border-gray-300 py-2.5 pl-4 pr-3 text-sm font-medium text-gray-800 transition duration-200 focus:outline-none focus:ring-2"
                        type="date" wire:model="eventDate" />
                    @error('eventDate')
                        <span class="mt-1 block text-xs text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Start and End Time -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="relative">
                    <label class="mb-2 block text-sm font-medium text-gray-700">Start Time</label>
                    <input
                        class="focus:ring-primary focus:border-primary w-full rounded-lg border border-gray-300 py-2.5 pl-4 pr-3 text-sm font-medium text-gray-800 transition duration-200 focus:outline-none focus:ring-2"
                        type="time" wire:model="startTime" />
                    @error('startTime')
                        <span class="mt-1 block text-xs text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="relative">
                    <label class="mb-2 block text-sm font-medium text-gray-700">End Time</label>
                    <input
                        class="focus:ring-primary focus:border-primary w-full rounded-lg border border-gray-300 py-2.5 pl-4 pr-3 text-sm font-medium text-gray-800 transition duration-200 focus:outline-none focus:ring-2"
                        type="time" wire:model="endTime" />
                    @error('endTime')
                        <span class="mt-1 block text-xs text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Duration and Participants -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="relative">
                    <label class="mb-2 block text-sm font-medium text-gray-700">Duration (days)</label>
                    <div class="relative">
                        <span
                            class="material-icons absolute left-3 top-1/2 -translate-y-1/2 text-lg text-gray-400">calendar_today</span>
                        <input
                            class="focus:ring-primary focus:border-primary w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-4 text-sm font-medium text-gray-800 placeholder-gray-400 transition duration-200 focus:outline-none focus:ring-2"
                            type="number" wire:model="durationDays" min="1" />
                    </div>
                    @error('durationDays')
                        <span class="mt-1 block text-xs text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="relative">
                    <label class="mb-2 block text-sm font-medium text-gray-700">Participants</label>
                    <div class="relative">
                        <span
                            class="material-icons absolute left-3 top-1/2 -translate-y-1/2 text-lg text-gray-400">group</span>
                        <input
                            class="focus:ring-primary focus:border-primary w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-4 text-sm font-medium text-gray-800 placeholder-gray-400 transition duration-200 focus:outline-none focus:ring-2"
                            type="number" wire:model="participants" min="1" />
                    </div>
                    @error('participants')
                        <span class="mt-1 block text-xs text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Price Field -->
            <div class="relative">
                <label class="mb-2 block text-sm font-medium text-gray-700">Price (Rp)</label>
                <div class="relative">
                    <span
                        class="material-icons absolute left-3 top-1/2 -translate-y-1/2 text-lg text-gray-400">attach_money</span>
                    <input
                        class="focus:ring-primary focus:border-primary w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-4 text-sm font-medium text-gray-800 placeholder-gray-400 transition duration-200 focus:outline-none focus:ring-2"
                        type="number" wire:model="price" min="0" placeholder="0" />
                </div>
                <p class="mt-1 text-xs text-gray-500">Enter 0 for free events</p>
                @error('price')
                    <span class="mt-1 block text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Type -->
            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">Type</label>
                <div class="flex gap-3">
                    @foreach (['RKT', 'NON-RKT'] as $type)
                        <button
                            class="{{ $type === $this->type ? 'bg-primary text-white border-primary' : 'text-gray-700 hover:bg-primary hover:text-white hover:border-primary' }} flex-1 rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold transition duration-200"
                            type="button" wire:click="setType('{{ $type }}')">
                            {{ $type }}
                        </button>
                    @endforeach
                </div>
                @error('type')
                    <span class="mt-1 block text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Division -->
            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">Division</label>
                <div class="grid grid-cols-2 gap-3">
                    @foreach (['General', 'Programming', 'Multimedia', 'Networking'] as $div)
                        <button
                            class="{{ $div === $this->division ? 'bg-primary text-white border-primary' : 'text-gray-700 hover:bg-primary hover:text-white hover:border-primary' }} rounded-lg border border-gray-300 px-3 py-2 text-sm font-semibold transition duration-200"
                            type="button" wire:click="setDivision('{{ $div }}')">
                            {{ $div }}
                        </button>
                    @endforeach
                </div>
                @error('division')
                    <span class="mt-1 block text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-4 md:col-span-2">
            <!-- Address -->
            <div class="relative">
                <label class="mb-2 block text-sm font-medium text-gray-700">Address</label>
                <div class="relative">
                    <span
                        class="material-icons absolute left-3 top-1/2 -translate-y-1/2 transform text-lg text-gray-400">location_on</span>
                    <input
                        class="focus:ring-primary focus:border-primary w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-4 text-sm font-medium text-gray-800 placeholder-gray-400 transition duration-200 focus:outline-none focus:ring-2"
                        type="text" wire:model="address" placeholder="Address" />
                </div>
                @error('address')
                    <span class="mt-1 block text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Google Maps URL -->
            <div class="relative">
                <label class="mb-2 block text-sm font-medium text-gray-700">Google Maps URL</label>
                <div class="relative">
                    <span
                        class="material-icons absolute left-3 top-1/2 -translate-y-1/2 transform text-lg text-gray-400">map</span>
                    <input
                        class="focus:ring-primary focus:border-primary w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-4 text-sm font-medium text-gray-800 placeholder-gray-400 transition duration-200 focus:outline-none focus:ring-2"
                        type="url" wire:model="googleMapsUrl" placeholder="Google Maps URL" />
                </div>
                @error('googleMapsUrl')
                    <span class="mt-1 block text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">Description</label>
                <textarea
                    class="focus:ring-primary focus:border-primary w-full resize-none rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-800 placeholder-gray-400 transition duration-200 focus:outline-none focus:ring-2"
                    wire:model="description" placeholder="Description" rows="6"></textarea>
                @error('description')
                    <span class="mt-1 block text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Cover Image Upload -->
            <div x-data="{ isDragging: false, fileName: '' }">
                <label
                    class="flex w-full cursor-pointer flex-col items-center justify-center rounded-lg border border-gray-300 py-6 text-gray-700 transition duration-200"
                    for="coverEvent"
                    :class="{ 'bg-gray-50 border-primary border-dashed': isDragging, 'hover:bg-gray-50': !isDragging }"
                    @dragover.prevent="isDragging = true" @dragenter.prevent="isDragging = true"
                    @dragleave.prevent="isDragging = false"
                    @drop.prevent="isDragging = false; $refs.fileInput.files = $event.dataTransfer.files; $refs.fileInput.dispatchEvent(new Event('change')); fileName = $event.dataTransfer.files[0]?.name || ''">
                    @if ($coverEvent)
                        <div class="relative mb-2">
                            <img class="mx-auto max-h-48 rounded-lg object-contain"
                                src="{{ $coverEvent->temporaryUrl() }}" alt="Cover Preview" />
                            <button
                                class="absolute right-2 top-2 rounded-full bg-gray-500/80 p-1.5 text-white transition duration-200 hover:bg-red-600"
                                type="button" title="Remove photo" wire:click="removeCoverEvent">
                                <span class="material-icons text-sm">close</span>
                            </button>
                        </div>
                    @elseif ($currentCoverEvent)
                        <div class="relative mb-2">
                            <img class="mx-auto max-h-48 rounded-lg object-contain" src="{{ $currentCoverEvent }}"
                                alt="Current Cover" />
                            <button
                                class="absolute right-2 top-2 rounded-full bg-gray-500/80 p-1.5 text-white transition duration-200 hover:bg-red-600"
                                type="button" title="Remove photo" wire:click="removeExistingCover">
                                <span class="material-icons text-sm">close</span>
                            </button>
                        </div>
                    @else
                        <span class="material-icons mb-2 text-2xl text-gray-400">upload</span>
                        <span class="text-sm font-medium"
                            x-text="fileName ? `Dropped: ${fileName}` : 'Click or drag image to upload'"></span>
                    @endif
                    <input class="hidden" id="coverEvent" type="file" wire:model="coverEvent" x-ref="fileInput"
                        accept="image/*" @change="fileName = $event.target.files[0]?.name || ''" />
                </label>
                @error('coverEvent')
                    <span class="mt-1 block text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-4 md:col-span-3">
                <button
                    class="rounded-lg border border-gray-300 px-6 py-2 text-sm font-semibold text-gray-700 transition duration-200 hover:bg-gray-100"
                    type="button" wire:click="goToDashboard">
                    Cancel
                </button>
                <button
                    class="bg-primary focus:ring-primary/30 rounded-lg px-6 py-2 text-sm font-semibold text-white transition duration-200 hover:bg-[#3B5C80] focus:ring-2"
                    type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed"
                    wire:loading.class.remove="hover:bg-[#3B5C80]">
                    <span wire:loading.remove wire:target="updateEvent">Update</span>
                    <span class="animate-pulse" wire:loading wire:target="updateEvent">Updating...</span>
                </button>
            </div>
        </div>
    </form>
</div>

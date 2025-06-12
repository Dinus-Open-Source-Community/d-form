<div class="p-4 sm:p-6 lg:p-8">
    <form wire:submit.prevent="createEvent" class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg p-6 sm:p-8 grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 border border-gray-200/30" autocomplete="off">
        <!-- Left Column -->
        <div class="space-y-4">
            <!-- Event Name -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-1">Event Name</label>
                <div class="relative">
                    <span class="material-icons text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2 text-lg">event</span>
                    <input
                        type="text"
                        wire:model="name"
                        placeholder="Event Name"
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-primary focus:border-primary transition duration-200"
                    />
                </div>
                @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Google Form URL -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-1">Google Form URL</label>
                <div class="relative">
                    <span class="material-icons text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2 text-lg">link</span>
                    <input
                        type="url"
                        wire:model="googleFormUrl"
                        placeholder="Google Form URL"
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-primary focus:border-primary transition duration-200"
                    />
                </div>
                @error('googleFormUrl') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Registration and Event Date -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Registration Date</label>
                    <input
                        type="date"
                        wire:model="registrationDate"
                        class="w-full pl-4 pr-3 py-2.5 border border-gray-200 rounded-lg text-gray-900 focus:ring-2 focus:ring-primary focus:border-primary transition duration-200"
                    />
                    @error('registrationDate') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Event Date</label>
                    <input
                        type="date"
                        wire:model="eventDate"
                        class="w-full pl-4 pr-3 py-2.5 border border-gray-200 rounded-lg text-gray-900 focus:ring-2 focus:ring-primary focus:border-primary transition duration-200"
                    />
                    @error('eventDate') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Start and End Time -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
                    <input
                        type="time"
                        wire:model="startTime"
                        class="w-full pl-4 pr-3 py-2.5 border border-gray-200 rounded-lg text-gray-900 focus:ring-2 focus:ring-primary focus:border-primary transition duration-200"
                    />
                    @error('startTime') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
                    <input
                        type="time"
                        wire:model="endTime"
                        class="w-full pl-4 pr-3 py-2.5 border border-gray-200 rounded-lg text-gray-900 focus:ring-2 focus:ring-primary focus:border-primary transition duration-200"
                    />
                    @error('endTime') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Duration and Participants -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Duration (days)</label>
                    <div class="relative">
                        <span class="material-icons text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 text-lg">calendar_today</span>
                        <input
                            type="number"
                            wire:model="durationDays"
                            min="1"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-primary focus:border-primary transition duration-200"
                        />
                    </div>
                    @error('durationDays') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Participants</label>
                    <div class="relative">
                        <span class="material-icons text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 text-lg">group</span>
                        <input
                            type="number"
                            wire:model="participants"
                            min="1"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-primary focus:border-primary transition duration-200"
                        />
                    </div>
                    @error('participants') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Price Field -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-1">Price (Rp)</label>
                <div class="relative">
                    <span class="material-icons text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 text-lg">attach_money</span>
                    <input
                        type="number"
                        wire:model="price"
                        min="0"
                        placeholder="0"
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-primary focus:border-primary transition duration-200"
                    />
                </div>
                <p class="text-xs text-gray-500 mt-1">Enter 0 for free events</p>
                @error('price') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Type -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                <div class="flex gap-3">
                    @foreach(['RKT', 'NON-RKT'] as $type)
                        <button
                            type="button"
                            wire:click="setType('{{ $type }}')"
                            class="flex-1 px-4 py-2 rounded-lg text-sm font-semibold border border-gray-200 {{ $type === $this->type ? 'bg-primary text-white border-primary' : 'text-gray-700 hover:bg-primary hover:text-white hover:border-primary' }} transition duration-200"
                        >
                            {{ $type }}
                        </button>
                    @endforeach
                </div>
                @error('type') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Division -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Division</label>
                <div class="grid grid-cols-2 gap-3">
                    @foreach(['General', 'Programming', 'Multimedia', 'Networking'] as $div)
                        <button
                            type="button"
                            wire:click="setDivision('{{ $div }}')"
                            class="px-3 py-2 rounded-lg text-sm font-semibold border border-gray-200 {{ $div === $this->division ? 'bg-primary text-white border-primary' : 'text-gray-700 hover:bg-primary hover:text-white hover:border-primary' }} transition duration-200"
                        >
                            {{ $div }}
                        </button>
                    @endforeach
                </div>
                @error('division') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-4 md:col-span-2">
            <!-- Address -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                <div class="relative">
                    <span class="material-icons text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2 text-lg">location_on</span>
                    <input
                        type="text"
                        wire:model="address"
                        placeholder="Address"
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-primary focus:border-primary transition duration-200"
                    />
                </div>
                @error('address') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Google Maps URL -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-1">Google Maps URL</label>
                <div class="relative">
                    <span class="material-icons text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2 text-lg">map</span>
                    <input
                        type="url"
                        wire:model="googleMapsUrl"
                        placeholder="Google Maps URL"
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-primary focus:border-primary transition duration-200"
                    />
                </div>
                @error('googleMapsUrl') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea
                    wire:model="description"
                    placeholder="Description"
                    rows="6"
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-primary focus:border-primary transition duration-200 resize-none"
                ></textarea>
                @error('description') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Cover Image Upload -->
            <div x-data="{ isDragging: false, fileName: '' }">
                <label
                    for="coverEvent"
                    class="cursor-pointer w-full border border-gray-200 rounded-lg py-6 flex flex-col items-center justify-center text-gray-700 transition duration-200"
                    :class="{ 'bg-gray-50 border-primary border-dashed': isDragging, 'hover:bg-gray-50': !isDragging }"
                    @dragover.prevent="isDragging = true"
                    @dragenter.prevent="isDragging = true"
                    @dragleave.prevent="isDragging = false"
                    @drop.prevent="isDragging = false; $refs.fileInput.files = $event.dataTransfer.files; $refs.fileInput.dispatchEvent(new Event('change')); fileName = $event.dataTransfer.files[0]?.name || ''"
                >
                    @if ($coverEvent)
                        <div class="mb-2 relative">
                            <img src="{{ $coverEvent->temporaryUrl() }}" alt="Cover Preview" class="max-h-48 rounded-lg object-contain mx-auto" />
                            <button
                                type="button"
                                wire:click="removeCoverEvent"
                                class="absolute top-2 right-2 bg-gray-500/80 rounded-full p-1.5 text-white hover:bg-red-500 transition duration-200"
                                title="Remove photo"
                            >
                                <span class="material-icons text-sm">close</span>
                            </button>
                        </div>
                    @else
                        <span class="material-icons text-gray-400 text-2xl mb-2">upload</span>
                        <span class="text-sm font-medium" x-text="fileName ? `Dropped: ${fileName}` : 'Click or drag image to upload'"></span>
                    @endif
                    <input
                        id="coverEvent"
                        type="file"
                        wire:model="coverEvent"
                        class="hidden"
                        x-ref="fileInput"
                        accept="image/*"
                        @change="fileName = $event.target.files[0]?.name || ''"
                    />
                </label>
                @error('coverEvent') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Buttons -->
            <div class="md:col-span-3 flex justify-end gap-4">
                <button
                    type="button"
                    wire:click="closeModal"
                    class="border border-gray-200 text-gray-700 px-6 py-2 rounded-lg text-sm font-semibold hover:bg-gray-100 transition duration-200"
                >
                    Cancel
                </button>
                <button
                    type="submit"
                    class="bg-primary text-white px-6 py-2 rounded-lg text-sm font-semibold hover:bg-[#3B5C80] transition duration-200 focus:ring-2 focus:ring-primary/30"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 cursor-not-allowed"
                    wire:loading.class.remove="hover:bg-[#3B5C80]"
                >
                    <span wire:loading.remove wire:target="createEvent">Save</span>
                    <span wire:loading wire:target="createEvent" class="animate-pulse">Saving...</span>
                </button>
            </div>
        </div>
    </form>
</div>
<div class="p-4 text-[#343434]">
    <form wire:submit.prevent="updateEvent" class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6" autocomplete="off">
        <!-- Left Column -->
        <div class="space-y-2">
            <div>
                <input
                    type="text"
                    wire:model="name"
                    placeholder="Event Name"
                    class="w-full border border-[#343434] rounded-lg px-4 py-2 placeholder-[#343434]"
                />
                @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <input
                    type="url"
                    wire:model="googleFormUrl"
                    placeholder="Google Form URL"
                    class="w-full border border-[#343434] rounded-lg px-4 py-2 placeholder-[#343434]"
                />
                @error('googleFormUrl') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="relative">
                    <label class="block text-sm font-medium mb-1">Registration Date</label>
                    <input
                        type="date"
                        wire:model="registrationDate"
                        class="w-full p-2 border rounded"
                    />
                    @error('registrationDate') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div class="relative">
                    <label class="block text-sm font-medium mb-1">Event Date</label>
                    <input
                        type="date"
                        wire:model="eventDate"
                        class="w-full p-2 border rounded"
                    />
                    @error('eventDate') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex gap-4">
                <div class="relative flex-2">
                    <label class="block text-sm font-medium mb-1">Start Time</label>
                    <input
                        type="time"
                        wire:model="startTime"
                        class="w-full p-2 border rounded"
                    />
                    @error('startTime') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div class="relative flex-2">
                    <label class="block text-sm font-medium mb-1">End Time</label>
                    <input
                        type="time"
                        wire:model="endTime"
                        class="w-full p-2 border rounded"
                    />
                    @error('endTime') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex flex-col">
                    <label class="text-sm mb-1 font-medium text-[#343434]">Duration (days)</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#343434] w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <input
                            type="number"
                            wire:model="durationDays"
                            min="1"
                            class="w-full border border-[#343434] rounded-lg pl-10 pr-4 py-2 text-[#343434] placeholder-[#343434]"
                        />
                    </div>
                    @error('durationDays') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm mb-1 font-medium text-[#343434]">Participants</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#343434] w-4 h-4" fill="none" stroke="currentColor" viewBox="0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <input
                            type="number"
                            wire:model="participants"
                            min="1"
                            class="w-full border border-[#343434] rounded-lg pl-10 pr-4 py-2 text-[#343434] placeholder-[#343434]"
                        />
                    </div>
                    @error('participants') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="text-sm font-medium block mb-1">Type</label>
                <div class="flex gap-2">
                    @foreach(['RKT', 'NON-RKT'] as $type)
                        <button
                            type="button"
                            wire:click="setType('{{ $type }}')"
                            class="flex-1 px-4 py-2 rounded-lg font-semibold border {{ $type === $this->type ? 'bg-[#343434] text-white' : 'border-[#343434] text-[#343434] hover:bg-[#343434] hover:text-white' }}"
                        >
                            {{ $type }}
                        </button>
                    @endforeach
                </div>
                @error('type') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-sm font-medium block mb-1">Division</label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach(['General', 'Programming', 'Multimedia', 'Networking'] as $div)
                        <button
                            type="button"
                            wire:click="setDivision('{{ $div }}')"
                            class="px-3 py-2 rounded-lg text-sm border {{ $div === $this->division ? 'bg-[#343434] text-white' : 'border-[#343434] text-[#343434] hover:bg-[#343434] hover:text-white' }}"
                        >
                            {{ $div }}
                        </button>
                    @endforeach
                </div>
                @error('division') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-2 md:col-span-2">
            <div>
                <input
                    type="text"
                    wire:model="address"
                    placeholder="Address"
                    class="w-full border border-[#343434] rounded-lg px-4 py-2 placeholder-[#343434]"
                />
                @error('address') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <input
                    type="_oidurl"
                    wire:model="googleMapsUrl"
                    placeholder="Google Maps URL"
                    class="w-full border border-[#343434] rounded-lg px-4 py-2 placeholder-[#343434]"
                />
                @error('googleMapsUrl') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <textarea
                    wire:model="description"
                    placeholder="Description"
                    rows="6"
                    class="w-full border border-[#343434] rounded-lg px-4 py-2 placeholder-[#343434] resize-none"
                ></textarea>
                @error('description') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label
                    for="coverEvent"
                    class="cursor-pointer w-full border border-[#343434] rounded-lg py-6 flex flex-col items-center justify-center text-[#343434] hover:bg-gray-100"
                >
                    <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    Click or drag image to upload
                    <input
                        id="coverEvent"
                        type="file"
                        wire:model="coverEvent"
                        class="hidden"
                    />
                </label>
                @error('coverEvent') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Buttons -->
            <div class="md:col-span-3 flex justify-end gap-4">
                <button
                    type="button"
                    wire:click="closeModal"
                    class="border border-[#343434] text-[#343434] px-6 py-2 rounded-lg hover:bg-[#343434] hover:text-white"
                >
                    Cancel
                </button>
                <button
                    type="submit"
                    class="bg-[#343434] text-white font-semibold px-6 py-2 rounded-lg hover:opacity-90 cursor-pointer"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 cursor-not-allowed"
                    wire:loading.class.remove="cursor-pointer"
                >
                    <span wire:loading.remove wire:target="updateEvent">Update</span>
                    <span wire:loading wire:target="updateEvent" class="animate-pulse">Updating...</span>
                </button>
            </div>
        </div>
    </form>

    <!-- Success Modal -->
    @if($showSuccessModal)
        <div class="fixed inset-0 bg-[#343434]/80 flex items-center justify-center z-50">
            <div class="bg-white text-white rounded-lg p-6 w-full max-w-md relative">
                <!-- Success checkmark -->
                <div class="flex justify-center pt-2 pb-4">
                    <div class="bg-[#343434] rounded-full p-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                </div>

                <!-- Confirmation text -->
                <h3 class="text-center text-[#343434] text-lg font-medium mb-6">
                    Event has been successfully updated!
                </h3>

                <!-- Action buttons -->
                <div class="flex justify-center gap-4">
                    <button
                        wire:click="goToDashboard"
                        class="bg-[#343434] hover:bg-gray-700 text-white font-semibold px-5 py-2 rounded-lg cursor-pointer"
                    >
                        Back to Dashboard
                    </button>
                </div>

                <!-- Close button -->
                <button
                    wire:click="closeModal"
                    class="absolute top-4 right-4 text-[#343434] hover:text-gray-700 text-xl cursor-pointer"
                >
                    ×
                </button>
            </div>
        </div>
    @endif
</div>
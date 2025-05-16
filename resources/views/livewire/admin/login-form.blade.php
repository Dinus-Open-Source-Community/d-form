<div class="flex min-h-screen">
    <!-- Left side - Dark background -->
    <div class="w-3/5 bg-[#343434]"></div>

    <!-- Right side - Login form -->
    <div class="w-2/5 bg-white p-2 flex-col justify-center">
        <!-- Logo and title -->
        <div class="mx-8 mt-4 mb-10">
            <div class="flex items-center">
                <span class="text-4xl font-bold">D</span>
                <span class="ml-2 text-2xl">DOSCOM FORM</span>
            </div>
        </div>

        <div class="max-w-md mx-auto w-96 pt-10">
            <div class="mt-12">
                <h2 class="text-3xl font-bold text-center mb-8">Log In</h2>

                <form wire:submit.prevent="login">
                    <div class="mb-6">
                        <label for="email" class="block mb-2">E-Mail</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            wire:model.defer="email"
                            placeholder="emailexample@gmail.com"
                            class="w-full px-4 py-3 border-2 border-[#343434] rounded-xl"
                        />
                        @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block mb-2">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            wire:model.defer="password"
                            class="w-full px-4 py-3 border-2 border-[#343434] rounded-xl"
                        />
                        @error('password') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <button
                            type="submit"
                            class="w-full bg-[#343434] text-white py-3 rounded-xl font-medium hover:bg-gray-800 cursor-pointer transition duration-200"
                            wire:loading.attr="disabled"
                            wire:loading.class="bg-gray-800 cursor-not-allowed"
                            wire:loading.class.remove="cursor-pointer"
                        >
                            Log In
                        </button>
                    </div>

                    <div class="text-center relative my-6">
                        <div class="absolute top-1/2 left-0 right-0 h-px bg-[#343434]"></div>
                        <span class="relative bg-white px-4 text-sm text-[#343434]">
                            Or log in with
                        </span>
                    </div>

                    <div class="flex justify-center mb-8">
                        <button
                            type="button"
                            class="border-2 border-[#343434] rounded-xl p-2 flex items-center justify-center w-16 h-10 hover:bg-gray-300"
                        >
                            <span class="text-3xl font-bold">G</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

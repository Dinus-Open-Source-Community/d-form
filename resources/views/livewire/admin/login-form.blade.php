<div class="flex min-h-screen bg-gray-50">
    <!-- Background overlay for mobile -->
    <div class="from-primary absolute inset-0 bg-gradient-to-br to-[#2E4A6B] opacity-90 lg:hidden"></div>

    <!-- Left side - Decorative (hidden on mobile) -->
    <div
        class="from-primary relative hidden items-center justify-center overflow-hidden bg-gradient-to-br to-[#2E4A6B] lg:flex lg:w-3/5">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
        <div class="px-8 text-center text-white">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight">DOSCOM Community</h1>
            <p class="text-lg opacity-90">Connect, learn, and grow with our vibrant developer network</p>
        </div>
    </div>

    <!-- Right side - Login form with centralized error -->
    <div class="relative z-10 flex w-full items-center justify-center p-4 sm:p-6 lg:w-2/5 lg:p-8">
        <div
            class="w-full max-w-sm rounded-xl bg-white p-6 shadow-lg transition-all duration-300 hover:shadow-xl sm:max-w-md sm:p-8">
            <!-- Logo and title -->
            <div class="mb-8 flex justify-center">
                <div class="text-primary flex items-center">
                    <span class="text-4xl font-extrabold drop-shadow-sm sm:text-5xl">D</span>
                    <span class="ml-2 text-xl font-semibold tracking-wide sm:text-2xl">DOSCOM FORM</span>
                </div>
            </div>

            <h2 class="mb-6 text-center text-2xl font-bold text-gray-900 sm:text-3xl">Sign In</h2>

            <form wire:submit.prevent="login">
                <!-- Centralized error message -->
                <div class="mb-4">
                    @error('email')
                        <div class="rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                    @error('password')
                        <div class="mt-2 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                    @if ($errors->has('email') && $errors->has('password'))
                        <div class="mt-2 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-500">
                            Invalid credentials
                        </div>
                    @endif
                </div>

                <div class="mb-5">
                    <label class="mb-2 block text-sm font-medium text-gray-700" for="email">E-Mail</label>
                    <div class="relative">
                        <input
                            class="focus:ring-primary focus:border-primary w-full rounded-lg border border-gray-200 bg-gray-50/50 px-4 py-3 text-sm transition duration-300 focus:ring-2"
                            id="email" name="email" type="email" wire:model.defer="email"
                            placeholder="emailexample@gmail.com" />
                        <svg class="absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 transform text-gray-400"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                            </path>
                        </svg>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="mb-2 block text-sm font-medium text-gray-700" for="password">Password</label>
                    <div class="relative">
                        <input
                            class="focus:ring-primary focus:border-primary w-full rounded-lg border border-gray-200 bg-gray-50/50 px-4 py-3 text-sm transition duration-300 focus:ring-2"
                            id="password" name="password" type="password" wire:model.defer="password" />
                        <svg class="absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 transform text-gray-400"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 11c0-1.1-.9-2-2-2s-2 .9-2 2 2 4 2 4m2-4c0-1.1.9-2 2-2s2 .9 2 2-2 4-2 4m-6 4l1.5 1.5m4.5-1.5l-1.5 1.5M12 2a10 10 0 00-10 10c0 5.5 4.5 10 10 10s10-4.5 10-10A10 10 0 0012 2z">
                            </path>
                        </svg>
                    </div>
                </div>

                <div class="mb-6">
                    <button
                        class="bg-primary focus:ring-primary/30 w-full transform rounded-lg py-3 text-sm font-semibold text-white transition duration-300 hover:scale-[1.02] hover:bg-[#3B5C80] focus:ring-4"
                        type="submit" wire:loading.attr="disabled" wire:loading.class="bg-gray-500 cursor-not-allowed"
                        wire:loading.class.remove="hover:scale-[1.02]">
                        Sign In
                    </button>
                </div>

                <!-- Social login -->
                <div class="relative my-6 text-center">
                    <div class="absolute left-0 right-0 top-1/2 h-px bg-gray-200"></div>
                    <span class="relative bg-white px-3 text-xs text-gray-500">Or continue with</span>
                </div>

                <div class="flex justify-center gap-4">
                    <button
                        class="flex h-10 w-10 transform items-center justify-center rounded-lg border border-gray-200 p-2 transition duration-200 hover:scale-105 hover:bg-gray-100"
                        type="button">
                        <span class="text-xl font-bold text-gray-700">G</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="flex min-h-screen bg-gray-50">
    <!-- Background overlay for mobile -->
    <div class="absolute inset-0 bg-gradient-to-br from-primary to-[#2E4A6B] opacity-90 lg:hidden"></div>

    <!-- Left side - Decorative (hidden on mobile) -->
    <div class="hidden lg:flex lg:w-3/5 items-center justify-center bg-gradient-to-br from-primary to-[#2E4A6B] relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
        <div class="text-center text-white px-8">
            <h1 class="text-4xl font-extrabold tracking-tight mb-4">DOSCOM Community</h1>
            <p class="text-lg opacity-90">Connect, learn, and grow with our vibrant developer network</p>
        </div>
    </div>

    <!-- Right side - Login form with centralized error -->
    <div class="w-full lg:w-2/5 flex items-center justify-center p-4 sm:p-6 lg:p-8 relative z-10">
        <div class="w-full max-w-sm sm:max-w-md bg-white rounded-xl shadow-lg p-6 sm:p-8 transition-all duration-300 hover:shadow-xl">
            <!-- Logo and title -->
            <div class="flex justify-center mb-8">
                <div class="flex items-center text-primary">
                    <span class="text-4xl sm:text-5xl font-extrabold drop-shadow-sm">D</span>
                    <span class="ml-2 text-xl sm:text-2xl font-semibold tracking-wide">DOSCOM FORM</span>
                </div>
            </div>

            <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-6">Sign In</h2>

            <form wire:submit.prevent="login">
                <!-- Centralized error message -->
                <div class="mb-4">
                    @error('email') 
                        <div class="text-sm text-red-500 bg-red-50 border border-red-200 rounded-lg p-3">
                            {{ $message }}
                        </div>
                    @enderror
                    @error('password') 
                        <div class="text-sm text-red-500 bg-red-50 border border-red-200 rounded-lg p-3 mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    @if ($errors->has('email') && $errors->has('password'))
                        <div class="text-sm text-red-500 bg-red-50 border border-red-200 rounded-lg p-3 mt-2">
                            Invalid credentials
                        </div>
                    @endif
                </div>

                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700">E-Mail</label>
                    <div class="relative">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            wire:model.defer="email"
                            placeholder="emailexample@gmail.com"
                            class="w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition duration-300 bg-gray-50/50"
                        />
                        <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            wire:model.defer="password"
                            class="w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition duration-300 bg-gray-50/50"
                        />
                        <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.1-.9-2-2-2s-2 .9-2 2 2 4 2 4m2-4c0-1.1.9-2 2-2s2 .9 2 2-2 4-2 4m-6 4l1.5 1.5m4.5-1.5l-1.5 1.5M12 2a10 10 0 00-10 10c0 5.5 4.5 10 10 10s10-4.5 10-10A10 10 0 0012 2z"></path>
                        </svg>
                    </div>
                </div>

                <div class="mb-6">
                    <button
                        type="submit"
                        class="w-full bg-primary text-white py-3 rounded-lg font-semibold text-sm hover:bg-[#3B5C80] transition duration-300 transform hover:scale-[1.02] focus:ring-4 focus:ring-primary/30"
                        wire:loading.attr="disabled"
                        wire:loading.class="bg-gray-500 cursor-not-allowed"
                        wire:loading.class.remove="hover:scale-[1.02]"
                    >
                        Sign In
                    </button>
                </div>

                <!-- Social login -->
                <div class="text-center relative my-6">
                    <div class="absolute top-1/2 left-0 right-0 h-px bg-gray-200"></div>
                    <span class="relative bg-white px-3 text-xs text-gray-500">Or continue with</span>
                </div>

                <div class="flex justify-center gap-4">
                    <button
                        type="button"
                        class="border border-gray-200 rounded-lg p-2 w-10 h-10 flex items-center justify-center hover:bg-gray-100 transition duration-200 transform hover:scale-105"
                    >
                        <span class="text-xl font-bold text-gray-700">G</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
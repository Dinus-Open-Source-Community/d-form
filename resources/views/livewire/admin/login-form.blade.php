<div class="flex min-h-screen bg-gray-50" x-data="{ showPassword: false }">
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
                            class="focus:ring-primary focus:border-primary w-full rounded-lg border border-gray-200 bg-gray-50/50 px-4 py-3 pr-10 text-sm transition duration-300 focus:ring-2"
                            id="password" name="password" 
                            :type="showPassword ? 'text' : 'password'" 
                            wire:model.defer="password"
                            placeholder="Enter your password" />
                        <button 
                            type="button"
                            class="absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 transform text-gray-400 hover:text-gray-600"
                            @click="showPassword = !showPassword">
                            <svg x-show="!showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <svg x-show="showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="mb-6">
                    <button
                        class="bg-primary focus:ring-primary/30 w-full transform rounded-lg py-3 text-sm font-semibold text-white transition duration-300 hover:scale-[1.02] hover:bg-[#3B5C80] focus:ring-4"
                        type="submit" wire:loading.attr="disabled" wire:loading.class="bg-gray-500 cursor-not-allowed"
                        wire:loading.class.remove="hover:scale-[1.02]">
                        <span wire:loading.remove>Sign In</span>
                        <span wire:loading>
                            <svg class="mx-auto h-5 w-5 animate-spin text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                    </button>
                </div>

                <!-- Social login -->
                <div class="relative my-6 text-center">
                    <div class="absolute left-0 right-0 top-1/2 h-px bg-gray-200"></div>
                    <span class="relative bg-white px-3 text-xs text-gray-500">Or continue with</span>
                </div>

                <div class="flex justify-center gap-4">
                    <a href="{{ route('auth.google') }}"
                        class="flex w-full transform items-center justify-center gap-3 rounded-lg border border-gray-200 px-4 py-3 transition duration-200 hover:scale-[1.02] hover:bg-gray-50 hover:shadow-md">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        <span class="text-sm font-medium text-gray-700">Sign in with Google</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
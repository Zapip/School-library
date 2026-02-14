<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Selamat Datang Kembali</h2>
        <p class="text-gray-500 mt-2 text-sm">Masuk untuk mengakses akun perpustakaan Anda.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="mb-1 text-xs font-bold uppercase tracking-wider text-gray-500 ml-1" />
            <x-text-input id="email" class="block mt-1 w-full rounded-xl border-gray-200 bg-gray-50 focus:border-green-500 focus:ring-green-500/20 py-3" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="mb-1 text-xs font-bold uppercase tracking-wider text-gray-500 ml-1" />

            <x-text-input id="password" class="block mt-1 w-full rounded-xl border-gray-200 bg-gray-50 focus:border-green-500 focus:ring-green-500/20 py-3"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-500 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" href="{{ route('password.request') }}">
                    {{ __('Lupa Password?') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-gray-900 text-white rounded-xl px-4 py-3.5 font-bold shadow-lg hover:bg-black transition-all transform hover:-translate-y-1 hover:shadow-xl flex justify-center items-center gap-2">
                {{ __('Masuk Sekarang') }}
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </div>
        
        <div class="text-center mt-6">
            <p class="text-sm text-gray-500">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-bold text-gray-900 hover:text-green-600 transition-colors">Daftar disini</a>
            </p>
        </div>
    </form>
</x-guest-layout>

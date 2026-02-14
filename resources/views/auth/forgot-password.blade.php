<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Lupa Password?</h2>
        <p class="text-gray-500 mt-2 text-sm">Masukan email Anda untuk mereset password.</p>
    </div>

    <div class="mb-6 text-sm text-gray-600 bg-gray-50 p-4 rounded-xl border border-gray-100">
        {{ __('Jangan khawatir. Beritahu kami alamat email Anda dan kami akan mengirimkan tautan reset password.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="mb-1 text-xs font-bold uppercase tracking-wider text-gray-500 ml-1" />
            <x-text-input id="email" class="block mt-1 w-full rounded-xl border-gray-200 bg-gray-50 focus:border-green-500 focus:ring-green-500/20 py-3" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <button type="submit" class="w-full bg-gray-900 text-white rounded-xl px-4 py-3.5 font-bold shadow-lg hover:bg-black transition-all transform hover:-translate-y-1 hover:shadow-xl flex justify-center items-center gap-2">
                {{ __('Kirim Link Reset Password') }}
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </button>
        </div>
        
        <div class="text-center mt-6">
            <a href="{{ route('login') }}" class="text-sm font-bold text-gray-900 hover:text-green-600 transition-colors">Kembali ke Login</a>
        </div>
    </form>
</x-guest-layout>

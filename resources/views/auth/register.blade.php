<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Bergabung Bersama Kami</h2>
        <p class="text-gray-500 mt-2 text-sm">Buat akun untuk mulai meminjam buku.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="mb-1 text-xs font-bold uppercase tracking-wider text-gray-500 ml-1" />
            <x-text-input id="name" class="block mt-1 w-full rounded-xl border-gray-200 bg-gray-50 focus:border-green-500 focus:ring-green-500/20 py-3" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama Lengkap" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="mb-1 text-xs font-bold uppercase tracking-wider text-gray-500 ml-1" />
            <x-text-input id="email" class="block mt-1 w-full rounded-xl border-gray-200 bg-gray-50 focus:border-green-500 focus:ring-green-500/20 py-3" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="mb-1 text-xs font-bold uppercase tracking-wider text-gray-500 ml-1" />

            <x-text-input id="password" class="block mt-1 w-full rounded-xl border-gray-200 bg-gray-50 focus:border-green-500 focus:ring-green-500/20 py-3"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Minimal 8 karakter" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="mb-1 text-xs font-bold uppercase tracking-wider text-gray-500 ml-1" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-xl border-gray-200 bg-gray-50 focus:border-green-500 focus:ring-green-500/20 py-3"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-gray-900 text-white rounded-xl px-4 py-3.5 font-bold shadow-lg hover:bg-black transition-all transform hover:-translate-y-1 hover:shadow-xl flex justify-center items-center gap-2">
                {{ __('Daftar Sekarang') }}
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </div>
        
        <div class="text-center mt-6">
            <p class="text-sm text-gray-500">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-bold text-gray-900 hover:text-green-600 transition-colors">Masuk disini</a>
            </p>
        </div>
    </form>
</x-guest-layout>

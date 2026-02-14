<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Verifikasi Email</h2>
    </div>

    <div class="mb-6 text-sm text-gray-600 bg-gray-50 p-4 rounded-xl border border-gray-100">
        {{ __('Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan ke email Anda? Jika Anda tidak menerima email tersebut, kami dengan senang hati akan mengirimkan yang baru.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-xl border border-green-100">
            {{ __('Tautan verifikasi baru telah dikirimkan ke alamat email yang Anda berikan saat pendaftaran.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between gap-4 flex-col md:flex-row">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full">
            @csrf

            <button type="submit" class="w-full bg-gray-900 text-white rounded-xl px-4 py-3.5 font-bold shadow-lg hover:bg-black transition-all transform hover:-translate-y-1 hover:shadow-xl">
                {{ __('Kirim Ulang Email Verifikasi') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf

            <button type="submit" class="w-full bg-white text-gray-900 border border-gray-200 rounded-xl px-4 py-3.5 font-bold hover:bg-gray-50 transition-colors shadow-sm">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>

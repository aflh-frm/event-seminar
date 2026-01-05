<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Peserta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white border-l-4 border-blue-600 shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-1">Halo, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-gray-500 text-sm">Selamat datang kembali di EventPro. Siap mencari ilmu baru hari
                        ini?</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                <a href="{{ url('/') }}"
                    class="block p-6 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 group relative overflow-hidden">
                    <div class="relative z-10 flex items-center justify-between text-white">
                        <div>
                            <h4 class="text-2xl font-bold mb-2">Cari Event Seru</h4>
                            <p class="text-blue-100 text-sm font-medium">Jelajahi seminar & workshop terbaru.</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-full group-hover:bg-white/30 transition backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-white/10 rounded-full"></div>
                </a>

                <a href="{{ route('user.transactions.index') }}"
                    class="block p-6 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition transform hover:-translate-y-1 group">
                    <div class="flex items-center justify-between text-gray-800">
                        <div>
                            <h4 class="text-2xl font-bold mb-2 group-hover:text-blue-600 transition">Tiket Saya</h4>
                            <p class="text-gray-500 text-sm">Cek status pembayaran & download tiket.</p>
                        </div>
                        <div class="bg-blue-50 p-3 rounded-full group-hover:bg-blue-100 transition">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            <div class="mb-6 flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-900">Rekomendasi Event Untukmu</h3>
                <a href="{{ url('/') }}" class="text-sm text-blue-600 hover:text-blue-800 font-semibold">Lihat Semua
                    &rarr;</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($events as $event)
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition duration-300 group">
                        <div class="relative h-48 overflow-hidden bg-gray-200">
                            @if($event->banner)
                                <img src="{{ asset('storage/' . $event->banner) }}" alt="{{ $event->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                            <div
                                class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-blue-600 shadow-sm">
                                {{ $event->category->name ?? 'Umum' }}
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="text-xs text-gray-500 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                            </div>

                            <h3
                                class="text-xl font-bold text-gray-900 mb-2 line-clamp-1 group-hover:text-blue-600 transition">
                                {{ $event->title }}
                            </h3>

                            <p class="text-gray-500 text-sm line-clamp-2 mb-4">
                                {{ $event->description }}
                            </p>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                                <div>
                                    <span class="text-xs text-gray-400 uppercase font-bold">Harga Tiket</span>
                                    <div class="text-lg font-bold text-blue-600">
                                        {{ $event->price == 0 ? 'GRATIS' : 'Rp ' . number_format($event->price, 0, ',', '.') }}
                                    </div>
                                </div>

                                <form action="{{ route('user.event.book', $event->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin mendaftar?');">
                                    @csrf
                                    <button type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition shadow-md hover:shadow-lg">
                                        Daftar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-10 text-gray-500">
                        Belum ada event yang tersedia saat ini.
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pembayaran Tiket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-6 border-b pb-4">
                    <h3 class="text-lg font-bold text-gray-900">{{ $transaction->event->title }}</h3>
                    <p class="text-gray-600">Total Tagihan: <span class="font-bold text-blue-600">Rp
                            {{ number_format($transaction->event->price, 0, ',', '.') }}</span></p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div>
                        <h4 class="font-bold text-gray-700 mb-3">Transfer ke salah satu rekening berikut:</h4>

                        @if($banks->isEmpty())
                            <div class="p-4 bg-red-50 text-red-600 rounded-lg text-sm">
                                EO belum memasukkan data rekening. Silakan hubungi panitia.
                            </div>
                        @else
                            <div class="space-y-3">
                                @foreach($banks as $bank)
                                    <div class="flex items-center p-3 border rounded-lg bg-gray-50">
                                        @if($bank->logo)
                                            <img src="{{ asset('storage/' . $bank->logo) }}"
                                                class="w-12 h-12 object-contain mr-3 bg-white rounded">
                                        @else
                                            <div
                                                class="w-12 h-12 bg-gray-200 rounded mr-3 flex items-center justify-center text-xs font-bold text-gray-500">
                                                BANK</div>
                                        @endif
                                        <div>
                                            <p class="font-bold text-gray-800">{{ $bank->bank_name }}</p>
                                            <p class="text-sm text-gray-600">{{ $bank->account_number }}</p>
                                            <p class="text-xs text-gray-500 uppercase">a.n {{ $bank->account_holder }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div>
                        <h4 class="font-bold text-gray-700 mb-3">Upload Bukti Transfer</h4>

                        <form action="{{ route('user.transactions.upload', $transaction->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Bukti / Struk</label>
                                <input type="file" name="payment_proof" class="block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-full file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-blue-50 file:text-blue-700
                                  hover:file:bg-blue-100" required>
                                @error('payment_proof')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                                Kirim Bukti Pembayaran
                            </button>

                            <a href="{{ route('user.transactions.index') }}"
                                class="block text-center mt-3 text-sm text-gray-500 hover:text-gray-700">
                                Kembali
                            </a>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@extends('layouts.eo.app')

@section('header', 'Buat Event Baru')

@section('content')

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">

            <form action="{{ route('eo.events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Judul Event</label>
                    <input type="text" name="title" class="w-full border-gray-300 border p-2 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200" placeholder="Contoh: Seminar Bisnis Digital 2025" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Kategori</label>
                    <select name="category_id" class="w-full border-gray-300 border p-2 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                    <textarea name="description" rows="5" class="w-full border-gray-300 border p-2 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200" placeholder="Jelaskan detail acaramu di sini..." required></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Tanggal Pelaksanaan</label>
                        <input type="date" name="event_date" class="w-full border-gray-300 border p-2 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Lokasi</label>
                        <input type="text" name="location" class="w-full border-gray-300 border p-2 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200" placeholder="Contoh: Zoom Meeting / Hotel Pangeran" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Kuota Peserta</label>
                        <input type="number" name="quota" class="w-full border-gray-300 border p-2 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200" placeholder="Contoh: 100" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Harga Tiket (Rp)</label>
                        <input type="number" name="price" class="w-full border-gray-300 border p-2 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200" placeholder="0 jika gratis" required>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Poster Event</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col w-full h-32 border-2 border-dashed border-blue-200 hover:bg-blue-50 hover:border-blue-300 rounded-lg cursor-pointer transition duration-200">
                            <div class="flex flex-col items-center justify-center pt-7">
                                <svg class="w-8 h-8 text-blue-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-blue-600">Klik untuk upload gambar</p>
                            </div>
                            <input type="file" name="banner" class="opacity-0" />
                        </label>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2 rounded-lg transition duration-200 shadow-md transform hover:scale-105">
                        Simpan Event
                    </button>
                    <a href="{{ route('eo.events.index') }}" class="text-gray-500 hover:text-gray-800 font-medium transition duration-200 underline">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

@endsection
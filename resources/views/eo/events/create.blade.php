<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Buat Event Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('eo.events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700">Judul Event</label>
                        <input type="text" name="title" class="w-full border p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Kategori</label>
                        <select name="category_id" class="w-full border p-2 rounded">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Deskripsi</label>
                        <textarea name="description" class="w-full border p-2 rounded" required></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-gray-700">Tanggal</label>
                            <input type="date" name="event_date" class="w-full border p-2 rounded" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Lokasi</label>
                            <input type="text" name="location" class="w-full border p-2 rounded" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-gray-700">Kuota Peserta</label>
                            <input type="number" name="quota" class="w-full border p-2 rounded" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Harga Tiket (0 jika gratis)</label>
                            <input type="number" name="price" class="w-full border p-2 rounded" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Poster Event</label>
                        <input type="file" name="banner" class="w-full border p-2 rounded">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Event</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
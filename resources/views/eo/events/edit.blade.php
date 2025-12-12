<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Event: {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('eo.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <div class="mb-4">
                        <label class="block text-gray-700">Judul Event</label>
                        <input type="text" name="title" value="{{ $event->title }}" class="w-full border p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Kategori</label>
                        <select name="category_id" class="w-full border p-2 rounded">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $event->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Deskripsi</label>
                        <textarea name="description" class="w-full border p-2 rounded" required>{{ $event->description }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-gray-700">Tanggal</label>
                            <input type="date" name="event_date" value="{{ $event->event_date }}" class="w-full border p-2 rounded" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Lokasi</label>
                            <input type="text" name="location" value="{{ $event->location }}" class="w-full border p-2 rounded" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-gray-700">Kuota Peserta</label>
                            <input type="number" name="quota" value="{{ $event->quota }}" class="w-full border p-2 rounded" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Harga Tiket</label>
                            <input type="number" name="price" value="{{ $event->price }}" class="w-full border p-2 rounded" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Ganti Poster (Biarkan kosong jika tidak ingin mengganti)</label>
                        <input type="file" name="banner" class="w-full border p-2 rounded">
                        @if($event->banner)
                            <p class="text-sm text-gray-500 mt-1">Poster saat ini: <a href="{{ asset('storage/'.$event->banner) }}" target="_blank" class="text-blue-500">Lihat Gambar</a></p>
                        @endif
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Event</button>
                    <a href="{{ route('eo.events.index') }}" class="text-gray-600 ml-4">Batal</a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
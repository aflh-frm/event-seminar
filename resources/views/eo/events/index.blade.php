<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Event Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <a href="{{ route('eo.events.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
                    + Tambah Event Baru
                </a>

                <table class="w-full table-auto border-collapse border border-gray-300 mt-4">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">No</th>
                            <th class="border p-2">Judul Event</th>
                            <th class="border p-2">Tanggal</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        <tr>
                            <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border p-2">{{ $event->title }}</td>
                            <td class="border p-2">{{ $event->event_date }}</td>
                            <td class="border p-2 text-center">
                                <span class="px-2 py-1 rounded text-white {{ $event->status == 'published' ? 'bg-green-500' : 'bg-gray-500' }}">
                                    {{ $event->status }}
                                </span>
                            </td>
                            <td class="border p-2 text-center">
                                <a href="{{ route('eo.events.edit', $event->id) }}" class="text-blue-500 hover:underline">Edit</a> 
                                
                                <span class="mx-1">|</span>
                                
                                <form action="{{ route('eo.events.destroy', $event->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus event ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
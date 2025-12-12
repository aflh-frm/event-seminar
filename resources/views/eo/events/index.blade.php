@extends('layouts.eo.app')

@section('header', 'Kelola Event Saya')

@section('content')

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('eo.events.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded-lg shadow-md transition duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Event Baru
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
            
            <div class="overflow-x-auto">
                <table class="w-full table-auto text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-600 uppercase text-xs font-bold tracking-wider">
                            <th class="p-4 border-b">No</th>
                            <th class="p-4 border-b">Judul Event</th>
                            <th class="p-4 border-b">Kategori</th>
                            <th class="p-4 border-b">Tanggal</th>
                            <th class="p-4 border-b text-center">Status</th>
                            <th class="p-4 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                        @forelse($events as $event)
                        <tr class="hover:bg-slate-50 transition duration-150">
                            <td class="p-4 text-center font-medium">{{ $loop->iteration }}</td>
                            <td class="p-4 font-semibold text-gray-800">{{ $event->title }}</td>
                            <td class="p-4 text-gray-500">{{ $event->category->name ?? '-' }}</td>
                            <td class="p-4">{{ $event->event_date }}</td>
                            <td class="p-4 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-bold 
                                    {{ $event->status == 'published' ? 'bg-green-100 text-green-700' : 
                                      ($event->status == 'closed' ? 'bg-red-100 text-red-700' : 'bg-gray-200 text-gray-700') }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <a href="{{ route('eo.events.edit', $event->id) }}" class="text-blue-500 hover:text-blue-700 font-medium transition">
                                        Edit
                                    </a> 
                                    
                                    <span class="text-gray-300">|</span>
                                    
                                    <form action="{{ route('eo.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus event ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-medium transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-400">
                                Belum ada event yang dibuat.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
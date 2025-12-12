<aside class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-white shadow-2xl transition-transform duration-300 ease-in-out transform md:translate-x-0">
    
    <div class="flex items-center justify-center h-20 border-b border-slate-700 bg-slate-900">
        <h1 class="text-2xl font-bold tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400">
            EVENT PRO
        </h1>
    </div>

    <nav class="mt-8 px-4 space-y-3">
        
        <a href="{{ route('eo.dashboard') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group
           {{ request()->routeIs('eo.dashboard') 
              ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30 font-semibold' 
              : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            Dashboard
        </a>

        <a href="{{ route('eo.events.index') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group
           {{ request()->routeIs('eo.events.*') 
              ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30 font-semibold' 
              : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Kelola Event
        </a>

        <a href="{{ route('eo.participants.index') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group
           {{ request()->routeIs('eo.participants.*') 
              ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30 font-semibold' 
              : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            Validasi Peserta
        </a>

    </nav>

    <div class="absolute bottom-0 w-full p-6 border-t border-slate-700 bg-slate-900">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center text-slate-400 hover:text-red-400 transition-colors duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Keluar Aplikasi
            </button>
        </form>
    </div>
</aside>
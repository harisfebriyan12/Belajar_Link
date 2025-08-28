<header class="bg-white-700 text-white shadow-lg px-6 py-4 flex items-center justify-between sticky top-0 z-30">
    <!-- Toggle Button -->
    <button @click="collapsed = !collapsed" class="text-white focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" view极="0 0 24 24">

        </svg>
    </button>
    <!-- User Info with Dropdown -->
    <div class="flex items-center space-x-4" x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center focus:outline-none">
            <div class="w-8 h-8 rounded-full bg-blue-900 flex items-center justify-center text-white font-bold text-sm">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <span class="ml-2 text-sm hidden md:inline text-blue-900">{{ auth()->user()->email }}</span>
        </button>

        <!-- Dropdown Menu -->
        <div x-show="open" @click.away="open = false" class="absolute right-4 mt-36 w-48 bg-white rounded-md shadow-lg py-1 z-50">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>

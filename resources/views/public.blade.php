<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    {{-- Menggunakan Tailwind CSS via CDN untuk kemudahan --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Sedikit custom style untuk font dan line-clamp */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
        .line-clamp-1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-900 to-gray-900 text-white min-h-screen">

    <div class="container mx-auto px-4 py-8 md:py-16">

        <main class="max-w-3xl mx-auto">

            {{-- Bagian Header: Avatar, Judul, dan Deskripsi --}}
            <header class="text-center mb-12">
                @if ($pageAvatar)
                    <img src="{{ asset('storage/' . $pageAvatar) }}" alt="Avatar"
                        class="w-29 h-40 rounded-full mx-auto mb-4 border-4 border-white/70 shadow-lg object-cover">
                @else
                    {{-- Fallback jika tidak ada avatar --}}
                    <div
                        class="w-28 h-28 rounded-full mx-auto mb-4 bg-white/20 flex items-center justify-center text-4xl font-bold border-4 border-white/50 shadow-lg">
                        {{ substr($pageTitle, 0, 1) }}
                    </div>
                @endif

                <h1 class="text-4xl font-bold text-white tracking-tight">{{ $pageTitle }}</h1>
                <p class="text-lg text-blue-200 mt-2 max-w-xl mx-auto">{{ $pageDescription }}</p>
            </header>

            {{-- Bagian Link --}}
            <div class="space-y-4">
                @forelse ($links as $link)
                    <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"
                        class="group flex items-center p-4 bg-white rounded-xl w-full text-left hover:bg-gray-100 transition-all duration-300 ease-in-out transform hover:scale-[1.02] shadow-lg">
                        {{-- Gambar/Ikon Link --}}
                        <div class="flex-shrink-0 mr-4">
                            @if ($link->gambar)
                                <img src="{{ $link->gambar_url }}" alt="{{ $link->judul }}"
                                    class="w-12 h-12 rounded-lg object-cover shadow-md">
                            @else
                                <div
                                    class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center text-xl font-bold text-gray-400 group-hover:bg-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        {{-- Judul & Deskripsi Link --}}
                        <div class="flex-grow">
                            <h3 class="font-semibold text-lg text-gray-800">{{ $link->judul }}</h3>
                            @if($link->deskripsi)
                                <p class="text-sm text-gray-500 mt-1 line-clamp-1">{{ $link->deskripsi }}</p>
                            @endif
                        </div>
                        {{-- Tanggal Dibuat --}}
                        <div class="flex-shrink-0 ml-4 text-right">
                            <p class="text-xs text-gray-400">
                                {{ $link->created_at->format('d M Y') }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="text-center text-gray-600 bg-white p-6 rounded-xl shadow-lg">
                        <p>Belum ada link yang ditambahkan.</p>
                    </div>
                @endforelse
            </div>
        </main>
    </div>
</body>
</html>

@extends('layouts.sidebar')

@section('content')
<div class="py-12 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Tambah Link Baru</h1>
            <p class="text-sm text-gray-500">Isi form di bawah untuk menambahkan link baru ke dalam portal.</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <form action="{{ route('links.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
                        <input type="text" name="judul" id="judul" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-600 focus:border-blue-600 transition" required value="{{ old('judul') }}">
                        @error('judul')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-600 focus:border-blue-600 transition" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="url" class="block text-sm font-medium text-gray-700 mb-2">URL</label>
                        <input type="url" name="url" id="url" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-600 focus:border-blue-600 transition" required placeholder="https://example.com" value="{{ old('url') }}">
                        @error('url')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                        <input type="file" name="gambar" id="gambar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition" accept="image/*" required>
                        @error('gambar')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex justify-end items-center gap-4 pt-4">
                        <a href="{{ route('links.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800 rounded-lg bg-gray-100 hover:bg-gray-200 transition-all duration-200">
                            Batal
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:bg-blue-800 transition-all duration-200">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

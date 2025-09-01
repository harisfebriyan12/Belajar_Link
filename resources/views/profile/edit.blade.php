@extends('layouts.sidebar')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Form untuk Update Informasi Profil --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Profil</h3>
                    <p class="mt-1 mb-4 text-sm text-gray-600">
                        Perbarui informasi profil, alamat email, dan foto profil akun Anda.
                    </p>

                    @if (session('status') === 'profile-updated')
                        <div class="mb-4 font-medium text-sm text-green-600">
                            Informasi profil berhasil disimpan.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <label for="photo" class="block text-gray-700">Foto Profil</label>
                            @if ($user->profile_photo_path)
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Foto Profil" class="w-20 h-20 rounded-full object-cover my-2">
                            @endif
                            <input type="file" name="photo" id="photo" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @error('photo', 'updateProfileInformation')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Nama</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required autofocus>
                            @error('name', 'updateProfileInformation')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                             @error('email', 'updateProfileInformation')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="bg-blue-900 hover:bg-blue-800 text-white px-4 py-2 rounded-md transition-colors duration-200">Simpan Perubahan</button>
                    </form>
                </div>
            </div>

            {{-- Form untuk Ganti Password --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Ganti Password</h3>
                    <p class="mt-1 mb-4 text-sm text-gray-600">
                        Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.
                    </p>

                    @if (session('status') === 'password-updated')
                        <div class="mb-4 font-medium text-sm text-green-600">
                            Password berhasil diperbarui.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="current_password" class="block text-gray-700">Password Lama</label>
                            <input type="password" name="current_password" id="current_password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('current_password', 'updatePassword')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700">Password Baru</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('password', 'updatePassword')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-gray-700">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <button type="submit" class="bg-blue-900 hover:bg-blue-800 text-white px-4 py-2 rounded-md transition-colors duration-200">Ganti Password</button>
                    </form>
                </div>
            </div>

            {{-- Form untuk Hapus Akun --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Hapus Akun</h3>
                    <p class="mt-1 mb-4 text-sm text-gray-600">
                        Setelah akun Anda dihapus, semua datanya akan dihapus secara permanen. Harap unduh data apa pun yang ingin Anda simpan sebelum melanjutkan.
                    </p>
                    <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini secara permanen?');">
                        @csrf
                        @method('DELETE')
                        <div class="mb-4">
                            <label for="password_delete" class="block text-gray-700">Password</label>
                            <input type="password" name="password" id="password_delete" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required placeholder="Masukkan password untuk konfirmasi">
                            @error('password', 'userDeletion')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md transition-colors duration-200">Hapus Akun</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

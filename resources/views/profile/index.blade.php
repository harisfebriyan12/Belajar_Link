@extends('layouts.sidebar')

@section('content')
<div class="py-6 md:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Pengaturan Akun</h1>
            <p class="mt-1 text-md text-gray-600">Kelola informasi profil, preferensi, dan keamanan akun Anda.</p>
        </header>

        <div class="space-y-8">
            {{-- Form untuk Update Informasi Profil --}}
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 sm:p-8">
                    <header>
                        <h3 class="text-xl font-semibold text-gray-900">Informasi Profil</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Perbarui informasi profil, alamat email, dan foto profil akun Anda.
                        </p>
                    </header>

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700">Foto Profil</label>
                            <div class="mt-2 flex items-center gap-4">
                                @if ($user->profile_photo_path)
                                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Foto Profil" class="h-20 w-20 rounded-full object-cover">
                                @else
                                    <span class="inline-block h-20 w-20 rounded-full overflow-hidden bg-gray-100">
                                        <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.997A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    </span>
                                @endif
                                <input type="file" name="photo" id="photo" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </div>
                            @error('photo', 'updateProfileInformation')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required autofocus>
                            @error('name', 'updateProfileInformation')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                             @error('email', 'updateProfileInformation')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-blue-900 hover:bg-blue-800 text-white px-5 py-2.5 rounded-lg transition-colors duration-200 font-semibold">Simpan Perubahan</button>
                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-green-600 font-medium">Tersimpan.</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- Form untuk Ganti Password --}}
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 sm:p-8">
                    <header>
                        <h3 class="text-xl font-semibold text-gray-900">Ganti Password</h3>
                        <p class="mt-1 text-sm text-gray-500">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
                    </header>

                    <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700">Password Lama</label>
                            <input type="password" name="current_password" id="current_password" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @error('current_password', 'updatePassword')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @error('password', 'updatePassword')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-blue-900 hover:bg-blue-800 text-white px-5 py-2.5 rounded-lg transition-colors duration-200 font-semibold">Ganti Password</button>
                            @if (session('status') === 'password-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-green-600 font-medium">Tersimpan.</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- Form untuk Hapus Akun --}}
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 sm:p-8">
                    <header>
                        <h3 class="text-xl font-semibold text-red-700">Hapus Akun</h3>
                        <p class="mt-1 text-sm text-gray-500">Setelah akun Anda dihapus, semua datanya akan dihapus secara permanen. Tindakan ini tidak dapat diurungkan.</p>
                    </header>
                    <form id="delete-user-form" method="POST" action="{{ route('profile.destroy') }}" class="mt-6">
                        @csrf
                        @method('DELETE')
                        <div>
                            <label for="password_delete" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                            <input type="password" name="password" id="password_delete" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500" required placeholder="Masukkan password Anda untuk konfirmasi">
                            @error('password', 'userDeletion')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="mt-4 bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-lg transition-colors duration-200 font-semibold delete-account-btn">Hapus Akun</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // SweetAlert for profile update success
    @if (session('status') === 'profile-updated')
        Swal.fire({
            icon: 'success',
            title: 'Profil berhasil diperbarui!',
            text: 'Perubahan profil Anda telah tersimpan.',
            confirmButtonColor: '#1e3a8a'
        });
    @endif
    // SweetAlert for password update success
    @if (session('status') === 'password-updated')
        Swal.fire({
            icon: 'success',
            title: 'Password berhasil diganti!',
            text: 'Password baru Anda telah tersimpan.',
            confirmButtonColor: '#1e3a8a'
        });
    @endif
    // SweetAlert for validation errors
    @if ($errors->any())
        @if ($errors->updatePassword->has('current_password'))
             Swal.fire({
                icon: 'error',
                title: 'Password Lama Salah',
                text: '{{ $errors->updatePassword->first('current_password') }}',
                confirmButtonText: 'OK',
                confirmButtonColor: '#1e3a8a'
            });
        @else
             Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                html: '{!! implode('<br>', $errors->all()) !!}',
                confirmButtonText: 'OK',
                confirmButtonColor: '#1e3a8a'
            });
        @endif
    @elseif (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
            confirmButtonText: 'OK',
            confirmButtonColor: '#1e3a8a'
        });
    @endif
    // Existing delete account SweetAlert
    const deleteForm = document.getElementById('delete-user-form');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda benar-benar yakin?',
                text: "Tindakan ini tidak dapat diurungkan. Semua data Anda, termasuk link dan pengaturan, akan dihapus secara permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#2563eb',
                confirmButtonText: 'Ya, hapus akun saya!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const deleteButton = deleteForm.querySelector('.delete-account-btn');
                    deleteButton.innerHTML = 'Menghapus...';
                    deleteButton.disabled = true;
                    deleteForm.submit();
                }
            });
        });
    }
});
</script>
@endpush

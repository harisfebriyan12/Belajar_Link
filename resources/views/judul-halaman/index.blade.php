@extends('layouts.sidebar')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui/material-ui.css">
<style>
    .modal-content {
        transition: all 0.3s ease-in-out;
    }
    .table-row {
        transition: all 0.2s ease;
    }
    .table-row:hover {
        transform: translateY(-2px);
    }
    .action-button {
        transition: all 0.2s ease;
    }
    .action-button:hover {
        transform: scale(1.05);
    }
    .header-underline {
        transition: width 0.4s ease;
    }
    h1:hover + .header-underline {
        width: 120px;
    }
    .modal-enter-active {
        animation: modal-enter 0.3s ease-in-out;
    }
    @keyframes modal-enter {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
</style>
@endpush

@section('content')
<!-- Main Content Container -->
<div class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Manajemen Judul Halaman</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola judul, deskripsi, status aktif, dan avatar untuk halaman publik Anda.</p>
            </div>
            <button onclick="openModal()"
    class="bg-blue-900 hover:bg-blue-800 text-white p-3 rounded shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
    </svg>
</button>

        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-blue-900">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white uppercase tracking-wider">Gambar</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white uppercase tracking-wider">Dibuat</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white uppercase tracking-wider">Di perbaharui</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($judulHalamans as $index => $judul)
                            <tr class="hover:bg-gray-50 transition-colors duration-200 align-middle">
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($judul->images)
                                        <img src="{{ asset('storage/' . $judul->images) }}" alt="Avatar" class="h-10 w-10 rounded-full object-cover">
                                    @else
                                        <span class="inline-block h-10 w-10 rounded-full overflow-hidden bg-gray-100">
                                            <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.997A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $judul->judul }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $judul->deskripsi }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <button onclick="toggleStatus({{ $judul->id }}, {{ !$judul->is_active }}, '{{ e($judul->judul) }}')"
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium transition-colors
                                                   {{ $judul->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }}">
                                        <span class="w-2 h-2 mr-2 rounded-full {{ $judul->is_active ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                        {{ $judul->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                    </button>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $judul->created_at->format('d M Y, H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $judul->updated_at->format('d M Y, H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <button onclick="editJudul({{ $judul->id }}, '{{ e($judul->judul) }}', '{{ e($judul->deskripsi) }}', {{ $judul->is_active ? 'true' : 'false' }}, {{ $judul->images ? "'" . asset('storage/' . $judul->images) . "'" : 'null' }})"
                                                class="p-2 text-blue-600 hover:text-blue-900 hover:bg-blue-100 rounded-full transition-colors duration-200" title="Edit">
                                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </button>
                                        <button onclick="confirmDelete({{ $judul->id }}, '{{ e($judul->judul) }}')"
                                                class="p-2 text-red-600 hover:text-red-900 hover:bg-red-100 rounded-full transition-colors duration-200" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-8 text-center text-gray-500 text-lg">
                                    Belum ada judul halaman yang tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t">
                {{ $judulHalamans->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Form -->
    <div id="formModal" class="fixed inset-0 bg-gray-900 bg-opacity-70 hidden flex items-center justify-center z-50 transition-opacity duration-300">
        <div class="relative bg-white rounded-2xl shadow-2xl p-8 w-full max-w-lg modal-content">
            <form id="judulForm" method="POST" class="space-y-6" enctype="multipart/form-data">
                @csrf
                <div id="methodField"></div>
                <h3 class="text-2xl font-semibold text-gray-900" id="modalTitle">Tambah Judul Baru</h3>

                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="judul" id="judul" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-600 focus:ring-blue-600 transition duration-150" required>
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-600 focus:ring-blue-600 transition duration-150"></textarea>
                </div>

                <div>
                    <label for="images" class="block text-sm font-medium text-gray-700">Avatar (Opsional)</label>
                    <div class="mt-2 flex items-center space-x-4">
                        <img id="image-preview" src="#" alt="Image Preview" class="h-16 w-16 rounded-full object-cover hidden">
                        <div class="flex-1">
                            <input type="file" name="images" id="images" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition duration-150">
                            <p id="image-help-text" class="mt-1 text-xs text-gray-500 hidden">
                                Ganti gambar di atas dengan memilih file baru.
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                        <span class="ml-2 text-sm font-medium text-gray-600">Aktifkan Judul Ini</span>
                    </label>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal()" class="px-5 py-2.5 text-gray-600 hover:text-gray-800 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-150">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-blue-900 to-blue-900 text-white rounded-lg hover:shadow-lg transition duration-150">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function openModal() {
        const modal = document.getElementById('formModal');
        const form = document.getElementById('judulForm');
        modal.classList.remove('hidden');
        modal.querySelector('.modal-content').classList.add('modal-enter-active');
        document.getElementById('modalTitle').textContent = 'Tambah Judul Baru';
        form.reset();
        document.getElementById('image-preview').classList.add('hidden');
        document.getElementById('image-help-text').classList.add('hidden');
        form.action = "{{ route('judul-halaman.store') }}";
        document.getElementById('methodField').innerHTML = '';
    }

    function closeModal() {
        const modal = document.getElementById('formModal');
        modal.querySelector('.modal-content').classList.remove('modal-enter-active');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    function editJudul(id, judul, deskripsi, isActive, imageUrl) {
        const modal = document.getElementById('formModal');
        modal.classList.remove('hidden');
        modal.querySelector('.modal-content').classList.add('modal-enter-active');
        document.getElementById('modalTitle').textContent = 'Edit Judul';
        document.getElementById('judul').value = judul;
        document.getElementById('deskripsi').value = deskripsi;
        document.getElementById('is_active').checked = isActive;

        const imagePreview = document.getElementById('image-preview');
        const imageHelpText = document.getElementById('image-help-text');
        if (imageUrl) {
            imagePreview.src = imageUrl;
            imagePreview.classList.remove('hidden');
            imageHelpText.classList.remove('hidden');
        } else {
            imagePreview.classList.add('hidden');
            imageHelpText.classList.add('hidden');
        }
        document.getElementById('images').value = '';
        document.getElementById('judulForm').action = `/judul-halaman/${id}`;
        document.getElementById('methodField').innerHTML = `{!! method_field('PUT') !!}`;
    }

    function confirmDelete(id, judul) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: `Apakah Anda yakin ingin menghapus judul "${judul}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1e3a8a',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/judul-halaman/${id}`;
                form.innerHTML = `{!! csrf_field() !!} {!! method_field('DELETE') !!}`;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    function toggleStatus(id, newStatus, judul) {
        const statusText = newStatus ? 'mengaktifkan' : 'menonaktifkan';
        Swal.fire({
            title: 'Konfirmasi Perubahan Status',
            text: `Apakah Anda yakin ingin ${statusText} judul "${judul}"?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3b82f6',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Ubah',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/judul-halaman/${id}/toggle-status`;
                form.innerHTML = `{!! csrf_field() !!} {!! method_field('PUT') !!}<input type="hidden" name="is_active" value="${newStatus}">`;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // Close modal when clicking outside
    document.getElementById('formModal').addEventListener('click', (e) => {
        if (e.target === document.getElementById('formModal')) {
            closeModal();
        }
    });

    // Lazy load animation for table rows
    document.addEventListener('DOMContentLoaded', () => {
        const rows = document.querySelectorAll('.table-row');
        rows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateY(10px)';
            setTimeout(() => {
                row.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Preview image on file input change
        document.getElementById('images').addEventListener('change', function(event) {
            const preview = document.getElementById('image-preview');
            const file = event.target.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                document.getElementById('image-help-text').classList.add('hidden');
                preview.classList.remove('hidden');
            }
        });
    });
</script>
@endpush

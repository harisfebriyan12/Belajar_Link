@extends('layouts.sidebar')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    .modal-bg {
        transition: opacity 0.4s ease;
        background-color: rgba(0, 0, 0, 0.5); /* Efek layar gelap */
    }

    .modal-content {
        transition: all 0.4s ease;
    }
    .table-row {
        transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .table-row:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .action-btn {
        transition: all 0.3s ease;
    }
    .action-btn:hover {
        transform: scale(1.1);
    }
    .pagination {
        display: flex;
        gap: 8px;
        justify-content: center;
        align-items: center;
        margin-top: 1.5rem;
    }
    .pagination a, .pagination span {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        color: #2563eb;
        background: #f1f5f9;
    }
    .pagination a:hover {
        background: #2563eb;
        color: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    .pagination .current {
        background: #2563eb;
        color: white;
        font-weight: 600;
    }
    .search-container {
        transition: all 0.3s ease;
    }
    .search-container:focus-within {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .status-btn {
        transition: all 0.3s ease;
    }
    .status-btn:hover {
        transform: scale(1.05);
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    function openModal(modal) {
        if (!modal) return;
        const modalContent = modal.querySelector('.modal-content');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('opacity-0', '-translate-y-4');
            modalContent.classList.add('opacity-100', 'translate-y-0');
        }, 20);
    }

    function closeModal(modal) {
        if (!modal) return;
        const modalContent = modal.querySelector('.modal-content');
        modal.classList.add('opacity-0');
        modalContent.classList.add('opacity-0', '-translate-y-4');
        modalContent.classList.remove('opacity-100', 'translate-y-0');
        setTimeout(() => modal.classList.add('hidden'), 400);
    }

    function toggleLinkStatus(id, newStatus, judul) {
        const statusText = newStatus ? 'mengaktifkan' : 'menonaktifkan';
        Swal.fire({
            title: 'Konfirmasi Perubahan Status',
            text: `Apakah Anda yakin ingin ${statusText} link "${judul}"?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Ubah',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/links/${id}/toggle-status`;
                form.innerHTML = `<input type="hidden" name="_token" value="${csrfToken}"><input type="hidden" name="_method" value="PUT"><input type="hidden" name="is_active" value="${newStatus}">`;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    document.body.addEventListener('click', function(e) {
        // Modal Open
        const openBtn = e.target.closest('[data-modal-open]');
        if (openBtn) {
            e.preventDefault();
            openModal(document.getElementById(openBtn.dataset.modalOpen));
        }

        // Modal Close
        const closeBtn = e.target.closest('[data-modal-close]');
        if (closeBtn) {
            e.preventDefault();
            closeModal(document.getElementById(closeBtn.dataset.modalClose));
        }

        // Modal Background Close
        const modalBg = e.target.closest('.modal-bg');
        if (modalBg && e.target === modalBg) {
            closeModal(modalBg);
        }

        // Edit Modal Logic
        const editBtn = e.target.closest('.edit-link-btn');
        if (editBtn) {
            e.preventDefault();
            const modal = document.getElementById('edit-link-modal');
            const form = document.getElementById('edit-form');
            const linkId = editBtn.dataset.id;

            form.action = `/links/${linkId}`;
            document.getElementById('edit-id').value = linkId;
            document.getElementById('edit-judul').value = editBtn.dataset.judul;
            document.getElementById('edit-deskripsi').value = editBtn.dataset.deskripsi;
            document.getElementById('edit-url').value = editBtn.dataset.url;

            openModal(modal);
        }

        // Detail Modal Logic
        const detailBtn = e.target.closest('.detail-link-btn');
        if (detailBtn) {
            e.preventDefault();
            const modal = document.getElementById('detail-link-modal');
            const detailGambar = document.getElementById('detail-gambar');

            document.getElementById('detail-judul').textContent = detailBtn.dataset.judul;
            document.getElementById('detail-deskripsi').textContent = detailBtn.dataset.deskripsi;
            const detailUrl = document.getElementById('detail-url');
            detailUrl.href = detailBtn.dataset.url;
            detailUrl.textContent = detailBtn.dataset.url;
            if (detailBtn.dataset.gambar) {
                detailGambar.src = detailBtn.dataset.gambar;
                detailGambar.alt = `Gambar untuk ${detailBtn.dataset.judul}`;
                detailGambar.classList.remove('hidden');
            } else {
                detailGambar.classList.add('hidden');
            }
            document.getElementById('detail-created_at').textContent = detailBtn.dataset.created_at;
            document.getElementById('detail-updated_at').textContent = detailBtn.dataset.updated_at;

            openModal(modal);
        }

        // Delete Confirmation
        const deleteBtn = e.target.closest('.delete-button');
        if (deleteBtn) {
            e.preventDefault();
            const form = deleteBtn.closest('.delete-form');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });

    // Close modals on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modals = document.querySelectorAll('.modal-bg:not(.hidden)');
            modals.forEach(modal => closeModal(modal));
        }
    });

    window.toggleLinkStatus = toggleLinkStatus;
});
</script>
@endpush

@section('content')
<div class="py-12 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header and Search Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">Manajemen Link</h1>
                <button
                    class="bg-blue-900 hover:from-blue-700 hover:to-blue-900 text-white px-4 py-2 rounded-lg transition-all duration-300 flex items-center gap-2"
                    data-modal-open="tambah-link-modal"
                    aria-label="Tambah Link Baru">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 010 2h-3v3a1 1 0 01-2 0v-3H6a1 1 0 010-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <div class="search-container max-w-md">
                <form action="{{ route('links.index') }}" method="GET">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors duration-200" viewBox="0 0 24 24" fill="none">
                                <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        <input type="search" name="search"
                               placeholder="Cari berdasarkan judul atau deskripsi..."
                               value="{{ request('search') }}"
                               class="w-full pl-12 pr-4 py-3 rounded-lg border border-gray-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all duration-200 bg-gray-50 placeholder-gray-400"
                               aria-label="Cari link">
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-blue-900 to-blue-800">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Link</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($links as $index => $link)
                        <tr class="table-row bg-white">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-blue-100 text-blue-600 font-semibold">
                                    {{ $links->firstItem() + $index }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ Str::limit($link->judul, 30) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 line-clamp-2 max-w-md">{{ Str::limit($link->deskripsi, 50) }}</td>
                            <td class="px-6 py-4 text-sm text-blue-600">
                                <a href="{{ $link->url }}" target="_blank" class="hover:underline truncate block max-w-[150px] md:max-w-[250px]">{{ Str::limit($link->url, 25) }}</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-3">
                                    <button class="action-btn p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-100 rounded-full transition-colors duration-200 detail-link-btn"
                                            title="Detail {{ $link->judul }}"
                                            data-judul="{{ e($link->judul) }}"
                                            data-deskripsi="{{ e($link->deskripsi) }}"
                                            data-url="{{ e($link->url) }}"
                                            data-gambar="{{ $link->gambar ? asset('storage/' . $link->gambar) : '' }}"
                                            data-created_at="{{ $link->created_at->format('d M Y, H:i') }}"
                                            data-updated_at="{{ $link->updated_at->format('d M Y, H:i') }}"
                                            aria-label="Lihat detail {{ $link->judul }}">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <button class="action-btn p-2 text-green-600 hover:text-green-800 hover:bg-green-100 rounded-full transition-colors duration-200 edit-link-btn"
                                            title="Edit {{ $link->judul }}"
                                            data-id="{{ $link->id }}"
                                            data-judul="{{ e($link->judul) }}"
                                            data-deskripsi="{{ e($link->deskripsi) }}"
                                            data-url="{{ e($link->url) }}"
                                            aria-label="Edit {{ $link->judul }}">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <form action="{{ route('links.destroy', $link->id) }}" method="POST" class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="action-btn p-2 text-red-600 hover:text-red-800 hover:bg-red-100 rounded-full transition-colors duration-200 delete-button"
                                                title="Hapus {{ $link->judul }}"
                                                aria-label="Hapus {{ $link->judul }}">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-gray-500 text-lg">
                                @if(request('search'))
                                    Tidak ada link yang cocok dengan pencarian "{{ request('search') }}".
                                @else
                                    Tidak ada data link.
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($links->hasPages())
                <div class="px-6 py-4 bg-gray-50 border-t pagination">
                    {{ $links->links() }}
                </div>
            @endif
        </div>

        <!-- Modal Tambah Link -->
        <div id="tambah-link-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50 modal-bg">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-8 transform modal-content animate__animated animate__fadeIn">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Tambah Link Baru</h3>
                <form action="{{ route('links.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-5">
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
                        <input type="text" name="judul" id="judul" class="block w-full border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 py-3 px-4 transition-all duration-200" required>
                        @error('judul')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="block w-full border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 py-3 px-4 transition-all duration-200" required></textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                        <input type="file" name="gambar" id="gambar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 transition-all duration-200" accept="image/*" required>
                        @error('gambar')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="url" class="block text-sm font-medium text-gray-700 mb-2">Link</label>
                        <input type="url" name="url" id="url" class="block w-full border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 py-3 px-4 transition-all duration-200" required>
                        @error('url')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" class="px-4 py-2 text-gray-600 hover:text-gray-800 rounded-lg bg-gray-100 hover:bg-gray-200 transition-all duration-200" data-modal-close="tambah-link-modal" aria-label="Batal">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg hover:from-blue-700 hover:to-blue-900 transition-all duration-200" aria-label="Simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Edit Link -->
        <div id="edit-link-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50 modal-bg">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-8 transform modal-content animate__animated animate__fadeIn">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Edit Link</h3>
                <form id="edit-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-5">
                        <label for="edit-judul" class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
                        <input type="text" name="judul" id="edit-judul" class="block w-full border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 py-3 px-4 transition-all duration-200" required>
                        @error('judul')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="edit-deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" id="edit-deskripsi" rows="4" class="block w-full border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 py-3 px-4 transition-all duration-200" required></textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="edit-gambar" class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                        <input type="file" name="gambar" id="edit-gambar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 transition-all duration-200" accept="image/*">
                        <p class="mt-2 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengganti gambar</p>
                        @error('gambar')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="edit-url" class="block text-sm font-medium text-gray-700 mb-2">Link</label>
                        <input type="url" name="url" id="edit-url" class="block w-full border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 py-3 px-4 transition-all duration-200" required>
                        @error('url')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" class="px-4 py-2 text-gray-600 hover:text-gray-800 rounded-lg bg-gray-100 hover:bg-gray-200 transition-all duration-200" data-modal-close="edit-link-modal" aria-label="Batal">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:from-blue-700 hover:to-blue-900 transition-all duration-200" aria-label="Simpan Perubahan">Perbaharui</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Detail Link -->
        <div id="detail-link-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50 modal-bg">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg p-8 transform modal-content animate__animated animate__fadeIn">
                <div class="flex justify-between items-center border-b border-gray-200 pb-4 mb-6">
                    <h3 class="text-2xl font-semibold text-gray-900">Detail Link</h3>
                    <button type="button" class="text-gray-500 hover:text-gray-700 transition-all duration-200" data-modal-close="detail-link-modal" aria-label="Tutup">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="space-y-6">
                    <div>
                        <img id="detail-gambar" src="" alt="Gambar Link" class="w-full h-64 object-cover rounded-lg shadow-sm hidden">
                    </div>
                    <dl class="grid grid-cols-3 gap-x-4 gap-y-4">
                        <dt class="text-sm font-medium text-gray-600 col-span-1">Judul</dt>
                        <dd id="detail-judul" class="text-sm text-gray-900 col-span-2 font-medium"></dd>
                        <dt class="text-sm font-medium text-gray-600 col-span-1">Deskripsi</dt>
                        <dd id="detail-deskripsi" class="text-sm text-gray-900 col-span-2 whitespace-pre-wrap"></dd>
                        <dt class="text-sm font-medium text-gray-600 col-span-1">Link</dt>
                        <dd class="text-sm text-blue-600 col-span-2"><a id="detail-url" href="#" target="_blank" class="hover:underline break-all"></a></dd>
                        <dt class="text-sm font-medium text-gray-600 col-span-1">Dibuat</dt>
                        <dd id="detail-created_at" class="text-sm text-gray-900 col-span-2"></dd>
                        <dt class="text-sm font-medium text-gray-600 col-span-1">Diperbarui</dt>
                        <dd id="detail-updated_at" class="text-sm text-gray-900 col-span-2"></dd>
                    </dl>
                </div>
                <div class="flex justify-end mt-6 pt-4 border-t border-gray-200">
                    <button type="button" class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:from-blue-700 hover:to-blue-900 transition-all duration-200" data-modal-close="detail-link-modal" aria-label="Tutup">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
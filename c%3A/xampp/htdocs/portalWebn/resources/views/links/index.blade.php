// ... existing code ...
@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Daftar Link</h1>
        <button data-modal-open="create-link-modal" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-all duration-300 shadow-md">
            Tambah Link Baru
        </button>
    </div>

    @if(session('success'))
        <div id="success-alert" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 shadow-sm animate__animated animate__fadeInUp">
            <div class="flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button onclick="document.getElementById('success-alert').style.display='none'" class="text-green-700">&times;</button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div id="error-alert" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 shadow-sm animate__animated animate__fadeInUp">
            <div class="flex justify-between items-center">
                <span>{{ session('error') }}</span>
                <button onclick="document.getElementById('error-alert').style.display='none'" class="text-red-700">&times;</button>
            </div>
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-700">Manajemen Link</h2>
            <div class="w-1/3 search-container">
                <form action="{{ route('links.index') }}" method="GET">
                    <input type="text" name="search" placeholder="Cari link..." value="{{ request('search') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300">
                </form>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white responsive-table">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left py-3 px-4 font-semibold text-gray-600">No</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-600">Gambar</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-600">Judul</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-600">Status</th>
                        <th class="text-center py-3 px-4 font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($links as $index => $link)
                    <tr class="border-b border-gray-200 table-row">
                        <td data-label="No" class="py-4 px-4">{{ $links->firstItem() + $index }}</td>
                        <td data-label="Gambar" class="py-4 px-4">
                            <img src="{{ asset('storage/' . $link->gambar) }}" alt="{{ $link->judul }}" class="w-16 h-16 object-cover rounded-lg shadow-sm">
                        </td>
                        <td data-label="Judul" class="py-4 px-4 font-medium text-gray-800">{{ $link->judul }}</td>
                        <td data-label="Status" class="py-4 px-4">
                            <button
                                class="status-btn w-full text-white py-2 px-4 rounded-lg transition-all duration-300 {{ $link->is_active ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }}"
                                onclick="toggleLinkStatus('{{ $link->id }}', {{ $link->is_active ? '0' : '1' }}, '{{ $link->judul }}')">
                                {{ $link->is_active ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </td>
                        <td data-label="Aksi" class="py-4 px-4">
                            <div class="flex justify-center items-center space-x-3">
                                <button class="text-blue-500 hover:text-blue-700 action-btn detail-link-btn"
                                        data-modal-open="detail-link-modal"
                                        data-id="{{ $link->id }}"
                                        data-judul="{{ $link->judul }}"
                                        data-deskripsi="{{ $link->deskripsi }}"
                                        data-url="{{ $link->url }}"
                                        data-gambar="{{ asset('storage/' . $link->gambar) }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-yellow-500 hover:text-yellow-700 action-btn edit-link-btn"
                                        data-modal-open="edit-link-modal"
                                        data-id="{{ $link->id }}"
                                        data-judul="{{ $link->judul }}"
                                        data-deskripsi="{{ $link->deskripsi }}"
                                        data-url="{{ $link->url }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('links.destroy', $link->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus link ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 action-btn">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500">
                            Tidak ada link yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-8">
            {{ $links->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>

<!-- Create Link Modal -->
<div id="create-link-modal" class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto hidden opacity-0 modal-bg">
    <div class="relative bg-white w-full max-w-lg mx-auto rounded-xl shadow-2xl p-8 modal-content opacity-0 -translate-y-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Link Baru</h2>
        <form action="{{ route('links.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" id="judul" name="judul" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                </div>
                <div>
                    <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                    <input type="url" id="url" name="url" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar</label>
                    <input type="file" id="gambar" name="gambar" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                </div>
            </div>
            <div class="mt-8 flex justify-end space-x-4">
                <button type="button" data-modal-close="create-link-modal" class="px-6 py-2 text-gray-600 bg-gray-200 rounded-lg hover:bg-gray-300 transition-all">Batal</button>
                <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-all">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Link Modal -->
<div id="edit-link-modal" class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto hidden opacity-0 modal-bg">
    <div class="relative bg-white w-full max-w-lg mx-auto rounded-xl shadow-2xl p-8 modal-content opacity-0 -translate-y-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Link</h2>
        <form id="edit-form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit-id" name="id">
            <div class="space-y-4">
                <div>
                    <label for="edit-judul" class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" id="edit-judul" name="judul" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="edit-deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="edit-deskripsi" name="deskripsi" rows="3" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                </div>
                <div>
                    <label for="edit-url" class="block text-sm font-medium text-gray-700">URL</label>
                    <input type="url" id="edit-url" name="url" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="edit-gambar" class="block text-sm font-medium text-gray-700">Gambar (Opsional)</label>
                    <input type="file" id="edit-gambar" name="gambar" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
            </div>
            <div class="mt-8 flex justify-end space-x-4">
                <button type="button" data-modal-close="edit-link-modal" class="px-6 py-2 text-gray-600 bg-gray-200 rounded-lg hover:bg-gray-300 transition-all">Batal</button>
                <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-all">Perbarui</button>
            </div>
        </form>
    </div>
</div>

<!-- Detail Link Modal -->
<div id="detail-link-modal" class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto hidden opacity-0 modal-bg">
    <div class="relative bg-white w-full max-w-lg mx-auto rounded-xl shadow-2xl p-8 modal-content opacity-0 -translate-y-4">
        <div class="flex justify-between items-start">
            <h2 id="detail-judul" class="text-2xl font-bold text-gray-800 mb-4"></h2>
            <button data-modal-close="detail-link-modal" class="text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
        </div>
        <img id="detail-gambar" src="" alt="Gambar Link" class="w-full h-48 object-cover rounded-lg mb-4">
        <p id="detail-deskripsi" class="text-gray-600 mb-4"></p>
        <a id="detail-url" href="#" target="_blank" class="text-blue-600 hover:underline break-words"></a>
    </div>
</div>
@endsection
// ... existing code ...

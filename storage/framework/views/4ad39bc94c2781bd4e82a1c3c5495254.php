<?php $__env->startPush('styles'); ?>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    /* Modal Animations */
    .modal-bg {
        transition: opacity 0.4s ease;
        background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
    }
    .modal-content {
        transition: all 0.4s ease;
    }
    /* Table Hover Effects */
    .table-row {
        transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .table-row:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    /* Action Buttons */
    .action-btn {
        transition: all 0.3s ease;
    }
    .action-btn:hover {
        transform: scale(1.1);
    }
    /* Pagination Styling */
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
    .pagination-loading {
        background: #2563eb !important; /* same as .current */
        color: white !important;
        cursor: wait;
        display: inline-flex;
        align-items: center;
    }
    /* Button Loading State */
    .btn-loading {
        position: relative;
        pointer-events: none;
        opacity: 0.7;
    }
    .btn-loading::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        border: 2px solid #fff;
        border-top-color: transparent;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
    }
    @keyframes spin {
        to { transform: translateY(-50%) rotate(360deg); }
    }
    /* Search Container */
    .search-container {
        transition: all 0.3s ease;
    }
    .search-container:focus-within {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    /* Responsive Table for Mobile */
    @media screen and (max-width: 768px) {
        .responsive-table thead {
            display: none;
        }
        .responsive-table tr {
            display: block;
            margin-bottom: 1.5rem;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            border: 1px solid #e5e7eb; /* gray-200 */
        }
        .responsive-table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1rem;
            text-align: right;
            border-bottom: 1px solid #f3f4f6; /* gray-100 */
        }
        .responsive-table td::before {
            content: attr(data-label);
            font-weight: 600;
            color: #374151; /* gray-700 */
            flex: 1;
        }
        .responsive-table td:last-child {
            border-bottom: none;
        }
        .responsive-table tr:last-child {
            margin-bottom: 0;
        }
    }
    /* Responsive Modal for Mobile */
    @media screen and (max-width: 768px) {
        .modal-content {
            width: 90%;
            padding: 1.5rem;
            margin: 0 auto;
        }
        .modal-content h3 {
            font-size: 1.5rem;
        }
        .modal-content button {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
        .modal-content input,
        .modal-content textarea {
            font-size: 0.875rem;
        }
    }
    /* Responsive Header and Search */
    @media screen and (max-width: 768px) {
        .header-section {
            flex-direction: column;
            align-items: stretch;
        }
        .header-section h1 {
            font-size: 1.75rem;
            text-align: center;
        }
        .header-section button {
            width: 100%;
            justify-content: center;
        }
        .search-container {
            max-w-full;
        }
        .search-container input {
            font-size: 0.875rem;
            padding: 0.75rem 2.5rem;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="py-6 md:py-12 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header and Search Section -->
        <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 mb-8 header-section">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">Judul Halaman</h1>
                <button
                    class="bg-blue-900 hover:from-blue-700 hover:to-blue-900 text-white px-4 py-2 rounded-lg transition-all duration-300 flex items-center gap-2 shrink-0"
                    data-modal-open="tambah-judul-modal"
                    aria-label="Tambah Judul Baru">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 010 2h-3v3a1 1 0 01-2 0v-3H6a1 1 0 010-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <!-- Search Form -->
            <div class="search-container max-w-md">
                <form action="<?php echo e(route('judul-halaman.index')); ?>" method="GET">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors duration-200" viewBox="0 0 24 24" fill="none">
                                <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        <input type="search" name="search" placeholder="Cari judul atau deskripsi..." value="<?php echo e(request('search')); ?>"
                               class="w-full pl-12 pr-4 py-3 rounded-lg border border-gray-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all duration-200 bg-gray-50 placeholder-gray-400"
                               aria-label="Cari judul atau deskripsi">
                    </div>
                </form>
            </div>
        </div>

        <!-- Card/List CRUD Section -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 responsive-table">
                    <thead class="bg-gradient-to-r from-blue-900 to-blue-800">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $judulHalamans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $judul): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="table-row bg-white hover:bg-gray-50">
                            <td data-label="No" class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-blue-100 text-blue-600 font-semibold">
                                    <?php echo e($judulHalamans->firstItem() + $index); ?>

                                </span>
                            </td>
                            <td data-label="Judul" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo e(Str::limit($judul->judul, 30)); ?></td>
                            <td data-label="Deskripsi" class="px-6 py-4 text-sm text-gray-600"><?php echo e(Str::limit($judul->deskripsi, 60)); ?></td>
                            <td data-label="Status" class="px-6 py-4 text-sm">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium transition-colors <?php echo e($judul->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                    <span class="w-2 h-2 mr-2 rounded-full <?php echo e($judul->is_active ? 'bg-green-500' : 'bg-red-500'); ?>"></span>
                                    <?php echo e($judul->is_active ? 'Aktif' : 'Tidak Aktif'); ?>

                                </span>
                            </td>
                            <td data-label="Aksi" class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center justify-end space-x-3">
                                    <button class="action-btn p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-100 rounded-full transition-colors detail-judul-btn"
                                            title="Detail <?php echo e(e($judul->judul)); ?>"
                                            data-modal-open="detail-judul-modal"
                                            data-judul="<?php echo e(e($judul->judul)); ?>"
                                            data-deskripsi="<?php echo e(e($judul->deskripsi)); ?>"
                                            data-avatar="<?php echo e($judul->images ? asset('storage/' . $judul->images) : ''); ?>"
                                            data-status="<?php echo e($judul->is_active ? 'Aktif' : 'Tidak Aktif'); ?>"
                                            data-status-class="<?php echo e($judul->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>"
                                            data-created_at="<?php echo e($judul->created_at->format('d M Y, H:i')); ?>"
                                            data-updated_at="<?php echo e($judul->updated_at->format('d M Y, H:i')); ?>"
                                            aria-label="Lihat detail <?php echo e(e($judul->judul)); ?>">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <button class="action-btn p-2 text-green-600 hover:text-green-800 hover:bg-green-100 rounded-full transition-colors duration-200 edit-judul-btn"
                                            title="Edit <?php echo e($judul->judul); ?>"
                                            data-modal-open="edit-judul-modal"
                                            data-id="<?php echo e($judul->id); ?>"
                                            data-judul="<?php echo e(e($judul->judul)); ?>"
                                            data-deskripsi="<?php echo e(e($judul->deskripsi)); ?>"
                                            data-avatar="<?php echo e($judul->images ? asset('storage/' . $judul->images) : ''); ?>"
                                            data-is_active="<?php echo e($judul->is_active ? 'true' : 'false'); ?>"
                                            aria-label="Edit <?php echo e($judul->judul); ?>">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <form action="<?php echo e(route('judul-halaman.destroy', $judul->id)); ?>" method="POST" class="inline delete-form">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button" class="action-btn p-2 text-red-600 hover:text-red-800 hover:bg-red-100 rounded-full transition-colors duration-200 delete-button"
                                                title="Hapus <?php echo e(e($judul->judul)); ?>"
                                                aria-label="Hapus <?php echo e(e($judul->judul)); ?>"
                                                onclick="confirmDelete('<?php echo e($judul->id); ?>', '<?php echo e(e($judul->judul)); ?>')">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-lg">
                                <?php if(request('search')): ?>
                                    Tidak ada judul yang cocok dengan pencarian "<?php echo e(request('search')); ?>".
                                <?php else: ?>
                                    Tidak ada data judul.
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if($judulHalamans->hasPages()): ?>
                <div class="px-6 py-4 bg-gray-50 border-t pagination">
                    <?php echo e($judulHalamans->links('vendor.pagination.tailwind')); ?>

                </div>
            <?php endif; ?>
        </div>

        <!-- Modal Tambah -->
        <div id="tambah-judul-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 hidden items-center justify-center z-50 modal-bg" aria-hidden="true">
            <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 w-full max-w-md sm:max-w-lg modal-content transform animate__animated animate__fadeIn">
                <h3 class="text-xl sm:text-2xl font-semibold text-gray-900 mb-6">Tambah Judul Baru</h3>
                <form action="<?php echo e(route('judul-halaman.store')); ?>" method="POST" class="space-y-5" enctype="multipart/form-data" id="tambah-form">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label for="tambah-judul" class="block text-sm font-medium text-gray-700">Judul</label>
                        <input type="text" name="judul" id="tambah-judul" value="<?php echo e(old('judul')); ?>"
                               class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 py-3 px-4 transition-all duration-200 <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               required aria-describedby="judul-error">
                        <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p id="judul-error" class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label for="tambah-deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" id="tambah-deskripsi" rows="4"
                                  class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 py-3 px-4 transition-all duration-200 <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  aria-describedby="deskripsi-error"><?php echo e(old('deskripsi')); ?></textarea>
                        <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p id="deskripsi-error" class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label for="tambah-images" class="block text-sm font-medium text-gray-700">Avatar (Opsional)</label>
                        <input type="file" name="images" id="tambah-images" accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               aria-describedby="images-error">
                        <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p id="images-error" class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active') ? 'checked' : ''); ?>

                                   class="rounded border-gray-200 text-blue-600 shadow-sm focus:ring-blue-500" aria-label="Aktifkan judul">
                            <span class="ml-2 text-sm font-medium text-gray-600">Aktifkan Judul Ini</span>
                        </label>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" data-modal-close="tambah-judul-modal" class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-all duration-200" aria-label="Batal">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:from-blue-700 hover:to-blue-900 transition-all duration-200 submit-btn" aria-label="Simpan judul baru">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Edit -->
        <div id="edit-judul-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 hidden items-center justify-center z-50 modal-bg" aria-hidden="true">
            <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 w-full max-w-md sm:max-w-lg modal-content transform animate__animated animate__fadeIn">
                <h3 class="text-xl sm:text-2xl font-semibold text-gray-900 mb-6">Edit Judul</h3>
                <form id="edit-form" method="POST" class="space-y-5" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <input type="hidden" name="id" id="edit-id">
                    <div>
                        <label for="edit-judul" class="block text-sm font-medium text-gray-700">Judul</label>
                        <input type="text" name="judul" id="edit-judul"
                               class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 py-3 px-4 transition-all duration-200 <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               required aria-describedby="edit-judul-error">
                        <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p id="edit-judul-error" class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label for="edit-deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" id="edit-deskripsi" rows="4"
                                  class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 py-3 px-4 transition-all duration-200 <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  aria-describedby="edit-deskripsi-error"></textarea>
                        <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p id="edit-deskripsi-error" class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label for="edit-images" class="block text-sm font-medium text-gray-700">Avatar (Opsional)</label>
                        <div class="mt-2 flex items-center space-x-4">
                            <img id="edit-image-preview" src="#" alt="Pratinjau gambar" class="h-16 w-16 rounded-full object-cover hidden">
                            <div class="flex-1">
                                <input type="file" name="images" id="edit-images" accept="image/*"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                       aria-describedby="edit-images-error">
                                <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                            </div>
                        </div>
                        <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p id="edit-images-error" class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_active" id="edit-is_active" value="1"
                                   class="rounded border-gray-200 text-blue-600 shadow-sm focus:ring-blue-500" aria-label="Aktifkan judul">
                            <span class="ml-2 text-sm font-medium text-gray-600">Aktifkan Judul Ini</span>
                        </label>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" data-modal-close="edit-judul-modal" class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-all duration-200" aria-label="Batal">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:from-blue-700 hover:to-blue-900 transition-all duration-200 submit-btn" aria-label="Simpan perubahan">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Detail -->
        <div id="detail-judul-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 hidden items-center justify-center z-50 modal-bg" aria-hidden="true">
            <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 w-full max-w-md sm:max-w-lg modal-content transform animate__animated animate__fadeIn">
                <div class="flex justify-between items-center border-b border-gray-200 pb-4 mb-6">
                    <h3 class="text-xl sm:text-2xl font-semibold text-gray-900">Detail Judul</h3>
                    <button type="button" data-modal-close="detail-judul-modal" class="text-gray-500 hover:text-gray-700 transition-all duration-200" aria-label="Tutup modal">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="space-y-6">
                    <div class="flex justify-center">
                        <img id="detail-avatar" src="" alt="Avatar" class="h-20 w-20 rounded-full object-cover border-2 border-gray-200 hidden">
                        <div id="detail-avatar-fallback" class="h-20 w-20 rounded-full bg-gray-100 flex items-center justify-center hidden">
                            <svg class="h-12 w-12 text-gray-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M24 20.993V24H0v-2.997A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                    <dl class="grid grid-cols-1 sm:grid-cols-3 gap-x-4 gap-y-3">
                        <dt class="text-sm font-medium text-gray-600">Judul</dt>
                        <dd id="detail-judul" class="text-sm text-gray-900 sm:col-span-2 font-semibold"></dd>
                        <dt class="text-sm font-medium text-gray-600">Deskripsi</dt>
                        <dd id="detail-deskripsi" class="text-sm text-gray-900 sm:col-span-2 whitespace-pre-wrap"></dd>
                        <dt class="text-sm font-medium text-gray-600">Status</dt>
                        <dd class="text-sm text-gray-900 sm:col-span-2"><span id="detail-status" class="px-3 py-1 rounded-full text-xs font-medium"></span></dd>
                        <dt class="text-sm font-medium text-gray-600">Dibuat</dt>
                        <dd id="detail-created_at" class="text-sm text-gray-900 sm:col-span-2"></dd>
                        <dt class="text-sm font-medium text-gray-600">Diperbarui</dt>
                        <dd id="detail-updated_at" class="text-sm text-gray-900 sm:col-span-2"></dd>
                    </dl>
                </div>
                <div class="flex justify-end mt-6 pt-4 border-t border-gray-200">
                    <button type="button" data-modal-close="detail-judul-modal" class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:from-blue-700 hover:to-blue-900 transition-all duration-200" aria-label="Tutup">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // Utility Functions
    const modalManager = {
        open(modal) {
            if (!modal) return;
            const modalContent = modal.querySelector('.modal-content');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('opacity-0', '-translate-y-4');
                modalContent.classList.add('opacity-100', 'translate-y-0');
                modalContent.querySelector('input, button, [tabindex="0"]')?.focus();
            }, 20);
        },
        close(modal) {
            if (!modal) return;
            const modalContent = modal.querySelector('.modal-content');
            modal.classList.add('opacity-0');
            modalContent.classList.add('opacity-0', '-translate-y-4');
            modalContent.classList.remove('opacity-100', 'translate-y-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 400);
        }
    };

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
                form.innerHTML = `<input type="hidden" name="_token" value="${csrfToken}"><input type="hidden" name="_method" value="DELETE">`;
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
                form.innerHTML = `<input type="hidden" name="_token" value="${csrfToken}"><input type="hidden" name="_method" value="PUT"><input type="hidden" name="is_active" value="${newStatus ? 1 : 0}">`;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // Form Submission with Loading State
    function handleFormSubmit(form, submitBtn) {
        submitBtn.classList.add('btn-loading');
        submitBtn.disabled = true;
        form.submit();
    }

    // Event Listeners
    document.addEventListener('DOMContentLoaded', () => {
        // Modal Handling
        document.body.addEventListener('click', (e) => {
            const openBtn = e.target.closest('[data-modal-open]');
            if (openBtn) {
                e.preventDefault();
                modalManager.open(document.getElementById(openBtn.dataset.modalOpen));
            }

            const closeBtn = e.target.closest('[data-modal-close]');
            if (closeBtn) {
                e.preventDefault();
                modalManager.close(document.getElementById(closeBtn.dataset.modalClose));
            }

            if (e.target.matches('.modal-bg')) {
                modalManager.close(e.target);
            }

            const editBtn = e.target.closest('.edit-judul-btn');
            if (editBtn) {
                e.preventDefault();
                const form = document.getElementById('edit-form');
                form.action = `/judul-halaman/${editBtn.dataset.id || ''}`;
                document.getElementById('edit-judul').value = editBtn.dataset.judul || '';
                document.getElementById('edit-deskripsi').value = editBtn.dataset.deskripsi || '';
                document.getElementById('edit-is_active').checked = editBtn.dataset.is_active === 'true';
                document.getElementById('edit-id').value = editBtn.dataset.id || '';
                const preview = document.getElementById('edit-image-preview');
                if (editBtn.dataset.avatar) {
                    preview.src = editBtn.dataset.avatar;
                    preview.classList.remove('hidden');
                } else {
                    preview.classList.add('hidden');
                }
            }

            const detailBtn = e.target.closest('.detail-judul-btn');
            if (detailBtn) {
                e.preventDefault();
                document.getElementById('detail-judul').textContent = detailBtn.dataset.judul || '';
                document.getElementById('detail-deskripsi').textContent = detailBtn.dataset.deskripsi || '';
                const statusEl = document.getElementById('detail-status');
                statusEl.textContent = detailBtn.dataset.status || '';
                statusEl.className = `px-3 py-1 rounded-full text-xs font-medium ${detailBtn.dataset.statusClass || ''}`;
                document.getElementById('detail-created_at').textContent = detailBtn.dataset.created_at || '';
                document.getElementById('detail-updated_at').textContent = detailBtn.dataset.updated_at || '';
                const avatar = document.getElementById('detail-avatar');
                const fallback = document.getElementById('detail-avatar-fallback');
                if (detailBtn.dataset.avatar) {
                    avatar.src = detailBtn.dataset.avatar;
                    avatar.classList.remove('hidden');
                    fallback.classList.add('hidden');
                } else {
                    avatar.classList.add('hidden');
                    fallback.classList.remove('hidden');
                }
            }

            const deleteBtn = e.target.closest('.delete-button');
            if (deleteBtn) {
                e.preventDefault();
                const form = deleteBtn.closest('.delete-form');
                const judul = deleteBtn.getAttribute('title').replace('Hapus ', '');
                confirmDelete(form.action.split('/').pop(), judul);
            }

            const toggleBtn = e.target.closest('.status-toggle-btn');
            if (toggleBtn) {
                e.preventDefault();
                const id = toggleBtn.dataset.id;
                const newStatus = toggleBtn.dataset.newStatus === '1';
                const judul = toggleBtn.dataset.judul;
                toggleStatus(id, newStatus, judul);
            }
        });

        // Form Submission Handling
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', (e) => {
                const submitBtn = e.target.querySelector('.submit-btn');
                if (submitBtn) {
                    handleFormSubmit(form, submitBtn);
                }
            });
        });

        // Focus Trap for Modals
        document.querySelectorAll('.modal-content').forEach(modal => {
            const focusableElements = modal.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
            const firstElement = focusableElements[0];
            const lastElement = focusableElements[focusableElements.length - 1];

            modal.addEventListener('keydown', (e) => {
                if (e.key === 'Tab') {
                    if (e.shiftKey) {
                        if (document.activeElement === firstElement) {
                            e.preventDefault();
                            lastElement.focus();
                        }
                    } else {
                        if (document.activeElement === lastElement) {
                            e.preventDefault();
                            firstElement.focus();
                        }
                    }
                }
            });
        });

        // Escape Key Handling
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal-bg').forEach(modal => modalManager.close(modal));
            }
        });

        // SweetAlert for session errors
        <?php if($errors->any()): ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo e($errors->first()); ?>',
                confirmButtonColor: '#1e3a8a'
            });
        <?php endif; ?>
        <?php if(session('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo e(session('error')); ?>',
                confirmButtonColor: '#1e3a8a'
            });
        <?php endif; ?>

        // Re-open Modal on Validation Failure
        <?php if($errors->any()): ?>
            <?php if(old('_method') === 'PUT'): ?>
                const editModal = document.getElementById('edit-judul-modal');
                if (editModal) {
                    const form = document.getElementById('edit-form');
                    form.action = `/judul-halaman/<?php echo e(old('id')); ?>`;
                    document.getElementById('edit-judul').value = '<?php echo e(old('judul')); ?>';
                    document.getElementById('edit-deskripsi').value = '<?php echo e(old('deskripsi')); ?>';
                    document.getElementById('edit-is_active').checked = <?php echo e(old('is_active') ? 'true' : 'false'); ?>;
                    modalManager.open(editModal);
                }
            <?php else: ?>
                modalManager.open(document.getElementById('tambah-judul-modal'));
            <?php endif; ?>
        <?php endif; ?>

        // Pagination Loading State
        document.querySelectorAll('.pagination a').forEach(link => {
            link.addEventListener('click', function(e) {
                // Add a loading indicator to the clicked link
                this.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memuat...
                `;
                this.classList.add('pagination-loading');

                // Disable all other pagination links to prevent multiple clicks
                document.querySelectorAll('.pagination a').forEach(otherLink => {
                    otherLink.style.pointerEvents = 'none';
                    otherLink.classList.add('opacity-50');
                });
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\portalWebn\resources\views/judul-halaman/index.blade.php ENDPATH**/ ?>
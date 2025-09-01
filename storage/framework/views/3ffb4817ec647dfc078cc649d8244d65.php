<!-- Create Link Modal -->
<div id="create-link-modal" class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto hidden opacity-0 modal-bg">
    <div class="relative bg-white w-full max-w-lg mx-auto rounded-xl shadow-2xl p-8 modal-content opacity-0 -translate-y-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Link Baru</h2>
        <form action="<?php echo e(route('links.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
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
<?php /**PATH C:\xampp\htdocs\portalWebn\resources\views/links/partials/create-modal.blade.php ENDPATH**/ ?>
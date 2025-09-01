<?php $__env->startSection('content'); ?>
<div class="py-6 md:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Pengaturan Akun</h1>
            <p class="mt-1 text-md text-gray-600">Kelola informasi profil, preferensi, dan keamanan akun Anda.</p>
        </header>

        <div class="space-y-8">
            
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 sm:p-8">
                    <header>
                        <h3 class="text-xl font-semibold text-gray-900">Informasi Profil</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Perbarui informasi profil, alamat email, dan foto profil akun Anda.
                        </p>
                    </header>

                    <form method="POST" action="<?php echo e(route('profile.update')); ?>" enctype="multipart/form-data" class="mt-6 space-y-6">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>

                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700">Foto Profil</label>
                            <div class="mt-2 flex items-center gap-4">
                                <?php if($user->profile_photo_path): ?>
                                    <img src="<?php echo e(asset('storage/' . $user->profile_photo_path)); ?>" alt="Foto Profil" class="h-20 w-20 rounded-full object-cover">
                                <?php else: ?>
                                    <span class="inline-block h-20 w-20 rounded-full overflow-hidden bg-gray-100">
                                        <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.997A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    </span>
                                <?php endif; ?>
                                <input type="file" name="photo" id="photo" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </div>
                            <?php $__errorArgs = ['photo', 'updateProfileInformation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-sm text-red-600 mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="name" id="name" value="<?php echo e(old('name', $user->name)); ?>" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required autofocus>
                            <?php $__errorArgs = ['name', 'updateProfileInformation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-sm text-red-600 mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="<?php echo e(old('email', $user->email)); ?>" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                             <?php $__errorArgs = ['email', 'updateProfileInformation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-sm text-red-600 mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-blue-900 hover:bg-blue-800 text-white px-5 py-2.5 rounded-lg transition-colors duration-200 font-semibold">Simpan Perubahan</button>
                            <?php if(session('status') === 'profile-updated'): ?>
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-green-600 font-medium">Tersimpan.</p>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

            
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 sm:p-8">
                    <header>
                        <h3 class="text-xl font-semibold text-gray-900">Ganti Password</h3>
                        <p class="mt-1 text-sm text-gray-500">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
                    </header>

                    <form method="POST" action="<?php echo e(route('password.update')); ?>" class="mt-6 space-y-6">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700">Password Lama</label>
                            <input type="password" name="current_password" id="current_password" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <?php $__errorArgs = ['current_password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-sm text-red-600 mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <?php $__errorArgs = ['password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-sm text-red-600 mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-blue-900 hover:bg-blue-800 text-white px-5 py-2.5 rounded-lg transition-colors duration-200 font-semibold">Ganti Password</button>
                            <?php if(session('status') === 'password-updated'): ?>
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-green-600 font-medium">Tersimpan.</p>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

            
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 sm:p-8">
                    <header>
                        <h3 class="text-xl font-semibold text-red-700">Hapus Akun</h3>
                        <p class="mt-1 text-sm text-gray-500">Setelah akun Anda dihapus, semua datanya akan dihapus secara permanen. Tindakan ini tidak dapat diurungkan.</p>
                    </header>
                    <form id="delete-user-form" method="POST" action="<?php echo e(route('profile.destroy')); ?>" class="mt-6">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <div>
                            <label for="password_delete" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                            <input type="password" name="password" id="password_delete" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500" required placeholder="Masukkan password Anda untuk konfirmasi">
                            <?php $__errorArgs = ['password', 'userDeletion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-sm text-red-600 mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <button type="submit" class="mt-4 bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-lg transition-colors duration-200 font-semibold delete-account-btn">Hapus Akun</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // SweetAlert for profile update success
    <?php if(session('status') === 'profile-updated'): ?>
        Swal.fire({
            icon: 'success',
            title: 'Profil berhasil diperbarui!',
            text: 'Perubahan profil Anda telah tersimpan.',
            confirmButtonColor: '#1e3a8a'
        });
    <?php endif; ?>
    // SweetAlert for password update success
    <?php if(session('status') === 'password-updated'): ?>
        Swal.fire({
            icon: 'success',
            title: 'Password berhasil diganti!',
            text: 'Password baru Anda telah tersimpan.',
            confirmButtonColor: '#1e3a8a'
        });
    <?php endif; ?>
    // SweetAlert for validation errors
    <?php if($errors->any()): ?>
        <?php if($errors->updatePassword->has('current_password')): ?>
             Swal.fire({
                icon: 'error',
                title: 'Password Lama Salah',
                text: '<?php echo e($errors->updatePassword->first('current_password')); ?>',
                confirmButtonText: 'OK',
                confirmButtonColor: '#1e3a8a'
            });
        <?php else: ?>
             Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                html: '<?php echo implode('<br>', $errors->all()); ?>',
                confirmButtonText: 'OK',
                confirmButtonColor: '#1e3a8a'
            });
        <?php endif; ?>
    <?php elseif(session('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '<?php echo e(session('error')); ?>',
            confirmButtonText: 'OK',
            confirmButtonColor: '#1e3a8a'
        });
    <?php endif; ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\portalWebn\resources\views/profile/index.blade.php ENDPATH**/ ?>
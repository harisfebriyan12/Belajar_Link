<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-blue-800 mb-2 sm:mb-0">Dashboard Website</h1>
        <div class="text-xs sm:text-sm text-blue-900">
            <?php echo e(now()->timezone('Asia/Jakarta')->format('d M Y, H:i:s \W\I\B')); ?>

        </div>
    </div>

    <!-- Statistik Utama -->
    <div class="grid grid-cols-2 gap-4 mb-8 sm:grid-cols-2 lg:grid-cols-3 sm:gap-6">
        <!-- Total Links -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl shadow-lg p-4 sm:p-6 text-white transform transition hover:scale-105 hover:shadow-xl">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg sm:text-xl font-semibold mb-2">Total Link Website</h2>
                    <div class="text-2xl sm:text-3xl font-bold"><?php echo e($totalLinks); ?></div>
                </div>
                <div class="bg-blue-900 p-2 sm:p-3 rounded-full">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13.828 10.172a4 4 0 00-5.656 0l-4 4
                                 a4 4 0 105.656 5.656l1.102-1.101
                                 m-.758-4.899a4 4 0 005.656 0l4-4
                                 a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                </div>
            </div>
            <div class="mt-3 flex items-center text-blue-200 text-xs sm:text-sm">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                <span><?php echo e($newLinksLastWeek); ?> Baru</span>
            </div>
        </div>

        <!-- Pengguna -->
        <div class="bg-gradient-to-r from-green-600 to-green-800 rounded-xl shadow-lg p-4 sm:p-6 text-white transform transition hover:scale-105 hover:shadow-xl">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg sm:text-xl font-semibold mb-2">Pengguna</h2>
                    <div class="text-2xl sm:text-3xl font-bold"><?php echo e($totalUsers); ?></div>
                </div>
                <div class="bg-green-900 p-2 sm:p-3 rounded-full">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 20h5v-2a3 3 0
                                 00-5.356-1.857M17 20H7
                                 m10 0v-2c0-.656-.126-1.283-.356-1.857
                                 M7 20H2v-2a3 3 0
                                 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857
                                 m0 0a5.002 5.002 0
                                 019.288 0M15 7a3 3 0
                                 11-6 0 3 3 0 016 0zm6 3a2 2 0
                                 11-4 0 2 2 0 014 0zM7 10a2 2 0
                                 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-gray-100 text-xs sm:text-sm">Total pengguna terdaftar</p>
        </div>

        <!-- Aktivitas -->
        <div class="bg-gradient-to-r from-blue-900 to-indigo-900 rounded-xl shadow-lg p-4 sm:p-6 text-white transform transition hover:scale-105 hover:shadow-xl">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg sm:text-xl font-semibold mb-2">Aktivitas</h2>
                    <div class="text-2xl sm:text-3xl font-bold"><?php echo e($recentActivities->count()); ?></div>
                </div>
                <div class="bg-indigo-800 p-2 sm:p-3 rounded-full">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0
                                 00-2 2v12a2 2 0 002 2h10a2 2 0
                                 002-2V7a2 2 0 00-2-2h-2
                                 M9 5a2 2 0 002 2h2a2 2 0
                                 002-2M9 5a2 2 0
                                 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-gray-200 text-xs sm:text-sm">Aktivitas terbaru 24 jam terakhir</p>
        </div>

        <!-- Placeholder Card for 2x2 Grid Balance -->
        <div class="bg-gradient-to-r from-gray-600 to-gray-800 rounded-xl shadow-lg p-4 sm:p-6 text-white transform transition hover:scale-105 hover:shadow-xl sm:hidden">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg sm:text-xl font-semibold mb-2">Statistik Lain</h2>
                    <div class="text-2xl sm:text-3xl font-bold">N/A</div>
                </div>
                <div class="bg-gray-900 p-2 sm:p-3 rounded-full">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-gray-200 text-xs sm:text-sm">Informasi tambahan segera hadir</p>
        </div>
    </div>

    <!-- Aktivitas Terkini -->
    <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 mb-6">
        <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4">Aktivitas Terkini</h3>
        <div class="space-y-4">
            <?php $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex items-start border-b border-gray-200 pb-4 last:border-b-0 hover:bg-gray-50 rounded-lg p-2 transition">
                <div class="p-2 rounded-full mr-4 bg-blue-100">
                    <?php if($activity['type'] === 'link'): ?>
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13.828 10.172a4 4 0
                                     00-5.656 0l-4 4a4 4 0
                                     105.656 5.656l1.102-1.101
                                     m-.758-4.899a4 4 0
                                     005.656 0l4-4a4 4 0
                                     00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                    <?php else: ?>
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0
                                     01-2-2V5a2 2 0 012-2h5.586a1 1 0
                                     01.707.293l5.414 5.414a1 1 0
                                     01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    <?php endif; ?>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">
                        <?php echo e($activity['type'] === 'link' ? 'Link' : 'Judul Halaman'); ?>

                        <span class="font-bold text-blue-700">
                            "<?php echo e(Str::limit($activity['judul'], 30)); ?>"
                        </span>
                        <?php echo e($activity['action'] === 'created' ? 'telah dibuat' : 'telah diperbarui'); ?>

                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        Oleh <span class="font-medium"><?php echo e($activity['user_name']); ?></span>
                        <?php if($activity['user_email']): ?>
                            (<?php echo e($activity['user_email']); ?>)
                        <?php endif; ?>
                        &middot; <?php echo e(\Carbon\Carbon::parse($activity['timestamp'])->diffForHumans()); ?>

                    </p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\portalWebn\resources\views/dashboard.blade.php ENDPATH**/ ?>
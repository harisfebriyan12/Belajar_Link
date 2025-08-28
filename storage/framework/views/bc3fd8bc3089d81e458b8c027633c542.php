<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-blue-800">Dashboard Website</h1>
        <div class="text-sm text-blue-900"> <?php echo e(now()->timezone('Asia/Jakarta')->format('d M Y, H:i:s \W\I\B')); ?></div>
    </div>

    <!-- Statistik Utama -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Links -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl shadow-lg p-6 text-white">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold mb-2">Total Link Website</h2>
                    <div class="text-3xl font-bold"><?php echo e($totalLinks); ?></div>
                </div>
                <div class="bg-purple-120 p-3 rounded-full">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-blue-200">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
                <span><?php echo e($newLinksLastWeek); ?> Baru </span>
            </div>
        </div>

        <!-- Pengguna Terdaftar -->
        <div class="bg-gradient-to-r from-green-600 to-green-800 rounded-xl shadow-lg p-6 text-white">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold mb-2">Pengguna</h2>
                    <div class="text-3xl font-bold"><?php echo e($totalUsers); ?></div>
                </div>
                <div class="bg-green-800 p-3 rounded-full">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-gray-100">Pengguna</p>
            </div>
        </div>
        <!-- Aktivitas Terbaru -->
        <div class="bg-gradient-to-r from-blue-900 to-blue-900 rounded-xl shadow-lg p-6 text-white">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold mb-2">Aktivitas</h2>
                    <div class="text-3xl font-bold"><?php echo e($recentActivities->count()); ?></div>
                </div>
                <div class="bg-blue-800 p-3 rounded-full">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-gray-9   900">Aktivitas terbaru dalam 24 jam</p>
            </div>
        </div>
    </div>
        <!-- Aktivitas Terbaru -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Aktivitas Terkini</h3>
            <div class="space-y-4">
                <?php $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-start border-b border-gray-200 pb-4 last:border-b-0">
                    <div class="p-2 rounded-full mr-4 <?php echo e($activity['type'] === 'link' ? 'bg-blue-100' : 'bg-blue-100'); ?>">
                        <?php if($activity['type'] === 'link'): ?>
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        <?php else: ?>
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        <?php endif; ?>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">
                            <?php if($activity['type'] === 'link'): ?>
                                Link
                            <?php else: ?>
                                Judul Halaman
                            <?php endif; ?>
                            <span class="font-bold <?php echo e($activity['type'] === 'link' ? 'text-blue-700' : 'text-blue-700'); ?>">
                                "<?php echo e(Str::limit($activity['judul'], 30)); ?>"
                            </span>
                            <?php if($activity['action'] === 'created'): ?>
                                telah dibuat
                            <?php elseif($activity['action'] === 'updated'): ?>
                                telah diperbarui
                            <?php endif; ?>
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
        </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\portalWebn\resources\views/dashboard.blade.php ENDPATH**/ ?>
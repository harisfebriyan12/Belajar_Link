<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Flash Messages dari session
            <?php if(session('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "<?php echo e(session('success')); ?>",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            <?php endif; ?>

            <?php if(session('error')): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "<?php echo e(session('error')); ?>",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            <?php endif; ?>
        });
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen">
<div x-data="{collapsed: false}" class="flex min-h-screen h-screen overflow-hidden">
    <?php app("livewire")->forceAssetInjection(); ?><div x-persist="<?php echo e('sidebar'); ?>">
        <!-- Sidebar -->
        <aside
            :class="collapsed ? 'w-20' : 'w-64'"
            class="flex flex-col bg-blue-900 text-white shadow-xl transition-all duration-300 h-full min-h-screen"
        >
            <div class="p-4 flex items-center border-b border-blue-900">
                <button @click="collapsed = !collapsed" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span x-show="!collapsed" class="ml-3 font-bold text-white">Website</span>
            </div>
            <nav class="py-4 flex-1">
                <ul>
                    <li>
                        <a href="<?php echo e(route('dashboard')); ?>" wire:navigate class="flex items-center px-4 py-3 text-sm font-medium rounded-lg group transition-all duration-200 hover:bg-blue-600">
                            <svg class="mr-3 h-5 w-5 text-blue-200 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span x-show="!collapsed" class="text-blue-100 group-hover:text-white">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo e(route('links.index')); ?>" wire:navigate class="flex items-center px-4 py-3 text-sm font-medium rounded-lg group transition-all duration-200 hover:bg-blue-600">
                            <svg class="mr-3 h-5 w-5 text-blue-200 group-hover:text-white" fill ="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                            <span x-show="!collapsed" class="text-blue-100 group-hover:text-white">Link</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo e(route('judul-halaman.index')); ?>" wire:navigate class="flex items-center px-4 py-3 text-sm font-medium rounded-lg group transition-all duration-200 hover:bg-blue-600">
                            <svg class="mr-3 h-5 w-5 text-blue-200 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            <span x-show="!collapsed" class="text-blue-100 group-hover:text-white"> Pengaturan</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-h-screen" x-data="{ isLoading: false }" @navigate:start.window="isLoading = true" @navigate:end.window="isLoading = false">
        <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="flex-1 relative">
            <!-- Page Content -->
            <main class="h-full overflow-y-auto p-6 bg-gray-50 transition-all duration-300" :class="{'opacity-25 blur-sm': isLoading}">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
            <!-- Loading Spinner Overlay -->
            <div x-show="isLoading" x-transition class="absolute inset-0 flex items-center justify-center bg-gray-50 bg-opacity-50 z-50" style="display: none;">
                <div class="animate-spin rounded-full h-20 w-20 border-t-4 border-b-4 border-blue-900"></div>
            </div>
        </div>
    </div>
</div>
<?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\portalWebn\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>
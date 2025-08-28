<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-300 min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 sm:p-10 transition-all duration-300 ease-in-out">
        <!-- Header -->
        <div class="text-center mb-6">
            <h2 class="text-3xl font-extrabold text-gray-800">Selamat Datang</h2>
            <p class="mt-1 text-sm text-gray-500">Silakan login untuk Mengakses Website</p>
        </div>

        <!-- Flash Message -->
        <?php if(session('status')): ?>
            <div class="mb-4 text-sm text-center text-gray-800 bg-gray-100 border border-gray-300 rounded p-3">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded p-3">
                <ul class="list-disc list-inside text-sm">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <form method="POST" action="<?php echo e(route('login')); ?>" id="loginForm" class="space-y-5">
            <?php echo csrf_field(); ?>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="<?php echo e(old('email')); ?>"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="contoh@gmail.com"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent"
                />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    placeholder="••••••••"
                    autocomplete="current-password"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent"
                />
            </div>

            <!-- Google reCAPTCHA -->
            <div class="pt-1">
                <div class="g-recaptcha" data-sitekey="<?php echo e(env('RECAPTCHA_SITE_KEY')); ?>"></div>
            </div>

            <!-- Submit -->
            <div>
                <button
                    type="submit"
                    class="w-full bg-blue-900 text-white py-2 rounded-lg hover:bg-blue-900 transition-all duration-200 font-semibold"
                >
                    Masuk
                </button>
            </div>


    <!-- reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- SweetAlert2 Messages -->
    <script>
        // SweetAlert untuk pesan sukses
        <?php if(session('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "<?php echo e(session('success')); ?>",
                showConfirmButton: false,
                timer: 3000
            });
        <?php endif; ?>
    </script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\portalWebn\resources\views/auth/login.blade.php ENDPATH**/ ?>
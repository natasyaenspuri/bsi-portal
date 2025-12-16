<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-[#00A39D] to-[#005f5b]">
            <div>
                <a href="/" class="flex flex-col items-center group">
                    
                    <!-- BSI Portal Logo Text -->
                    <div class="bg-white p-3 rounded-full shadow-lg group-hover:scale-105 transition-transform duration-300">
                        <svg class="w-12 h-12 text-[#00A39D]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <span class="mt-4 text-2xl font-bold text-white tracking-widest drop-shadow-md">BSI PORTAL</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-2xl overflow-hidden sm:rounded-xl border-t-4 border-[#F39C12]">
                <?php echo e($slot); ?>

            </div>
            
            <div class="mt-8 text-white/60 text-sm">
                &copy; <?php echo e(date('Y')); ?> PT Bank Syariah Indonesia Tbk.
            </div>
        </div>
    </body>
</html>
<?php /**PATH /Users/natasyaekanandasoniapuri/Documents/bsionerequest/bsi-portal/resources/views/layouts/guest.blade.php ENDPATH**/ ?>
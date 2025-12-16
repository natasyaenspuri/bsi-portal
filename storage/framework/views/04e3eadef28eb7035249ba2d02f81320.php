<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo e(config('app.name', 'BSI Portal')); ?></title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Styles -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body class="antialiased font-sans bg-gray-50 text-gray-900">
        
        <!-- Navigation -->
        <nav class="bg-white border-b border-gray-100 fixed w-full z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="/" class="flex items-center gap-2">
                            <svg class="w-8 h-8 text-[#00A39D]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            <span class="font-bold text-xl text-[#00A39D] tracking-wide">BSI PORTAL</span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Route::has('login')): ?>
                            <div class="space-x-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                                    <a href="<?php echo e(url('/dashboard')); ?>" class="text-[#00A39D] hover:text-[#008f8a] font-semibold">Dashboard</a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('login')); ?>" class="text-gray-600 hover:text-[#00A39D] font-medium transition">Log in</a>
                                    <a href="<?php echo e(route('register')); ?>" class="bg-[#00A39D] hover:bg-[#008f8a] text-white px-4 py-2 rounded-lg font-medium transition shadow-md hover:shadow-lg">Register</a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <header class="relative bg-gradient-to-br from-[#00A39D] to-[#005f5b] text-white pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden">
            <!-- decorative circles -->
            <div class="absolute top-0 left-0 -ml-24 -mt-24 w-96 h-96 rounded-full bg-white opacity-5 blur-3xl"></div>
            <div class="absolute bottom-0 right-0 -mr-24 -mb-24 w-96 h-96 rounded-full bg-[#F39C12] opacity-10 blur-3xl"></div>

            <div class="max-w-7xl mx-auto relative z-10 flex flex-col md:flex-row items-center gap-12">
                <div class="max-w-2xl">
                    <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight mb-6 leading-tight">
                        Layanan Perbankan Syariah <br>
                        <span class="text-[#F39C12]">Mudah, Cepat, dan Berkah</span>
                    </h1>
                    <p class="text-lg sm:text-xl text-teal-100 mb-8 leading-relaxed max-w-lg">
                        Ajukan pembukaan rekening, pemblokiran, atau pembaruan data nasabah secara online tanpa perlu antre di cabang.
                    </p>
                    <div class="flex gap-4">
                        <a href="<?php echo e(route('register')); ?>" class="bg-[#F39C12] text-white px-8 py-3 rounded-lg font-bold text-lg hover:bg-yellow-600 transition shadow-lg transform hover:-translate-y-1">
                            Buka Rekening Sekarang
                        </a>
                        <a href="#features" class="border border-white/30 hover:bg-white/10 text-white px-8 py-3 rounded-lg font-semibold text-lg transition">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <!-- Hero Image Illustration (Abstract Card) -->
                <div class="flex-1 w-full flex justify-center md:justify-end">
                     <div class="relative w-80 h-48 sm:w-96 sm:h-56 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-2xl p-6 transform rotate-3 hover:rotate-0 transition duration-500">
                        <div class="flex justify-between items-start mb-8">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            <span class="text-white/80 font-mono">PLATINUM CARD</span>
                        </div>
                        <div class="text-white text-2xl font-mono tracking-widest mb-2">**** **** **** 4582</div>
                        <div class="flex justify-between items-end mt-4">
                            <div class="text-white/70 text-xs">
                                VALID THRU<br>
                                <span class="text-white text-sm font-semibold">12/30</span>
                            </div>
                            <div class="w-10 h-6 bg-[#F39C12] rounded opacity-80"></div>
                        </div>
                     </div>
                </div>
            </div>
        </header>

        <!-- Features Section -->
        <section id="features" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Layanan Unggulan Kami</h2>
                    <p class="text-gray-500 max-w-2xl mx-auto">Tiga langkah mudah untuk mengelola kebutuhan perbankan Anda dari rumah.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-white p-8 rounded-xl shadow-md border-t-4 border-[#00A39D] hover:shadow-xl transition group">
                        <div class="w-14 h-14 bg-teal-100 rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#00A39D] transition duration-300">
                            <svg class="w-8 h-8 text-[#00A39D] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Buka Rekening Online</h3>
                        <p class="text-gray-500 leading-relaxed">
                            Nikmati kemudahan membuka rekening tabungan syariah tanpa perlu datang ke kantor cabang. Cukup isi form dan upload KTP.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white p-8 rounded-xl shadow-md border-t-4 border-[#F39C12] hover:shadow-xl transition group">
                        <div class="w-14 h-14 bg-yellow-100 rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#F39C12] transition duration-300">
                            <svg class="w-8 h-8 text-[#F39C12] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Keamanan Terjamin</h3>
                        <p class="text-gray-500 leading-relaxed">
                            Layanan pemblokiran rekening darurat yang dapat diakses kapan saja untuk mengamankan aset Anda jika terjadi kendala.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white p-8 rounded-xl shadow-md border-t-4 border-gray-800 hover:shadow-xl transition group">
                        <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center mb-6 group-hover:bg-gray-800 transition duration-300">
                            <svg class="w-8 h-8 text-gray-700 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Update Data Mudah</h3>
                        <p class="text-gray-500 leading-relaxed">
                            Perbarui informasi pribadi Anda seperti alamat atau nomor telepon dengan cepat agar layanan tetap berjalan lancar.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="bg-[#00A39D] text-white py-16">
            <div class="max-w-4xl mx-auto text-center px-4">
                <h2 class="text-3xl font-bold mb-6">Siap Menjadi Bagian dari Bank Syariah Indonesia?</h2>
                <p class="text-teal-100 text-lg mb-8">Bergabunglah dengan jutaan nasabah lainnya yang telah memilih layanan perbankan yang amanah dan modern.</p>
                <div class="flex justify-center gap-4">
                    <a href="<?php echo e(route('register')); ?>" class="bg-white text-[#00A39D] px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition shadow-lg">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12 border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center text-center md:text-left gap-6">
                <div>
                     <div class="flex items-center justify-center md:justify-start gap-2 mb-2">
                        <svg class="w-6 h-6 text-[#00A39D]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        <span class="font-bold text-lg tracking-wide">BSI PORTAL</span>
                    </div>
                    <p class="text-gray-400 text-sm">Memberikan layanan prima bagi seluruh nasabah Indonesia.</p>
                </div>
                <div class="text-gray-500 text-sm">
                    &copy; <?php echo e(date('Y')); ?> PT Bank Syariah Indonesia Tbk. All rights reserved. <br>
                    Terdaftar dan diawasi oleh Otoritas Jasa Keuangan (OJK).
                </div>
            </div>
        </footer>
    </body>
</html>
<?php /**PATH /Users/natasyaekanandasoniapuri/Documents/bsionerequest/bsi-portal/resources/views/welcome.blade.php ENDPATH**/ ?>
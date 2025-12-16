<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Rekening Nasabah</h1>
        
        <!-- Search -->
        <div class="relative">
            <input wire:model.live="search" type="text" placeholder="Cari Nama/No. Rekening..." class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#00A39D] focus:border-transparent">
            <div class="absolute left-3 top-2.5 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>
    </div>

    <!-- Flash Message -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('message')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?php echo e(session('message')); ?></span>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-[#00A39D] text-white">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Nasabah</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">No. Rekening</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Saldo</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $rekenings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rekening): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-teal-100 rounded-full flex items-center justify-center text-teal-600 font-bold">
                                <?php echo e(substr($rekening->nasabah_name, 0, 1)); ?>

                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900"><?php echo e($rekening->nasabah_name); ?></div>
                                <div class="text-xs text-gray-500">NIK: <?php echo e($rekening->nik_ktp); ?></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700 font-mono">
                        <?php echo e($rekening->no_rekening); ?>

                    </td>
                    <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-800">
                        Rp <?php echo e(number_format($rekening->saldo, 0, ',', '.')); ?>

                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($rekening->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                            <?php echo e(ucfirst($rekening->status)); ?>

                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($rekening->status == 'active'): ?>
                            <button wire:click="blockRekening(<?php echo e($rekening->id); ?>)" wire:confirm="Yakin ingin memblokir rekening ini?" class="text-red-600 hover:text-red-900 font-semibold bg-red-50 hover:bg-red-100 px-3 py-1 rounded transition">
                                Blokir
                            </button>
                        <?php else: ?>
                            <button wire:click="unblockRekening(<?php echo e($rekening->id); ?>)" wire:confirm="Yakin ingin membuka blokir rekening ini?" class="text-green-600 hover:text-green-900 font-semibold bg-green-50 hover:bg-green-100 px-3 py-1 rounded transition">
                                Buka Blokir
                            </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($rekenings->isEmpty()): ?>
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                        Tidak ada data rekening ditemukan.
                    </td>
                </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            <?php echo e($rekenings->links()); ?>

        </div>
    </div>
</div>
<?php /**PATH /Users/natasyaekanandasoniapuri/Documents/bsionerequest/bsi-portal/resources/views/livewire/admin-rekening.blade.php ENDPATH**/ ?>
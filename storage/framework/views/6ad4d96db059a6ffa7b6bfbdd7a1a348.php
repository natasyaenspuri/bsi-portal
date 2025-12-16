<div>
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Riwayat Pengajuan Nasabah (Anda)</h3>
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($requests->isEmpty()): ?>
        <p class="text-gray-500">Belum ada request yang dibuat.</p>
    <?php else: ?>
        <div class="space-y-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="border rounded-lg p-4 <?php echo e($req->status == 'processed' ? 'bg-green-50 border-green-200' : ($req->status == 'rejected' ? 'bg-red-50 border-red-200' : 'bg-white border-gray-200')); ?>">
                <div class="flex justify-between items-start">
                    <div>
                        <span class="font-bold text-[#00A39D]"><?php echo e(ucfirst(str_replace('_', ' ', $req->type))); ?></span>
                        <span class="text-xs text-gray-400 block"><?php echo e($req->created_at->format('d M Y H:i')); ?></span>
                    </div>
                    <span class="px-2 py-1 rounded text-xs <?php echo e($req->status == 'approved' || $req->status == 'processed' ? 'bg-green-200 text-green-800' : ($req->status == 'rejected' ? 'bg-red-200 text-red-800' : 'bg-yellow-200 text-yellow-800')); ?>">
                        <?php echo e(ucfirst($req->status)); ?>

                    </span>
                </div>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($req->admin_response): ?>
                    <div class="mt-3 text-sm bg-white/50 p-2 rounded border border-gray-100">
                        <span class="font-semibold text-gray-600">Admin Response:</span>
                        <p class="text-gray-800"><?php echo e($req->admin_response); ?></p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH /Users/natasyaekanandasoniapuri/Documents/bsionerequest/bsi-portal/resources/views/livewire/user-request-history.blade.php ENDPATH**/ ?>
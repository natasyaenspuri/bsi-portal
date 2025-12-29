<div class="flex flex-col md:flex-row h-[calc(100vh-64px)] bg-gray-50">
    
    <!-- Sidebar List -->
    <!-- Mobile: Hidden if item selected. Desktop: Always visible, width specific -->
    <div class="<?php echo e($selectedRequest ? 'hidden md:block' : 'block'); ?> w-full md:w-1/3 lg:w-1/4 bg-white border-r border-gray-200 overflow-y-auto h-full shadow-sm z-10">
        <div class="p-4 bg-gray-50 border-b font-bold text-gray-700 sticky top-0 md:static">
            Daftar Tiket Masuk
        </div>
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div wire:click="selectRequest(<?php echo e($req->id); ?>)" class="p-4 border-b hover:bg-teal-50 cursor-pointer transition <?php echo e($req->status == 'pending' ? 'border-l-4 border-l-[#F39C12]' : 'border-l-4 border-l-transparent'); ?> <?php echo e($selectedRequestId == $req->id ? 'bg-teal-50 border-l-[#00A39D]' : ''); ?>">
            <div class="flex justify-between items-start">
                <div>
                     <h4 class="font-bold text-gray-800"><?php echo e($req->nasabah_name ?? ($req->user->name ?? 'Unknown')); ?></h4>
                    <p class="text-xs text-gray-500 font-medium">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($req->type == 'new_account'): ?> Buka Rekening
                        <?php elseif($req->type == 'block_account'): ?> Blokir Rekening
                        <?php else: ?> Update Data
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </p>
                </div>
                <span class="text-[10px] text-gray-400"><?php echo e($req->created_at->diffForHumans(null, true)); ?></span>
            </div>
            
            <div class="flex justify-between items-center mt-2">
                <span class="text-xs px-2 py-0.5 rounded-full <?php echo e($req->status == 'pending' ? 'bg-yellow-100 text-yellow-800 border border-yellow-200' : ($req->status == 'processed' ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200')); ?>">
                    <?php echo e(ucfirst($req->status)); ?>

                </span>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($requests->isEmpty()): ?>
            <div class="p-8 text-center text-gray-400 text-sm">
                Belum ada request.
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <!-- Main Content (Detail) -->
    <!-- Mobile: Hidden if NO item selected. Desktop: Always visible (flex-1) -->
    <div class="<?php echo e($selectedRequest ? 'flex' : 'hidden md:flex'); ?> flex-1 flex-col h-full relative bg-gray-50">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedRequest): ?>
            <!-- Header -->
            <div class="p-4 bg-white border-b shadow-sm flex items-center gap-3 sticky top-0 z-10">
                <!-- Mobile Back Button -->
                <button wire:click="clearSelection" class="md:hidden p-2 -ml-2 text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>

                <div class="flex items-center gap-3 flex-1">
                    <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center text-[#00A39D] font-bold shrink-0">
                         <?php echo e(substr($selectedRequest->nasabah_name ?? ($selectedRequest->user->name ?? 'U'), 0, 1)); ?>

                    </div>
                    <div>
                         <h2 class="font-bold text-gray-800 text-lg leading-tight line-clamp-1"><?php echo e($selectedRequest->nasabah_name ?? ($selectedRequest->user->name ?? 'Unknown')); ?></h2>
                         <p class="text-sm text-gray-500"><?php echo e($selectedRequest->user->email ?? '-'); ?></p>
                    </div>
                </div>
                <div class="text-xs text-gray-400 font-mono bg-gray-100 px-2 py-1 rounded hidden sm:block">
                    ID: #<?php echo e($selectedRequest->id); ?>

                </div>
            </div>

            <!-- Chat Area -->
            <div class="flex-1 p-4 md:p-6 overflow-y-auto bg-[#e5ddd5]/20" style="background-image: url('https://www.transparenttextures.com/patterns/subtle-white-feathers.png');">
                <!-- User/Nasabah Bubble (Left side like WhatsApp) -->
                <div class="flex justify-start mb-6">
                    <div class="bg-white border text-gray-800 p-4 rounded-r-xl rounded-tl-xl max-w-[85%] md:max-w-lg shadow-md relative">
                         <!-- Triangle -->
                         <div class="absolute top-0 -left-2 w-0 h-0 border-t-[10px] border-t-white border-l-[10px] border-l-transparent transform scale-x-[-1]"></div>
                         
                        <p class="font-bold border-b border-gray-200 pb-2 mb-2 text-gray-600 text-sm tracking-wide">
                            REQUEST: <?php echo e(strtoupper(str_replace('_', ' ', $selectedRequest->type))); ?>

                        </p>
                        <div class="text-sm space-y-1">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_array($selectedRequest->payload)): ?>
                                <div class="bg-gray-50 rounded-lg border border-gray-100 overflow-hidden">
                                    <table class="w-full text-sm text-left">
                                        <tbody>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $selectedRequest->payload; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="border-b border-gray-100 last:border-b-0">
                                                <td class="px-3 py-2 bg-gray-100/50 font-medium text-gray-500 w-1/3 align-top">
                                                    <?php echo e(ucwords(str_replace('_', ' ', $key))); ?>

                                                </td>
                                                <td class="px-3 py-2 font-semibold text-gray-800 break-all">
                                                    <?php echo e($value); ?>

                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="p-3 bg-gray-50 rounded border border-gray-200 text-gray-700">
                                    <?php echo e($selectedRequest->payload); ?>

                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="text-[10px] text-gray-400 text-right mt-2">
                            <?php echo e($selectedRequest->created_at->format('H:i, d M Y')); ?>

                        </div>
                    </div>
                </div>

                <!-- Admin Response Bubble (Right side like WhatsApp) -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedRequest->admin_response): ?>
                <div class="flex justify-end mb-6">
                    <div class="bg-[#d9fdd3] text-gray-800 p-4 rounded-l-xl rounded-tr-xl max-w-[85%] md:max-w-lg shadow-sm relative">
                        <!-- Triangle -->
                        <div class="absolute top-0 -right-2 w-0 h-0 border-t-[10px] border-t-[#d9fdd3] border-r-[10px] border-r-transparent"></div>

                        <p class="text-sm leading-relaxed"><?php echo e($selectedRequest->admin_response); ?></p>
                        
                        <div class="flex justify-between items-center mt-2 pt-1">
                             <!-- Status/Time -->
                             <div class="flex items-center gap-1 ml-auto">
                                <span class="text-[10px] text-gray-500"><?php echo e($selectedRequest->updated_at->format('H:i')); ?></span>
                                <!-- Double Check Icon (Blue for read/processed) -->
                                <svg class="w-3 h-3 text-blue-500" fill="currentColor" viewBox="0 0 16 15"><path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.879a.32.32 0 0 1-.484.033l-.358-.325a.319.319 0 0 0-.484.032l-.378.483a.418.418 0 0 0 .036.541l1.32 1.266c.143.14.361.125.484-.033l6.272-7.655a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.879a.32.32 0 0 1-.484.033L1.891 7.769a.366.366 0 0 0-.515.006l-.423.433a.364.364 0 0 0 .006.514l3.258 3.185c.143.14.361.125.484-.033l3.272-3.991a.366.366 0 0 0-.064-.512z"/></svg>
                             </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Action Area -->
            <div class="p-4 bg-gray-50 border-t sticky bottom-0 z-10 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedRequest->status == 'pending'): ?>
                    <div class="flex gap-3 justify-end">
                        <button wire:click="rejectRequest" wire:confirm="Anda yakin ingin menolak?" class="flex-1 md:flex-none flex justify-center items-center gap-2 bg-white text-red-500 border border-red-500 hover:bg-red-50 px-4 py-2.5 rounded-lg font-semibold transition shadow-sm text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            Tolak
                        </button>
                        <button wire:click="approveRequest" wire:confirm="Anda yakin ingin memproses?" class="flex-1 md:flex-none flex justify-center items-center gap-2 bg-[#00A39D] text-white hover:bg-teal-700 px-4 py-2.5 rounded-lg font-semibold shadow-md transition transform hover:-translate-y-0.5 text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Proses
                        </button>
                    </div>
                <?php else: ?>
                    <div class="text-center py-2 flex flex-col items-center">
                        <span class="text-gray-400 text-sm mb-1">Tiket ini telah selesai.</span>
                        <span class="px-3 py-1 rounded-full text-xs font-bold <?php echo e($selectedRequest->status == 'processed' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'); ?>">
                            <?php echo e(strtoupper($selectedRequest->status)); ?>

                        </span>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php else: ?>
            <!-- Empty State (Desktop Only) -->
            <div class="hidden md:flex flex-col items-center justify-center h-full text-gray-400 bg-gray-50/50">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-600 mb-2">Belum ada request dipilih</h3>
                <p class="text-sm max-w-xs text-center text-gray-500">Pilih tiket dari sebelah kiri.</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php /**PATH /Users/natasyaekanandasoniapuri/Documents/bsionerequest/bsi-portal/resources/views/livewire/admin-requests.blade.php ENDPATH**/ ?>
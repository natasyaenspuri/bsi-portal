<div class="flex flex-col md:flex-row h-[calc(100vh-64px)] bg-gray-50">
    
    <!-- Sidebar List -->
    <!-- Mobile: Hidden if item selected. Desktop: Always visible, width specific -->
    <div class="{{ $selectedRequest ? 'hidden md:block' : 'block' }} w-full md:w-1/3 lg:w-1/4 bg-white border-r border-gray-200 overflow-y-auto h-full shadow-sm z-10">
        <div class="p-4 bg-gray-50 border-b font-bold text-gray-700 sticky top-0 md:static">
            Daftar Tiket Masuk
        </div>
        
        @foreach($requests as $req)
        <div wire:click="selectRequest({{ $req->id }})" class="p-4 border-b hover:bg-teal-50 cursor-pointer transition {{ $req->status == 'pending' ? 'border-l-4 border-l-[#F39C12]' : 'border-l-4 border-l-transparent' }} {{ $selectedRequestId == $req->id ? 'bg-teal-50 border-l-[#00A39D]' : '' }}">
            <div class="flex justify-between items-start">
                <div>
                     <h4 class="font-bold text-gray-800">{{ $req->nasabah_name ?? ($req->user->name ?? 'Unknown') }}</h4>
                    <p class="text-xs text-gray-500 font-medium">
                        @if($req->type == 'new_account') Buka Rekening
                        @elseif($req->type == 'block_account') Blokir Rekening
                        @else Update Data
                        @endif
                    </p>
                </div>
                <span class="text-[10px] text-gray-400">{{ $req->created_at->diffForHumans(null, true) }}</span>
            </div>
            
            <div class="flex justify-between items-center mt-2">
                <span class="text-xs px-2 py-0.5 rounded-full {{ $req->status == 'pending' ? 'bg-yellow-100 text-yellow-800 border border-yellow-200' : ($req->status == 'processed' ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200') }}">
                    {{ ucfirst($req->status) }}
                </span>
            </div>
        </div>
        @endforeach
        
        @if($requests->isEmpty())
            <div class="p-8 text-center text-gray-400 text-sm">
                Belum ada request.
            </div>
        @endif
    </div>

    <!-- Main Content (Detail) -->
    <!-- Mobile: Hidden if NO item selected. Desktop: Always visible (flex-1) -->
    <div class="{{ $selectedRequest ? 'flex' : 'hidden md:flex' }} flex-1 flex-col h-full relative bg-gray-50">
        @if($selectedRequest)
            <!-- Header -->
            <div class="p-4 bg-white border-b shadow-sm flex items-center gap-3 sticky top-0 z-10">
                <!-- Mobile Back Button -->
                <button wire:click="clearSelection" class="md:hidden p-2 -ml-2 text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>

                <div class="flex items-center gap-3 flex-1">
                    <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center text-[#00A39D] font-bold shrink-0">
                         {{ substr($selectedRequest->nasabah_name ?? ($selectedRequest->user->name ?? 'U'), 0, 1) }}
                    </div>
                    <div>
                         <h2 class="font-bold text-gray-800 text-lg leading-tight line-clamp-1">{{ $selectedRequest->nasabah_name ?? ($selectedRequest->user->name ?? 'Unknown') }}</h2>
                         <p class="text-sm text-gray-500">{{ $selectedRequest->user->email ?? '-' }}</p>
                    </div>
                </div>
                <div class="text-xs text-gray-400 font-mono bg-gray-100 px-2 py-1 rounded hidden sm:block">
                    ID: #{{ $selectedRequest->id }}
                </div>
            </div>

            <!-- Chat Area -->
            <div class="flex-1 p-4 md:p-6 overflow-y-auto bg-[#e5ddd5]/20" style="background-image: url('https://www.transparenttextures.com/patterns/subtle-white-feathers.png');">
                <!-- User Bubble -->
                <div class="flex justify-end mb-6">
                    <div class="bg-[#00A39D] text-white p-4 rounded-l-xl rounded-tr-xl max-w-[85%] md:max-w-lg shadow-md relative">
                         <!-- Triangle -->
                         <div class="absolute top-0 -right-2 w-0 h-0 border-t-[10px] border-t-[#00A39D] border-r-[10px] border-r-transparent"></div>
                         
                        <p class="font-bold border-b border-teal-400/50 pb-2 mb-2 text-teal-50 text-sm tracking-wide">
                            REQUEST: {{ strtoupper(str_replace('_', ' ', $selectedRequest->type)) }}
                        </p>
                        <div class="text-sm space-y-1">
                            @if(is_array($selectedRequest->payload))
                                @foreach($selectedRequest->payload as $key => $value)
                                    <div class="flex flex-col sm:flex-row">
                                        <span class="opacity-75 sm:w-32 font-medium text-teal-100">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span>
                                        <span class="font-semibold break-words">{{ $value }}</span>
                                    </div>
                                @endforeach
                            @else
                                <p>{{ $selectedRequest->payload }}</p>
                            @endif
                        </div>
                        <div class="text-[10px] text-teal-200 text-right mt-2">
                            {{ $selectedRequest->created_at->format('H:i, d M Y') }}
                        </div>
                    </div>
                </div>

                <!-- Admin Response Bubble -->
                @if($selectedRequest->admin_response)
                <div class="flex justify-start mb-6">
                    <div class="bg-white border text-gray-800 p-4 rounded-r-xl rounded-tl-xl max-w-[85%] md:max-w-lg shadow-md relative">
                        <!-- Triangle -->
                        <div class="absolute top-0 -left-2 w-0 h-0 border-t-[10px] border-t-white border-l-[10px] border-l-transparent transform scale-x-[-1]"></div>

                        <p class="text-sm leading-relaxed">{{ $selectedRequest->admin_response }}</p>
                        
                        <div class="flex justify-between items-center mt-3 pt-2 border-t border-gray-100">
                             <p class="text-[10px] text-gray-400 flex items-center gap-1 font-bold tracking-wider text-[#F39C12]">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                ADMIN
                            </p>
                            <span class="text-[10px] text-gray-400">{{ $selectedRequest->updated_at->format('H:i') }}</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Action Area -->
            <div class="p-4 bg-gray-50 border-t sticky bottom-0 z-10 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
                @if($selectedRequest->status == 'pending')
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
                @else
                    <div class="text-center py-2 flex flex-col items-center">
                        <span class="text-gray-400 text-sm mb-1">Tiket ini telah selesai.</span>
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $selectedRequest->status == 'processed' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ strtoupper($selectedRequest->status) }}
                        </span>
                    </div>
                @endif
            </div>
        @else
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
        @endif
    </div>
</div>

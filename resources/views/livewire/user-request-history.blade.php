<div>
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Riwayat Pengajuan Nasabah (Anda)</h3>
    
    @if($requests->isEmpty())
        <p class="text-gray-500">Belum ada request yang dibuat.</p>
    @else
        <div class="space-y-4">
            @foreach($requests as $req)
            <div class="border rounded-lg p-4 {{ $req->status == 'processed' ? 'bg-green-50 border-green-200' : ($req->status == 'rejected' ? 'bg-red-50 border-red-200' : 'bg-white border-gray-200') }}">
                <div class="flex justify-between items-start">
                    <div>
                        <span class="font-bold text-[#00A39D]">{{ ucfirst(str_replace('_', ' ', $req->type)) }}</span>
                        <span class="text-xs text-gray-400 block">{{ $req->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <span class="px-2 py-1 rounded text-xs {{ $req->status == 'approved' || $req->status == 'processed' ? 'bg-green-200 text-green-800' : ($req->status == 'rejected' ? 'bg-red-200 text-red-800' : 'bg-yellow-200 text-yellow-800') }}">
                        {{ ucfirst($req->status) }}
                    </span>
                </div>
                
                @if($req->admin_response)
                    <div class="mt-3 text-sm bg-white/50 p-2 rounded border border-gray-100">
                        <span class="font-semibold text-gray-600">Admin Response:</span>
                        <p class="text-gray-800">{{ $req->admin_response }}</p>
                    </div>
                @endif
            </div>
            @endforeach
        </div>
    @endif
</div>

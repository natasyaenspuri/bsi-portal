<?php

namespace App\Livewire;

use App\Models\Rekening;
use App\Models\RequestModel;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class AdminRequests extends Component
{
    public $requests;
    public $selectedRequest;
    public $selectedRequestId;

    public function mount()
    {
        $this->loadRequests();
    }

    public function loadRequests()
    {
        // Fetch all requests, ordered by pending first, then date
        // Note: using CASE instead of FIELD for SQLite compatibility
        $this->requests = RequestModel::with('user')
            ->orderByRaw("CASE status 
                WHEN 'pending' THEN 1 
                WHEN 'processed' THEN 2 
                WHEN 'rejected' THEN 3 
                ELSE 4 
            END")
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function selectRequest($id)
    {
        $this->selectedRequestId = $id;
        $this->selectedRequest = RequestModel::with('user')->find($id);
    }

    public function clearSelection()
    {
        $this->selectedRequestId = null;
        $this->selectedRequest = null;
    }

    public function approveRequest()
    {
        if (!$this->selectedRequest) return;

        DB::transaction(function () {
            // 1. Update Request Status
            $this->selectedRequest->update(['status' => 'processed']);

            // 2. Process based on type
            $responseMessage = "Permintaan disetujui.";

            if ($this->selectedRequest->type == 'new_account') {
                // Create new Rekening (Nasabah Offline)
                $noRekening = '700' . mt_rand(1000000000000, 9999999999999);
                
                // Extract Nasabah data from payload
                $payload = $this->selectedRequest->payload;
                // Handle both array and string payload (safety check)
                if (is_string($payload)) {
                     // Try to decode if string, though usually Livewire handles array casting if trusted
                     $payload = json_decode($payload, true) ?? [];
                }
                
                Rekening::create([
                    'nasabah_name' => $payload['nama_lengkap'] ?? 'Unknown',
                    'nik_ktp' => $payload['nik'] ?? '0000000000000000',
                    'no_hp' => $payload['no_hp'] ?? null,
                    'no_rekening' => $noRekening,
                    'status' => 'active',
                    'saldo' => 50000, // Initial deposit bonus? or 0
                ]);
                $responseMessage .= " No Rekening Baru: " . $noRekening . " a.n " . ($payload['nama_lengkap'] ?? 'Nasabah');
            } elseif ($this->selectedRequest->type == 'block_account') {
                 // Block rekening based on No Rekening in payload or Name
                 // For safety, let's search by No Rekening if provided
                 $targetRekening = $this->selectedRequest->payload['no_rekening'] ?? null;
                 
                 if ($targetRekening) {
                     Rekening::where('no_rekening', $targetRekening)->update(['status' => 'blocked']);
                     $responseMessage .= " Rekening " . $targetRekening . " berhasil diblokir.";
                 } else {
                     $responseMessage .= " Gagal blokir: No Rekening tidak ditemukan di request.";
                 }
            }

            // 3. Save Admin Response
            $this->selectedRequest->update(['admin_response' => $responseMessage, 'admin_id' => auth()->id()]);
        });

        $this->loadRequests();
        $this->selectRequest($this->selectedRequestId); // Refresh selected view
    }

    public function rejectRequest()
    {
        if (!$this->selectedRequest) return;

        $this->selectedRequest->update([
            'status' => 'rejected',
            'admin_response' => 'Maaf, permintaan Anda tidak dapat diproses saat ini. Silakan hubungi cabang terdekat.',
            'admin_id' => auth()->id()
        ]);

        $this->loadRequests();
         $this->selectRequest($this->selectedRequestId);
    }

    public function render()
    {
        return view('livewire.admin-requests');
    }
}

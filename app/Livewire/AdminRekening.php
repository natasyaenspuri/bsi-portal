<?php

namespace App\Livewire;

use App\Models\Rekening;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class AdminRekening extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Actions
    public function blockRekening($id)
    {
        $rekening = Rekening::find($id);
        if ($rekening) {
            $rekening->update(['status' => 'blocked']);
            session()->flash('message', 'Rekening berhasil diblokir.');
        }
    }

    public function unblockRekening($id)
    {
        $rekening = Rekening::find($id);
        if ($rekening) {
            $rekening->update(['status' => 'active']);
             session()->flash('message', 'Blokir rekening dibuka.');
        }
    }
    
    // In a real app we might edit saldo here too, but blocking is the primary request requirement.
    
    public function render()
    {
        $rekenings = Rekening::where('no_rekening', 'like', '%' . $this->search . '%')
            ->orWhere('nasabah_name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin-rekening', [
            'rekenings' => $rekenings
        ]);
    }
}

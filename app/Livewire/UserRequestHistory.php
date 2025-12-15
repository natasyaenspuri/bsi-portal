<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\RequestModel;

class UserRequestHistory extends Component
{
    #[On('request-created')] 
    public function refreshList()
    {
        // This method exists essentially to trigger a re-render when the event is caught
    }

    public function render()
    {
        return view('livewire.user-request-history', [
            'requests' => RequestModel::where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->get()
        ]);
    }
}

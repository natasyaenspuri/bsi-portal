<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\RequestModel;

class UserRequestForm extends Component
{
    public $type = 'new_account'; // Default
    public $nama_lengkap;
    public $nik;
    public $no_hp;
    public $no_rekening;
    public $reason;

    public function submit()
    {
        $rules = [
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16',
            'reason' => 'nullable|string'
        ];

        if ($this->type == 'new_account') {
            $rules['no_hp'] = 'required|numeric|digits_between:10,15';
        } elseif ($this->type == 'block_account') {
            $rules['no_rekening'] = 'required|numeric|digits_between:10,20';
        }

        $this->validate($rules);

        $payload = [
            'nama_lengkap' => $this->nama_lengkap, 
            'nik' => $this->nik,
            'alasan' => $this->reason
        ];

        if ($this->type == 'new_account') {
            $payload['no_hp'] = $this->no_hp;
        } elseif ($this->type == 'block_account') {
            $payload['no_rekening'] = $this->no_rekening;
        }

        RequestModel::create([
            'user_id' => auth()->id(),
            'type' => $this->type,
            'payload' => $payload,
            'status' => 'pending'
        ]);

        $this->reset(['nama_lengkap', 'nik', 'no_hp', 'no_rekening', 'reason']);
        
        session()->flash('message', 'Request berhasil dikirim ke Admin.');
        
        // Dispatch event for real-time history update
        $this->dispatch('request-created'); 
    }

    public function render()
    {
        return view('livewire.user-request-form');
    }
}

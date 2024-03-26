<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{

    public function mount()
    {
        if (auth()->user()->hasRole('user')) {
            return redirect(route('data-diri'));
        }
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}

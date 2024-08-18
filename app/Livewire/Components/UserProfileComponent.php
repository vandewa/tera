<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\User;

class UserProfileComponent extends Component
{
    public $user;

    public function mount($userId)
    {
        $this->user = User::find($userId);
    }
    public function render()
    {
        return view('livewire.components.user-profile-component');
    }
}

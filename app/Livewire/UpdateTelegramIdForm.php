<?php

namespace App\Livewire;

use App\Repository\TelegramRepository;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class UpdateTelegramIdForm extends Component
{

    public $user_id;

    public function mount($userId = null): void
    {
        $this->user_id = $userId;
    }

    public function render()
    {
        return view('profile.update-user-id');
    }

    public function save()
    {

        TelegramRepository::setUserId($this->user_id);
    }
}

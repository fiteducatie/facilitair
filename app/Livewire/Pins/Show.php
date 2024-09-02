<?php

namespace App\Livewire\Pins;

use Livewire\Component;

class Show extends Component
{

    public $pin;
    public $modalBoardActive = false;

    public function render()
    {
        return view('livewire.pins.show');
    }

    public function toggleLike() {
        if(!auth()->user()) {
            return redirect()->route('login');
        }
        $this->pin->likes()->toggle(auth()->user()->id);
        $this->pin->refresh();
    }

    public function saveToBoard($pin) {
        dd($pin);
    }

    public function openModal($pin) {

        $this->modalBoardActive = true;
    }

    public function toggleSave() {
        if (!auth()->user()) {
            return redirect()->route('login');
        }

        $this->pin->saves()->toggle(auth()->user()->id);
        $this->pin->refresh();
        // Toaster::success('Testing!');
    }
}

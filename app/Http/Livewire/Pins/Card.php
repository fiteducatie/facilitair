<?php

namespace App\Http\Livewire\Pins;

use Livewire\Component;

class Card extends Component
{
    public $pin;

    public function render()
    {
        return view('livewire.pins.card');
    }

    public function toggleLike() {
        dd('clicked like button');
    }

    public function toggleSave() {
        dd('clicked save button');
    }
}

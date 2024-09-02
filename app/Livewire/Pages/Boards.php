<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Boards extends Component
{
    public $boards;

    public function __construct() {
        $this->boards = auth()->user()->boards;
    }

    public function render()
    {
        return view('livewire.pages.boards');
    }
}

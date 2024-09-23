<?php

namespace App\Livewire\Pins;

use App\Models\Board;
use Livewire\Component;

class Show extends Component
{

    public $pin;
    public $board;
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

    public function toggleProject() {
        if (!auth()->user()) {
            return redirect()->route('login');
        }

        $this->openProjectModal($this->pin);
    }

    public function openProjectModal() {
        $this->modalBoardActive = true;

    }

    public function closeProjectModal() {

    }

    public function addToProject() {
        $board = Board::find($this->board);
        $board->pins()->syncWithoutDetaching($this->pin);
        $this->modalBoardActive = false;

    }

    public function setBoard($board) {
        $this->board = $board;
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

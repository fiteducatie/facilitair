<?php

namespace App\Livewire\Pages;

use App\Models\Board;
use App\Models\Pin;
use Livewire\Attributes\On;
use Livewire\Component;

class BoardsDetail extends Component
{
    public $board;
    public $boardToSet;
    public $projectModalActive = false;
    public $pin;

    public function mount($board) {
        $board = Board::findOrFail($board);
        $this->board = $board;
    }

    public function render()
    {
        return view('livewire.pages.boards-detail');
    }

    #[On('openProjectModal')]
    public function openModal(Pin $pin) {
        $this->pin = $pin;
        $this->projectModalActive = true;
    }

    #[On('closeProjectModal')]
    public function closeModal() {
        $this->pin = null;
        $this->projectModalActive = false;
    }

    public function setBoard($board) {
        $board = Board::findOrFail($board);
        $this->boardToSet = $board;

    }

    public function addToProject() {

        $this->boardToSet->pins()->syncWithoutDetaching($this->pin);
        $this->projectModalActive = false;
        // restart page
        return redirect()->route('board.show', $this->board->id);

    }

}

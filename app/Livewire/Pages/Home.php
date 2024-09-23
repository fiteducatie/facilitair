<?php

namespace App\Livewire\Pages;

use App\Models\Board;
use App\Models\Pin;
use Livewire\Attributes\On;
use Livewire\Component;

class Home extends Component
{
    public $perPage = 10;
    public $testPerPage = 10;
    public $projectModalActive = false;
    public $pin;
    public $board;

    public function mount() {

    }

    public function render()
    {
        if(request()->get('c')) {
            $category = \App\Models\Category::where('id', request()->get('c'))->first();
            // dd($category);
            $pins = $category->pins()->withoutGlobalScope('ownpins')->paginate($this->perPage);

        } else if(request()->get('t')) {
            $pins = \App\Models\Pin::withoutGlobalScope('ownpins')->withAnyTags(request()->get('t'))
                    ->paginate($this->perPage);


        } else if(request()->get('s')) {
            $searchTerm = request()->get('s');
            $pins = Pin::withoutGlobalScope('ownpins')->where('title', 'like', '%' . $searchTerm . '%')
                ->orWhereHas('tags', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', '%' . $searchTerm . '%');
                })

                ->with('tags')
                ->paginate($this->perPage);

        } else {
            $pins = \App\Models\Pin::withoutGlobalScope('ownpins')->paginate($this->perPage);
        }

        return view('livewire.pages.home', [
            'pins' => $pins,
        ]);
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
        $this->board = $board;

    }

    public function addToProject() {
        $board = Board::find($this->board);
        $board->pins()->syncWithoutDetaching($this->pin);
        $this->projectModalActive = false;

    }

}

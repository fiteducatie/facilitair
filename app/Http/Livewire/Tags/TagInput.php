<?php

namespace App\Http\Livewire\Tags;

use Livewire\Component;
use Spatie\Tags\Tag;

class TagInput extends Component
{
    public $tags = [];
    public $search = '';
    public $chosenTags = [];
    public $selectedTags = [];

    public function mount($old_tags = null) {
        $this->tags = Tag::all();
        if($old_tags) {
            $this->chosenTags = $old_tags->pluck('name')->toArray();
        }
    }

    public function render()
    {
        return view('livewire.tags.tag-input');
    }

    public function deleteTag($tag) {
        $this->chosenTags = array_diff($this->chosenTags, [$tag]);
    }

    public function addTag($tagname = null) {
        if($tagname) {
            $this->chosenTags[] = $tagname;
            $this->search = '';
            $this->selectedTags = [];
        }  else {
            if (strlen($this->search)) {
                $this->chosenTags[] = $this->search;
                $this->search = '';
                $this->selectedTags = [];
            }
        }
    }

    public function searchTag() {

        if(strlen($this->search)) {
            $this->selectedTags = Tag::where('name', 'like', '%' . $this->search . '%')->get();
        } else {
            $this->selectedTags = [];
        }
    }


}

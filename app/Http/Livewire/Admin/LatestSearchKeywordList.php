<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\SearchKeyword;

class LatestSearchKeywordList extends Component
{
    public  $keywords;

    public function mount()
    {
        $this->keywords = SearchKeyword::getLastSearchKeywords(9);
    }


    public function render()
    {
        return view('admin.components.latest-search-keyword-list');
    }
}

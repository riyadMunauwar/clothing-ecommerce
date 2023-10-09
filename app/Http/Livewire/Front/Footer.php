<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\FooterColumn;
use Illuminate\Support\Facades\Cache; 

class Footer extends Component
{

    protected $footerColumns;


    public function mount()
    {
        $this->footerColumns = $this->getFooterColumns();

        dd($this->getFooterColumnsItems());
    }


    public function render()
    {
        return view('front.components.footer')->with(['footerColumns' => $this->footerColumns]);
    }

    private function getFooterColumns()
    {
        $cacheKey = config('cache_keys.footer_items_cache_key');

        $footerColumns = Cache::remember( $cacheKey, config('cache.cache_ttl'), function(){
            return $this->getFooterColumnsItems();
        });

        return $footerColumns;
    }

 
    private function getFooterColumnsItems() {
        
        $footerColumns = FooterColumn::with('attributes:name,link')
            ->select('id', 'column_title')
            ->where('is_published', true)
            ->get();


        return $footerColumns;
    }
}

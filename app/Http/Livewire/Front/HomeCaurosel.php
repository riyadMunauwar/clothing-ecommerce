<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Illuminate\Support\Facades\Cache; 
use App\Models\Caurosel;

class HomeCaurosel extends Component
{

    public $slides = [];


    public function mount()
    {
        $this->slides = $this->getHomeCaurosel();

        dd($this->slides);
    }

    public function render()
    {
        return view('front.components.home-caurosel');
    }

    private function getHomeCaurosel()
    {
        $cacheKey = config('cache_keys.caurosel_list_cache_key');

        $menus = Cache::remember($cacheKey, config('cache.cache_ttl'), function(){
            return $this->queryHomeCauroselFromDb();
        });

        return $menus;
    }

 
    private function queryHomeCauroselFromDb() {

        return Caurosel::select('id')->withWhereHas('slides', function($query){
            $query->select('id')->where('is_published', true);
        })
        ->where('is_published', true)
        ->where('show_in_page', 'home-caurosel')
        ->first();

    }
}

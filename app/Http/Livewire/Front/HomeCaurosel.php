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
        $slides = $this->getHomeCaurosel()->slides;

        if($slides) {
            $this->slides = $slides;
        }

    }

    public function render()
    {
        return view('front.components.home-caurosel');
    }

    private function getHomeCaurosel()
    {
        $cacheKey = config('cache_keys.home_caurosel_cache_key');

        $caurosel = Cache::remember($cacheKey, config('cache.cache_ttl'), function(){
            return $this->queryHomeCauroselFromDb();
        });

        return $caurosel;
    }

 
    private function queryHomeCauroselFromDb() {

        return Caurosel::select('id')->with('slides')
        ->where('is_published', true)
        ->where('show_in_page', 'intro-caurosel')
        ->first();

    }
}

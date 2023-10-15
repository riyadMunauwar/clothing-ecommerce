<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\SocialLink;
use Illuminate\Support\Facades\Cache; 

class SocialLinks extends Component
{

    public $socialLinks = [];

    public function mount()
    {
        $this->socialLinks = $this->getSocialLinks();
    }


    public function render()
    {
        return view('front.components.social-links');
    }


    private function getSocialLinks()
    {
        $cacheKey = config('cache_keys.social_link_list_cache_key');

        $links = Cache::remember($cacheKey, config('cache.cache_ttl'), function(){
            return $this->querySocialLinkFromDb();
        });

        return $links;
    }

 
    private function querySocialLinkFromDb() {

        return SocialLink::select('link')->where('is_published', true)->get();

    }


    public function getMainDomain($url) {
        // Use parse_url to extract the host from the URL
        $urlParts = parse_url($url);
    
        // Check if the host is present
        if (isset($urlParts['host'])) {
            $host = $urlParts['host'];
    
            // Split the host into its parts using dot as a delimiter
            $hostParts = explode('.', $host);
    
            // Check if there are at least two parts in the host
            if (count($hostParts) >= 2) {
                // Get the last two parts, which constitute the main domain
                $mainDomain = $hostParts[count($hostParts) - 2] . '.' . $hostParts[count($hostParts) - 1];
                return $mainDomain;
            }
        }
    
        // Return an empty string if the URL does not contain a valid domain
        return '';
    }
}

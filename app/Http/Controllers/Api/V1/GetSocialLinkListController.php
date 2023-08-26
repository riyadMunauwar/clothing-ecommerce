<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SocialLinkCollectionResource;
use App\Models\SocialLink;
use Illuminate\Support\Facades\Cache; 
use App\Traits\HttpJsonResponses;

class GetSocialLinkListController extends Controller
{
    use HttpJsonResponses;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {

            $socialLinks = $this->getSocialLinks();

            return SocialLinkCollectionResource::collection($socialLinks)->additional($this->jsonSuccessResponseMetaData());


        }catch(\Exception $e){
            return $this->jsonErrorResponse($e->getMessage());
        }

    }


    private function getSocialLinks()
    {
        return Cache::remember(config('cache_keys.social_link_list_cache_key'), config('cache.cache_ttl'), function(){
            return SocialLink::with('media')->published()->get();
        });
    }
}

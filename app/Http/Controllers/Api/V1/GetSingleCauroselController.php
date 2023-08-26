<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Caurosel;
use App\Http\Resources\CauroselResource;
use Illuminate\Support\Facades\Cache;
use App\Traits\HttpJsonResponses;

class GetSingleCauroselController extends Controller
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

            $showInPage = $request->page;

            $cacheKey = "caurosel:{$showInPage}";

            $caurosel = $this->getCaurosel($showInPage, $cacheKey);

            if(!$caurosel) return $this->jsonErrorResponse('Caurosel not found !', 404);

            return CauroselResource::make($caurosel)->additional($this->jsonSuccessResponseMetaData());

        }catch(\Exception $e){
            return $this->jsonErrorResponse($e->getMessage());
        }
    }


    private function getCaurosel($showInPage, $cacheKey)
    {
        return Cache::remember($cacheKey, config('cache.cache_ttl'), function() use($showInPage, $cacheKey){
            return $this->getCauroselBySlugAndSaveCacheKey($showInPage, $cacheKey);
        });
    }


    private function getCauroselBySlugAndSaveCacheKey($showInPage, $cacheKey)
    {
        $caurosel = Caurosel::with('slides', 'media')->published()->where('show_in_page', $showInPage)->first();

        if(!$caurosel) return null;

        $caurosel->cache_key = $cacheKey;

        $caurosel->save();

        return $caurosel;
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\FooterColumn;
use App\Models\FooterColumnAttribute;
use App\Traits\HttpJsonResponses;
use App\Http\Resources\FooterColumnCollectionResource;


class GetFooterItemsController extends Controller
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

            $footerItems = $this->getFooterItems();
            return FooterColumnCollectionResource::collection($footerItems)->additional($this->jsonSuccessResponseMetaData());

        }catch(\Exception $e){
            return $this->jsonErrorResponse($e->getMessage());
        }
    }

    public function getFooterItems()
    {
        return Cache::rememberForever(config('cache_keys.footer_items_cache_key'), function(){
            return FooterColumn::with('attributes')->published()->get();
        });
    }
}

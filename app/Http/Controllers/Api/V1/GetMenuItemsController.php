<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Http\Resources\MenuItemCollectionResource;
use App\Traits\HttpJsonResponses;
use Illuminate\Support\Facades\Cache;


class GetMenuItemsController extends Controller
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

            $menuItems = $this->getMenu();

            return MenuItemCollectionResource::collection($menuItems)->additional($this->jsonSuccessResponseMetaData());

        }catch(\Exception $e){
            return jsonErrorResponse($e->getMessage());
        }
    }


    private function getMenu()
    {
        return Cache::rememberForever(config('cache_keys.footer_items_cache_key'), function(){
            return Menu::with('media', 'category')->published()->get();
        });
    }   
}

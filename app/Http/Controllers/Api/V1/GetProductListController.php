<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductCollectionResource;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use App\Traits\HttpJsonResponses;

class GetProductListController extends Controller
{

    use HttpJsonResponses;


    public function __invoke(Request $request)
    {

        try {

            $products = $this->paginateAllProduct($request);

            return ProductCollectionResource::collection($products)->additional($this->jsonSuccessResponseMetaData());

        }catch(\Exception $e){

            return $this->jsonErrorResponse($e->getMessage());

        }

    }


    private function paginateAllProduct($request)
    {
        $productPerPage = $request->query('per_page', 25);

        $page = $request->query('page', 1);

        $searchQuery = $request->query('q', '');

        return  $this->getProducts($productPerPage, $page, $searchQuery);
    }


    private function getProducts($perPage, $page, $searchQuery)
    {
        return Product::published()
                        ->with('media')
                        ->when($searchQuery, function($query) use($searchQuery){
                            $query->where('name', 'like', '%' . $searchQuery . '%')
                                ->orWhere('name',  $searchQuery);
                        })
                        ->paginate($perPage, ['*'], 'page', $page);
    }

}

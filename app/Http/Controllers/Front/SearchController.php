<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $query = $request->query;

        if(!$query) return redirect()->back();

        $products = $this->queryProducts($query);

        return view('front.pages.search', compact('query', 'products'));
    }


    private function queryProducts($search_query)
    {
        $query = Product::query();

        $query->where('name', 'like', '%' . $search_query . '%')
              ->orWhere('name', $search_query)
              ->orWhere('description', 'like', '%' . $search_query . '%')
              ->orWhere('description', $search_query)
              ->orWhere('short_description', 'like', '%' . $search_query . '%')
              ->orWhere('short_description', $search_query);



        return $query->paginate(12);
    }
}

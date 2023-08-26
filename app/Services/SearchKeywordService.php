<?php 

namespace App\Services;

use App\Models\SearchKeyword;

class SearchKeywordService {


    public function processKeyword($keyword, $results = 0)
    {
        $keywordSearchDeatil = SearchKeyword::firstOrCreate(['keyword' => $keyword]);

        $keywordSearchDeatil->increment('hits', 1);

        $keywordSearchDeatil->results = $results;

        return $keywordSearchDeatil->save();
    }

    public function getLastSearchKeywords($limit = 15, $hours = 24)
    {
        return SearchKeyword::getLastSearchKeywords($limit, $hours);
    }

}
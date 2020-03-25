<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Series;
use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{
    public function search(SearchRequest $request)
    {
        $query = trim($request->query('term'));

        $series = Series::with('episodes')
            ->where('title', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->orWhereHas('episodes', function (Builder $builder) use ($query) {
                $builder->where('title', 'like', "%$query%")
                    ->orWhere('description', 'like', "%$query%");
            })
            ->paginate(10);

        return view('search.index', compact('series', 'query'));
    }
}

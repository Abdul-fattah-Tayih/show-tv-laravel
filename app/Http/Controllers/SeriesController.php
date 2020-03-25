<?php

namespace App\Http\Controllers;

use App\Series;
use App\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $series = Series::latest()->paginate(10);
        return view('series.index', compact('series'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Series $series
     * @return View
     */
    public function show($seriesId)
    {
        $series = Series::withCount('followingUsers')->findOrFail($seriesId);
        $episodes = $series->episodes;
        $userWithFollows = [];

        if (auth()->user()) {
            $userWithFollows = User::with(['followedSeries' => function ($query) use ($seriesId) {
                $query->where('series_id', $seriesId);
            }])->findOrFail(auth()->user()->id);
        }

        return view('series.show', compact('series', 'episodes', 'userWithFollows'));
    }

    public function follow(Series $series)
    {
        abort_unless(auth()->user() !== null, 403);

        $series->followingUsers()->attach(auth()->user()->id);

        return response('success', 201);
    }

    public function unfollow(Series $series)
    {
        abort_unless(auth()->user() !== null, 403);

        $series->followingUsers()->detach(auth()->user()->id);

        return response('success', 200);
    }
}

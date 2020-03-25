<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Reaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EpisodesController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  Episode  $episode
     * @return View
     */
    public function show($episodeId)
    {
        $episode = Episode::with('reactions')->findOrFail($episodeId);

        $userWithReactions = [];

        if (auth()->user()) {
            $userWithReactions = User::with(['reactions' => function ($query) use ($episodeId) {
                $query->where('episode_id', $episodeId);
            }])->findOrFail(auth()->user()->id);
        }

        return view('episodes.show', compact('userWithReactions', 'episode'));
    }

    public function react(Request $request, Episode $episode)
    {
        abort_unless(auth()->user() !== null, 403);

        $request->validate([
            'reaction_id' => ['required', 'numeric', 'exists:reactions,id']
        ]);

        $episode->reactions()->attach([$request->reaction_id => ['user_id' => auth()->user()->id]]);

        return response()->json([
            'reaction_id' => $request->reaction_id,
            'episode_id' => $episode->id,
            'name' => Reaction::find($request->reaction_id)->name,
        ], 201);
    }

    public function removeReact(Request $request, Episode $episode)
    {
        abort_unless(auth()->user() !== null, 403);

        $episode->reactions()
            ->detach($request->reaction_id);

        return response()->json([], 200);
    }
}

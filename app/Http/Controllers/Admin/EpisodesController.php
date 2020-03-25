<?php

namespace App\Http\Controllers\Admin;

use App\Episode;
use App\Http\Controllers\Controller;
use App\Series;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EpisodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.episodes.index', ['episodes' => Episode::with('series')->latest()->paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.episodes.create', ['series' => Series::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'air_time' => ['required', 'date'],
            'duration' => ['required', 'numeric'],
            'thumbnail' => ['required', 'image', 'max:1024'],
            'asset' => ['required', 'file', 'max:20000', 'mimes:mp4,mpeg,wmv'],
            'series_id' => ['required', 'exists:series,id'],
        ]);

        Episode::create([
            'title' => $request->title,
            'description' => $request->description,
            'air_time' => $request->air_time,
            'duration' => $request->duration,
            'thumbnail' => $request->thumbnail->store('/thumbnails', ['disk' => 'public']),
            'asset' => $request->asset->store('/assets', ['disk' => 'public']),
            'series_id' => $request->series_id,
        ]);

        session()->flash('success', 'Episode created successfully');

        return redirect()->to(route('admin.episode.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Episode $episode
     * @return View
     */
    public function show(Episode $episode)
    {
        return view('admin.episodes.show', compact('episode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Episode $episode
     * @return View
     */
    public function edit(Episode $episode)
    {
        $series = Series::all();
        return view('admin.episodes.edit', compact('episode', 'series'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Episode $episode
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Episode $episode)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'air_time' => ['required', 'date'],
            'thumbnail' => ['nullable', 'image', 'max:1024'],
            'asset' => ['nullable', 'file', 'max:20000', 'mimes:mp4,mpeg,wmv'],
            'series_id' => ['required', 'exists:series,id'],
        ]);

        $createArr = [
            'title' => $request->title,
            'description' => $request->description,
            'air_time' => $request->air_time,
            'series_id' => $request->series_id,
        ];

        if ($request->thumbnail) {
            $createArr['thumbnail'] = $request->thumbnail->store('/thumbnails', ['disk' => 'public']);
        }

        if ($request->asset) {
            $createArr['asset'] = $request->asset->store('/assets', ['disk' => 'public']);
        }

        $episode->update($createArr);

        session()->flash('success', 'Episode updated successfully');

        return redirect()->to(route('admin.episode.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Episode::destroy($id);

        session()->flash('success', 'Episode deleted successfully');

        return redirect()->to(route('admin.episode.index'));
    }
}

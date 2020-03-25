<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Series;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.series.index', ['series' => Series::withCount(['episodes', 'followingUsers'])->paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.series.create');
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'air_time_from' => ['required', 'string', Rule::in(Carbon::getDays())],
            'air_time_to' => ['required', 'string', Rule::in(Carbon::getDays())],
            'air_time_at' => ['required', 'string', 'date_format:H:i']
        ]);

        $series = Series::create([
            'title' => $request->title,
            'description' => $request->description,
            'air_time' => json_encode([
                    'from_day' => $request->air_time_from,
                    'to_day' => $request->air_time_to,
                    'time' => $request->air_time_at
                ]),
        ]);

        session()->flash('success', "created '$series->title' successfully");

        return redirect(route('series.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Series $series
     * @return \Illuminate\View\View
     */
    public function show(Series $series)
    {
        return view('admin.series.show', compact('series'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Series $series
     * @return \Illuminate\View\View
     */
    public function edit(Series $series)
    {
        return view('admin.series.edit', compact('series'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Series::destroy($id);

        session()->flash('success', 'Series deleted');

        return redirect(route('series.index'));
    }
}

@extends('layouts.app')

@section('title')
    <div class="bg-white p-4 shadow-sm">
        <h2>Series</h2>
    </div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($series as $singleSeries)
            <div class="col-12 my-2">
                <div class="card rounded shadow-sm">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-4">
                                <img class="img-thumbnail" src="{{ asset($singleSeries->latestEpisodeThumbnail) }}">
                            </div>
                            <div class="col-8 p-4">
                                <a href="{{ route('series.show', ['series' => $singleSeries]) }}">
                                    <h3>{{ $singleSeries->title }}</h3>
                                </a>
                                <p>{!! $singleSeries->description !!}</p>
                                <p class="text-secondary">
                                    <b>{{ $singleSeries->from_day }}</b> - <b>{{ $singleSeries->to_day }}</b> at {{ $singleSeries->time }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $series->links() }}
    </div>
</div>
@endsection

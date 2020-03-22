@extends('layouts.app')

@section('title')
    <div class="bg-white p-4 shadow-sm">
        <h2>Results for {{ $query }}</h2>
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
                                <img class="img-thumbnail" src="{{ $singleSeries->latestEpisodeThumbnail ?? 'https://i1.ytimg.com/vi/Dtvw-MVGD0g/maxresdefault.jpg' }}">
                            </div>
                            <div class="col-8 p-4">
                                <a href="{{ route('series.show', ['series' => $singleSeries]) }}">
                                    <h3>{{ $singleSeries->title }}</h3>
                                </a>
                                <p>{!! $singleSeries->description !!}</p>
                                <p class="text-secondary">
                                    <b>{{ $singleSeries->from_day }}</b> - <b>{{ $singleSeries->to_day }}</b> at {{ $singleSeries->time }}
                                </p>
                                <h4>Episodes</h4>
                                <ul>
                                    @foreach($singleSeries->episodes as $episode)
                                        <li><a href="{{ route('episode.show', ['episode' => $episode]) }}">{{ $episode->title }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $series->appends(['term' => request()->term])->links() }}
    </div>
</div>
@endsection

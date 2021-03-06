@extends('admin.layouts.app')

@section('title')
    <div class="bg-white p-4 shadow-sm">
        <h2>{{ $series->title }}</h2>
    </div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-12 my-2">
            <div class="card rounded shadow-sm">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-4">
                            <img class="img-thumbnail" src="{{ $series->latestEpisodeThumbnail ?? 'https://i1.ytimg.com/vi/Dtvw-MVGD0g/maxresdefault.jpg' }}">
                        </div>
                        <div class="col-8 p-4">
                            <h3>{{ $series->title }}</h3>
                            <p>{!! $series->description !!}</p>
                            <p class="text-secondary">
                                <b>{{ $series->from_day }}</b> - <b>{{ $series->to_day }}</b> at {{ $series->time }}
                            </p>
                            <a href="{{ route('admin.series.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

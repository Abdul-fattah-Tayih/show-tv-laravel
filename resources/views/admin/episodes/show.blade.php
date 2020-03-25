@extends('admin.layouts.app')

@section('title')
    <div class="bg-white p-4 shadow-sm">
        <h2>{{ $episode->title }}</h2>
    </div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-12 my-2">
            <div class="card rounded shadow-sm">
                <div class="card-img-top">
                    <video height="640" width="480" controls>
                        <source src="{{ asset($episode->asset) }}" type="video/mp4">
                    </video>
                </div>
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-4">
                            <img class="img-thumbnail" src="{{ asset($episode->thumbnail) }}">
                        </div>
                        <div class="col-8 p-4">
                            <h3>{{ $episode->title }}</h3>
                            <p>{!! $episode->description !!}</p>
                            <p class="text-secondary">
                                <b>{{ $episode->formatted_air_time }}</b>
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

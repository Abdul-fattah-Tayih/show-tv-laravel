@extends('layouts.app')

@section('title')
    <div class="bg-white p-4 shadow-sm">
        <h2>Home</h2>
        Latest Episodes
    </div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($episodes as $episode)
            <div class="col-12 my-2">
                <div class="card rounded shadow-sm">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-4">
                                <img class="img-thumbnail" src="{{ $episode->thumbnail ?? 'https://i1.ytimg.com/vi/Dtvw-MVGD0g/maxresdefault.jpg' }}">
                            </div>
                            <div class="col-8 p-4">
                                <a href="{{ route('episode.show', ['episode' => $episode->id]) }}">
                                    <h3>{{ $episode->title }}</h3>
                                </a>
                                <p>{!! $episode->description !!}</p>
                                <p class="text-secondary">
                                    <b>{{ $episode->formatted_duration }}</b> <br>
                                    {{ $episode->formatted_air_time }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $episodes->links() }}
    </div>
</div>
@endsection

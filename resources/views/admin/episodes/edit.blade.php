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
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.episode.update', ['episode' => $episode]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $episode->title) }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{ old('description', $episode->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Air time</label>
                            <input type="datetime-local" name="air_time" class="form-control @error('air_time') is-invalid @enderror" value="{{ old('air_time', $episode->air_time) }}">
                            @error('air_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Duration (in seconds)</label>
                            <input type="number" name="duration" class="form-control" value="{{ old('duration', $episode->duration) }}">
                            @error('duration')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Series</label>
                            <select name="series_id" class="form-control">
                                @foreach($series as $singleSeries)
                                    <option value="{{ $singleSeries->id }}">{{ $singleSeries->title }}</option>
                                @endforeach
                            </select>
                            @error('air_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Thumbnail</label>
                            <input id="thumbnail" type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail">
                            @error('thumbnail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Asset</label>
                            <input id="asset" type="file" class="form-control @error('asset') is-invalid @enderror" name="asset">
                            @error('asset')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="submit" class="btn btn-primary" value="update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

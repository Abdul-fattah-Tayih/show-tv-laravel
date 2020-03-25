@extends('admin.layouts.app')

@section('title')
    <div class="bg-white p-4 shadow-sm">
        <h2>Create series</h2>
    </div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 my-2">
            <div class="card rounded shadow-sm">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.series.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Air time</label>
                            <label>From day</label>
                            <select class="form-control @error('air_time_from') is-invalid @enderror" name="air_time_from">
                                @foreach(\Carbon\Carbon::getDays() as $day)
                                    <option @if(old('air_time_from')) selected @endif value="{{ $day }}">{{ $day }}</option>
                                @endforeach
                            </select>
                            @error('air_time_from')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label>To day</label>
                            <select class="form-control @error('air_time_to') is-invalid @enderror" name="air_time_to">
                                @foreach(\Carbon\Carbon::getDays() as $day)
                                    <option @if(old('air_time_to')) selected @endif value="{{ $day }}">{{ $day }}</option>
                                @endforeach
                            </select>
                            @error('air_time_to')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label>at</label>
                            <input type="time" name="air_time_at" class="form-control @error('air_time_at') is-invalid @enderror" value="{{ old('air_time_at') }}">
                            @error('air_time_at')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="submit" class="btn btn-primary" value="create">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

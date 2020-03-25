@extends('admin.layouts.app')

@section('title')
    <div class="bg-white p-4 shadow-sm">
        <h2>Series</h2>
        Series list
    </div>
@endsection

@section('content')
<div class="container">
    @if(session()->has('success'))
        <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif
    <div class="row justify-content-center">
        <div class="col bg-white p-4 shadow-sm">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th></th>
                        <th>Title</th>
                        <th>Likes</th>
                        <th>Dislikes</th>
                        <th>Series</th>
                        <th><a class="btn btn-primary" href="{{ route('admin.episode.create') }}">Create</a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($episodes as $index => $episode)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><img style="max-height: 3rem" class="rounded-circle" src="{{ asset($episode->thumbnail) }}"></td>
                            <td><a href="{{ route('admin.episode.show', ['episode' => $episode]) }}">{{ $episode->title }}</a></td>
                            <td>{{ $episode->getLikes() }}</td>
                            <td>{{ $episode->getDislikes() }}</td>
                            <td><a href="{{ route('admin.series.show', ['series' => $episode->series]) }}">{{ $episode->series->title }}</a></td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('admin.episode.edit', ['episode' => $episode]) }}">Edit</a>
                                <form method="POST" class="d-inline" action="{{ route('admin.episode.destroy', ['episode' => $episode]) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                {{ $episodes->links() }}
            </table>
        </div>
    </div>
</div>
@endsection

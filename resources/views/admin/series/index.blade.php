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
                        <th>Title</th>
                        <th>Followers</th>
                        <th>Episodes</th>
                        <th><a class="btn btn-primary" href="{{ route('admin.series.create') }}">Create</a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($series as $index => $singleSeries)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><a href="{{ route('admin.series.show', ['series' => $singleSeries]) }}">{{ $singleSeries->title }}</a></td>
                            <td>{{ $singleSeries->following_users_count }}</td>
                            <td>{{ $singleSeries->episodes_count }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('admin.series.edit', ['series' => $singleSeries]) }}">Edit</a>
                                <form method="POST" class="d-inline" action="{{ route('admin.series.destroy', ['series' => $singleSeries]) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                {{ $series->links() }}
            </table>
        </div>
    </div>
</div>
@endsection

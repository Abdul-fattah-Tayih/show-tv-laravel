@extends('admin.layouts.app')

@section('title')
    <div class="bg-white p-4 shadow-sm">
        <h2>Home</h2>
        User list
    </div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col bg-white p-4">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>image</th>
                        <th>name</th>
                        <th>email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><img src="{{ $user->user_image }}" style="max-height: 3rem"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
                {{ $users->links() }}
            </table>
        </div>
    </div>
</div>
@endsection

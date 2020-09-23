@extends('template')

@section('content')

<h1>All the organization</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>guid</td>
            <td>created_at</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($organization as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->guid }}</td>
            <td>{{ $value->created_at }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the shark (uses the destroy method DESTROY /organization/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->

                <!-- show the shark (uses the show method found at GET /organization/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('organization/' . $value->id) }}">Show this shark</a>

                <!-- edit this shark (uses the edit method found at GET /organization/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('organization/' . $value->id . '/edit') }}">Edit this shark</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection

@extends('template.template')

@section('content')

<a href="{{ URL::to('manage/organization/create') }}">Create Organization</a>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>ID</td>
			<td>Name</td>
			<td>Guid</td>
			<td>Created</td>
			<td>Actions</td>
		</tr>
	</thead>
	<tbody>
	@foreach($organization as $key => $value)
		<tr>
			<td>{{ $key + 1 }}</td>
			<td>{{ $value->name }}</td>
			<td>{{ $value->guid }}</td>
			<td>{{ $value->created_at }}</td>
			<td>
				<a class="btn btn-small btn-success" href="{{ URL::to('manage/organization/' . $value->id) }}">Show</a>

				<a class="btn btn-small btn-info" href="{{ URL::to('manage/organization/' . $value->id . '/edit') }}">Edit</a>

				<form class="d-inline" action="/manage/organization/{{ $value->id }}/" method="post">
					@csrf
					@method('DELETE')
					<input type="submit" value="Delete" class="btn btn-small btn-danger">
				</form>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

@endsection

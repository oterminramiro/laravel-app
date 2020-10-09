@extends('template.template')

@section('content')

@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>ID</td>
			<td>Organization</td>
			<td>Location</td>
			<td>Name</td>
			<td>Col</td>
			<td>Row</td>
			<td>Available</td>
			<td>Created</td>
			<td>Actions</td>
		</tr>
	</thead>
	<tbody>
	@foreach($layout as $key => $value)
		<tr>
			<td>{{ $key + 1 }}</td>
			<td>{{ $value->Organization->name }}</td>
			<td>{{ $value->Location->name }}</td>
			<td>{{ $value->name }}</td>
			<td>{{ $value->col }}</td>
			<td>{{ $value->row }}</td>
			<td>{{ $value->available }}</td>
			<td>{{ $value->created_at }}</td>
			<td>
				<a class="btn btn-small btn-success" href="{{ URL::to('manage/layouts/' . $value->id) }}">Show</a>

				<a class="btn btn-small btn-info" href="{{ URL::to('manage/layouts/' . $value->id . '/edit') }}">Edit</a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

@endsection

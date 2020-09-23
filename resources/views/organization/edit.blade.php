@extends('template')

@section('content')

	<h1>Edit {{ $organization->name }}</h1>

	<!-- if there are creation errors, they will show here -->
	@foreach ($errors->all() as $error)
		{{ $error }}
	@endforeach

	<form method="post" action="/organization/{{ $organization->id }}/">
		@method('PUT')
		@csrf
		<div class="form-group">
			<label>Name</label>
			<input type="text" class="form-control" name="name" id="name">
		</div>

		<input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
	</form>

@endsection

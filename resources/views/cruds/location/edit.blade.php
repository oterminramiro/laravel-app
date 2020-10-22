@extends('template.template')

@section('content')

	<h1>Edit {{ $location->name }}</h1>

	@foreach ($errors->all() as $error)
		{{ $error }}
	@endforeach

	<form method="post" action="/manage/locations/{{ $location->id }}/">
		@method('PUT')
		@csrf
		<div class="form-group">
			<label>Name</label>
			<input type="text" class="form-control" name="name" id="name" value="{{ $location->name }}">
		</div>
		<div class="form-group">
			<label>Cols</label>
			<input type="text" class="form-control" name="cols" id="cols" value="{{ $location->cols }}">
		</div>
		<div class="form-group">
			<label>Rows</label>
			<input type="text" class="form-control" name="rows" id="rows" value="{{ $location->rows }}">
		</div>
		<div class="form-group">
			<label>Since</label>
			<input type="time" class="form-control" name="since" id="since" value="{{ $location->since }}">
		</div>
		<div class="form-group">
			<label>Until</label>
			<input type="time" class="form-control" name="until" id="until" value="{{ $location->until }}">
		</div>

		<input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
	</form>

@endsection

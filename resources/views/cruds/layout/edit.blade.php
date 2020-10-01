@extends('template.template')

@section('content')

	<h1>Edit {{ $layout->name }}</h1>

	@foreach ($errors->all() as $error)
		{{ $error }}
	@endforeach

	<form method="post" action="/manage/layout/{{ $layout->id }}/">
		@method('PUT')
		@csrf
		<div class="form-group">
			<label>Name</label>
			<input type="text" class="form-control" name="name" id="name" value="{{ $layout->name }}">
		</div>
		<div class="form-group">
			<label>Available</label>
			<input type="text" class="form-control" name="available" id="available" value="{{ $layout->available }}">
		</div>

		<input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
	</form>

@endsection

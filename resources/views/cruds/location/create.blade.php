@extends('template.template')

@section('content')

	<h1>Create a Location</h1>

	@foreach ($errors->all() as $error)
		{{ $error }}
	@endforeach

	<form method="post" action="/manage/locations/">
		@csrf
		<div class="form-group">
			<label>Organization</label>
			<input type="text" class="form-control" name="idorganization" id="idorganization">
		</div>
		<div class="form-group">
			<label>Name</label>
			<input type="text" class="form-control" name="name" id="name">
		</div>
		<div class="form-group">
			<label>Cols</label>
			<input type="text" class="form-control" name="cols" id="cols">
		</div>
		<div class="form-group">
			<label>Rows</label>
			<input type="text" class="form-control" name="rows" id="rows">
		</div>

		<input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
	</form>

@endsection

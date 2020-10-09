@extends('template.template')

@section('content')

	<h1>Create a organization</h1>

	@foreach ($errors->all() as $error)
		{{ $error }}
	@endforeach

	<form method="post" action="/manage/organizations/">
		@csrf
		<div class="form-group">
			<label>Name</label>
			<input type="text" class="form-control" name="name" id="name">
		</div>

		<input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
	</form>

@endsection

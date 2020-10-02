@extends('template.template')

@section('content')

	<h1>Edit {{ $user->name }}</h1>

	@foreach ($errors->all() as $error)
		{{ $error }}
	@endforeach

	<form method="post" action="/manage/users/managers/{{ $user->id }}/">
		@method('PUT')
		@csrf
		<div class="form-group">
			<label>Name</label>
			<input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
		</div>

		<input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
	</form>

@endsection

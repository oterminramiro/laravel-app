@extends('template.template')

@section('content')

	<h1>Showing {{ $user->name }}</h1>

	<div class="jumbotron text-center">
		<h2>{{ $user->name }}</h2>
		<p>
			<strong>Guid:</strong> {{ $user->guid }}<br>
			<strong>Created:</strong> {{ $user->created_at }}
		</p>
	</div>

@endsection

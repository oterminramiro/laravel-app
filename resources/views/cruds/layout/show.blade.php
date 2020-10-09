@extends('template.template')

@section('content')

	<h1>Showing {{ $layout->name }}</h1>

	<div class="jumbotron text-center">
		<p>
			<strong>Organization: </strong>{{ $layout->Organization->name }}<br>
			<strong>Location: </strong>{{ $layout->Location->name }}<br>
			<strong>Name: </strong>{{ $layout->name }}<br>
			<strong>Col: </strong>{{ $layout->col }}<br>
			<strong>Row: </strong>{{ $layout->row }}<br>
			<strong>Available: </strong>{{ $layout->available }}<br>
			<strong>Created:</strong> {{ $layout->created_at }}<br>
		</p>
	</div>

@endsection

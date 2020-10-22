@extends('template.template')

@section('content')

	<h1>Showing {{ $location->name }}</h1>

	<div class="jumbotron text-center">
		<h2>{{ $location->name }}</h2>
		<p>
			<strong>Guid:</strong> {{ $location->guid }}<br>
			<strong>Cols:</strong> {{ $location->cols }}<br>
			<strong>Rows:</strong> {{ $location->rows }}<br>
			<strong>Since:</strong> {{ $location->since }}<br>
			<strong>Until:</strong> {{ $location->until }}<br>
			<strong>Created:</strong> {{ $location->created_at }}
		</p>
	</div>

@endsection

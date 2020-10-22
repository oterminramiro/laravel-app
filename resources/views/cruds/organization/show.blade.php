@extends('template.template')

@section('content')

	<h1>Showing {{ $organization->name }}</h1>

	<div class="jumbotron text-center">
		<h2>{{ $organization->name }}</h2>
		<p>
			<strong>Guid:</strong> {{ $organization->guid }}<br>
			<strong>Created:</strong> {{ $organization->created_at }}
		</p>
	</div>

@endsection

@section('js')
<!-- Vue js -->
<script src="{{ asset('js/app.js') }}"></script>
@endsection

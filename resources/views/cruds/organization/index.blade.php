@extends('template.template')

@section('content')

<a href="{{ URL::to('manage/organizations/create') }}">Create Organization</a>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<crud-component :organization="{{ $organization }}" csrf="{{csrf_token()}}"></crud-component>

@endsection

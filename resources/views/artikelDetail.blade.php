@extends('layouts.app')

@section('title')
    Artikerl
@endsection

@include('layouts.navbarUser')

@section('content')
	
	<div class="container">

		<h3>{{ $tesslug->title }}</h3>

		<a href="/tesslug" class="btn btn-primary">Back to Testing</a>
	
	</div>

@endsection
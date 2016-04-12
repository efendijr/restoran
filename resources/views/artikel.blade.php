@extends('layouts.app')

@section('title')
    Artikerl
@endsection

@include('layouts.navbarUser')


@section('content')
	
	<div class="container">
		<h1>Artiker Terakhir</h1>

		<ul class="list-group">
			@foreach($tesslug as $tes)

				<li class="list-group-item"><strong>{{ $tes->title}}</strong><br> {{ str_limit($tes->description, 25)}}<a href="{{ route('tesslug.detail', $tes->slug)}}">More</a></li>
			@endforeach
		</ul>

		<a href="/tesslug/create" class="btn btn-primary">Create Slug</a>

	</div>

@endsection
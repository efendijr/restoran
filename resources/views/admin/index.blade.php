@extends('layouts.app')

@section('title')
	Admin Page
@endsection

@include('layouts.navbarAdmin')

@section('content')

	<div class="container">
		
		<h2>Welcome To Admin Page, {{ auth('admin')->user()->nameAdmin }}</h2>

	</div>
	
@endsection
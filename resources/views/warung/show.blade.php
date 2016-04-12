@extends('layouts.app')

@section('title')
    {{ $user->name }} Page
@endsection

@include('layouts.navbarAdmin')

@section('content')
<div class="container">
	<div class="clearfix">
		<div class="pull-left">
			<div class="lead">{{ $user->name }}</div>
		</div>
		<div class="pull-right">
			<a href="{{ route('warung.edit', $user->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Add New Content"><i class="fa fa-pencil-square-o"></i>Edit</a>
			<a href="{{ route('warung')}}" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Add New Content"><i class="fa fa-btn fa-sign-out"></i>Back to List</a>
		</div>
	</div>

	<hr>

	<div class="panel panel-default">
  	<!-- Default panel contents -->
	  <div class="panel-heading">Panel heading</div>
	  <div class="panel-body">
	  	
		
		<div class="row">
		  <div class="col-md-4">
		    <div class="thumbnail">
		      <img src="{{ $user->image }}" alt="Image">
		      
		    </div>
		  </div>

		  <div class="col-md-8">
		    <h1>{{ $user->name }}</h1><br>
			<h4>{{ $user->deposite }}</h4>
		    <h5>{{ $user->description }}</h5>
		    <h5>
		    	<time class="timeago" datatime="{{ $user->updated_at->toIso8601String() }}" 
		    	title="{{ $user->updated_at->toDayDateTimeString() }}">
		    	{{ $user->updated_at->diffForHumans() }}	
		    	</time>
		    </h5>
		  </div>
	

		</div>

	  </div>
	</div>



	 
</div>

@endsection
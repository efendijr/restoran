@extends('layouts.app')

@section('title')
    {{ $member->nameMember }} Page
@endsection

@include('layouts.navbarAdmin')

@section('content')
<div class="container">
	<div class="clearfix">
		<div class="pull-left">
			<div class="lead">{{ $member->nameMember }}</div>
		</div>
		<div class="pull-right">
			<a href="{{ route('member.edit', $member->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Add New Content"><i class="fa fa-pencil-square-o"></i>Edit</a>
			<a href="{{ route('member')}}" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Add New Content"><i class="fa fa-btn fa-sign-out"></i>Back to List</a>
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
		      <img src="{{ $member->imageMember }}" alt="Image">
		      
		    </div>
		  </div>

		  <div class="col-md-8">
		    <h1>{{ $member->nameMember }}</h1><br>
			<h4>{{ $member->depositeMember }}</h4>
		    <h5>{{ $member->descriptionMakanan }}</h5>
		    <h5>
		    	<time class="timeago" datatime="{{ $member->updated_at->toIso8601String() }}" 
		    	title="{{ $member->updated_at->toDayDateTimeString() }}">
		    	{{ $member->updated_at->diffForHumans() }}	
		    	</time>
		    </h5>
		  </div>
	

		</div>

	  </div>
	</div>



	 
</div>

@endsection
@extends('layouts.app')

@section('title')
    Sell Deposite Page
@endsection

@include('layouts.navbarAdmin')

@section('content')
<div class="container">
	<div class="clearfix">
		<div class="pull-left">
			<div class="lead">Sell Deposite Page</div>
		</div>
		<div class="pull-right">
			<a href="{{ route('selldeposite.edit', $selldeposite->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Add New Content"><i class="fa fa-pencil-square-o"></i>Edit</a>
			<a href="{{ route('selldeposite')}}" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Add New Content"><i class="fa fa-btn fa-sign-out"></i>Back to List</a>
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
		      <img src="#" alt="Image">
		      
		    </div>
		  </div>

		  <div class="col-md-8">
		    <h1>Rp. {{ $selldeposite->nominal }}</h1><br>
			<h4>{{ $selldeposite->member_id }}</h4>
		    <h5>{{ $selldeposite->token }}</h5>
		    <h5>
		    	<time class="timeago" datatime="{{ $selldeposite->updated_at->toIso8601String() }}" 
		    	title="{{ $selldeposite->updated_at->toDayDateTimeString() }}">
		    	{{ $selldeposite->updated_at->diffForHumans() }}	
		    	</time>
		    </h5>
		  </div>
	

		</div>

	  </div>
	</div>



	 
</div>

@endsection
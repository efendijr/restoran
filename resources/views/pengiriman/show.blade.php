@extends('layouts.app')

@section('title')
    Detail Pengiriman Page
@endsection

@include('layouts.navbarAdmin')

@section('content')
<div class="container">
	<div class="clearfix">
		<div class="pull-left">
			<div class="lead">Detail Pengiriman Page</div>
		</div>
		<div class="pull-right">
			<a href="{{ route('pengiriman.edit', $pengiriman->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Add New Content"><i class="fa fa-pencil-square-o"></i>Edit</a>
			<a href="{{ route('pengiriman')}}" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Add New Content"><i class="fa fa-btn fa-sign-out"></i>Back to List</a>
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
		    <h1>{{ $pengiriman->usernameMember }}</h1><br>
			<h5>Payment Id : {{ $pengiriman->payment_id }}</h5>
			<h5>{{ $pengiriman->status }}</h5>
		    <h5>Alamat Pengiriman : {{ $pengiriman->alamat }}</h5>
		    <h5>
		    	<time class="timeago" datatime="{{ $pengiriman->updated_at->toIso8601String() }}" 
		    	title="{{ $pengiriman->updated_at->toDayDateTimeString() }}">
		    	{{ $pengiriman->updated_at->diffForHumans() }}	
		    	</time>
		    </h5>
		  </div>
	

		</div>

	  </div>
	</div>



	 
</div>

@endsection
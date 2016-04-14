@extends('layouts.app')

@section('title')
    Payment Detail Page
@endsection

@include('layouts.navbarAdmin')

@section('content')
<div class="container">
	<div class="clearfix">
		<div class="pull-left">
			<div class="lead">Payment Detail Page</div>
		</div>
		<div class="pull-right">
			<a href="{{ route('payment.edit', $payment->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Add New Content"><i class="fa fa-pencil-square-o"></i>Edit</a>
			<a href="{{ route('payment')}}" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Add New Content"><i class="fa fa-btn fa-sign-out"></i>Back to List</a>
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
		    <h1>{{ $payment->memberName }}</h1><br>
			<h4>{{ $payment->makanan_id }}</h4>
		    <h5>Rp. {{ $payment->total }}</h5>
		    <h5>
		    	<time class="timeago" datatime="{{ $payment->updated_at->toIso8601String() }}" 
		    	title="{{ $payment->updated_at->toDayDateTimeString() }}">
		    	{{ $payment->updated_at->diffForHumans() }}	
		    	</time>
		    </h5>
		  </div>
	

		</div>

	  </div>
	</div>



	 
</div>

@endsection
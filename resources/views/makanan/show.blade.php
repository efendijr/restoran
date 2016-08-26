@extends('layouts.app')

@section('title')
     {{ $makanan->nameMakanan }} Page
@endsection

@include('layouts.navbarUser')

@section('content')
<div class="container">
	<div class="clearfix">
		<div class="pull-left">
			<div class="lead">{{ $makanan->nameMakanan }}</div>
		</div>
		<div class="pull-right">
			<a href="{{ route('makanan.edit', $makanan->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Add New Content"><i class="fa fa-pencil-square-o"></i>Edit</a>
			<a href="{{ route('makanan.index')}}" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Add New Content"><i class="fa fa-btn fa-sign-out"></i>Back to List</a>
		</div>
	</div>

	<hr>

	<div class="panel panel-default">
  	<!-- Default panel contents -->
	  <div class="panel-heading">Detail Makanan</div>
	  <div class="panel-body">
	  	
		
		<div class="row">
		  <div class="col-md-4">
		    <div class="thumbnail">
		      <img src="/uploads/{{ $makanan->imageMakanan }}" class="img-rounded">
		      
		    </div>
		  </div>

		  <div class="col-md-8">

		  	@if ()
		  		 <h1>{{ $makanan->nameMakanan }}</h1><span class="badge">{{ $makanan->diskonMakanan }}%</span><br> 
				<s><h4>Rp. {{ $makanan->priceMakanan }}</h4></s>
				<h4>Rp. {{ $makanan->lastPriceMakanan }}</h4>
		  	
		    @else
		    <h1>{{ $makanan->nameMakanan }}</h1><br> 
			<h4>Rp. {{ $makanan->priceMakanan }}</h4>
			
			@endif

		    <h5>{{ $makanan->descriptionMakanan }}</h5>
		    <h5>
		    	<time class="timeago" datatime="{{ $makanan->updated_at->toIso8601String() }}" 
		    	title="{{ $makanan->updated_at->toDayDateTimeString() }}">
		    	{{ $makanan->updated_at->diffForHumans() }}	
		    	</time>
		    </h5>
		  </div>
	

		</div>

	  </div>
	</div>



	 
</div>

@endsection
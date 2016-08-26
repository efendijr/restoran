@extends('layouts.app')

@section('title')
     {{ $kecamatan->kecamatanName }} Page
@endsection

@include('layouts.navbarUser')

@section('content')
<div class="container">
	<div class="clearfix">
		<div class="pull-left">
			<div class="lead">{{ $kecamatan->kecamatanName }}</div>
		</div>
		<div class="pull-right">
			<a href="{{ route('kecamatan.edit', $kecamatan->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Add New Content"><i class="fa fa-pencil-square-o"></i>Edit</a>
			<a href="{{ route('kecamatan.index')}}" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Add New Content"><i class="fa fa-btn fa-sign-out"></i>Back to List</a>
		</div>
	</div>

	<hr>

	<div class="panel panel-default">
  	<!-- Default panel contents -->
	  <div class="panel-heading">Detail kecamatan</div>
	  <div class="panel-body">
	  	
		
		<div class="row">
		  <div class="col-md-4">
		    <div class="thumbnail">
		      <img src="/uploads/{{ $kecamatan->imagekecamatan }}" class="img-rounded">
		      
		    </div>
		  </div>

		  <div class="col-md-8">
		    <h1>{{ $kecamatan->namekecamatan }}</h1><br>
			<h4>{{ $kecamatan->pricekecamatan }}</h4>
		    <h5>{{ $kecamatan->descriptionkecamatan }}</h5>
		    <h5>
		    	<time class="timeago" datatime="{{ $kecamatan->updated_at->toIso8601String() }}" 
		    	title="{{ $kecamatan->updated_at->toDayDateTimeString() }}">
		    	{{ $kecamatan->updated_at->diffForHumans() }}	
		    	</time>
		    </h5>
		  </div>
	

		</div>

	  </div>
	</div>



	 
</div>

@endsection
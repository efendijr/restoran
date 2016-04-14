@extends('layouts.app')

@section('title')
    Makanan Page
@endsection

@include('layouts.navbarUser')

@section('content')
<div class="container">

	@if(Session::has('flash_success'))
		<div class="alert alert-success alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  {{ Session::get('flash_success') }}
		</div>

	@elseif(Session::has('flash_update'))
		<div class="alert alert-info alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  {{ Session::get('flash_update') }}
		</div>
	
	@elseif(Session::has('flash_delete'))
		<div class="alert alert-danger alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  {{ Session::get('flash_delete') }}
		</div>

	@endif
	
	<div class="clearfix">
        <div class="pull-left">
            <div class="lead">Daftar Makanan</div>
        </div>
        <div class="pull-right">
            <a href="{{ route('makan.buat')}}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Add New Content"><i class="fa fa-plus"></i> Tambah</a>
        </div>
    </div>

	<form method="GET" action="{{ route('makan')}}" enctype="multipart/form-data">
    <div class="clearfix">	  
	  <div class="col-lg-6 col-md-offset-3">
	    <div class="input-group">
	      <input type="text" class="form-control" name="keyword" placeholder="Search for...">
	      <span class="input-group-btn">
	        <button class="btn btn-default" type="submit">Search</button>
	      </span>
	    </div>
	  </div>
    </div>
    </form>

    <hr>

	<!-- content page -->
	 
	<ul class="list-group">
	@foreach($makanan as $makan)
	  <li class="list-group-item">
	  	<span class="badge">
	  		<time class="timeago" datatime="{{ $makan->updated_at->toIso8601String() }}" 
		    	title="{{ $makan->updated_at->toDayDateTimeString() }}">
		    	{{ $makan->updated_at->diffForHumans() }}	
		    </time>
	  	</span>
	  	<div class="row">
		<div class="col-md-3">
			<a href="" class="thumbnail">
				<img src="uploads/kids.jpg" alt="">
			</a>
		</div>

		<div class="col-md-7">
			<h3><strong>{{ strtoupper($makan->nameMakanan) }}</strong></h3>
			<h4>{{ $makan->price }}</h4>
			<h5>{{ str_limit($makan->descriptionMakanan, 10) }} <a href="{{ route('makan.detail', $makan->id)}}">More</a> </h5>

		</div>

		</div>


	  </li>
		   
	
	@endforeach
	</ul>

	<!-- end content page -->
	
	<div class="text-center">
	  	{!! $makanan->appends(request()->except('makan'))->links() !!}
	  </div>

</div>

@endsection
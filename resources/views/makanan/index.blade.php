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
            <a href="{{ route('makan.buat')}}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Add New Content"><i class="fa fa-plus-circle" aria-hidden="true"></i>Tambah</a>
        </div>
    </div>

	<form method="GET" action="{{ route('makan')}}" enctype="multipart/form-data">
    <div class="clearfix">	  
	  <div class="col-lg-6 col-md-offset-3">
	    <div class="input-group">
	      <input type="text" class="form-control" name="keyword" placeholder="Search for...">
	      <span class="input-group-btn">
	        <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i>Search</button>
	      </span>
	    </div>
	  </div>
    </div>
    </form>

    <hr>

	<!-- content page -->
	  <style>
		th, td {
			text-align: center ;
		}
	  </style>

	  <table class="table table-striped table-bordered table-hover">
	  	<thead>
	  	<tr>
	  		<th class="col-md-1">Id</th>
	  		<th class="col-md-3">Name</th>
	  		<th class="col-md-2">Price</th>
	  		<th class="col-md-3">Last Modified</th>
	  		<th class="col-md-3">Action</th>
	  	</tr>
	  	</thead>

	  	<tbody>
	  	@foreach($makans as $makan)
	  	<tr>
	  		<td class="col-md-1">{{ $makan->id }}</td>
	  		<td class="col-md-3">{{ $makan->nameMakanan }}</td>
	  		<td class="col-md-2">{{ $makan->priceMakanan }}</td>
	  		<td class="col-md-3">
	  			<time class="timeago" datatime="{{ $makan->updated_at->toIso8601String() }}" 
		    	title="{{ $makan->updated_at->toDayDateTimeString() }}">
		    	{{ $makan->updated_at->diffForHumans() }}	
		    	</time>	

	  		</td>
	  		<td class="col-md-3">
	  			<a href="{{ route('makan.detail', $makan->slugMakanan)}}" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="View Content"><i class="fa fa-caret-square-o-right"></i> View</a>
	  			<a href="{{ route('makan.edit', $makan->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Edit Content"><i class="fa fa-pencil-square-o"></i> Edit</a>
	  			
	  			<a href="{{ route('makan.delete', $makan->id)}}" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete Content" onclick="return confirm('Are you sure to delete this food?');" ><i class="fa fa-trash-o"></i> Delete</a>
	  		</td>
	  	</tr>
	  	@endforeach
	  	</tbody>

	  </table>
	
	<!-- end content page -->
	

	<div class="text-center">
	  	{!! $makans->appends(request()->except('makan'))->links() !!}
	  </div>

</div>

@endsection
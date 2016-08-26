@extends('layouts.app')

@section('title')
    Tarif Page
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
            <div class="lead">Daftar Daerah</div>
        </div>
        <div class="pull-right">
            <a href="{{ route('kecamatan.create')}}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Add New Content"><i class="fa fa-plus-circle" aria-hidden="true"></i>Tambah</a>
        </div>
    </div>

	<form method="GET" action="{{ route('kecamatan.index')}}" enctype="multipart/form-data">
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
	  		<th class="col-md-2">Name</th>
	  		<th class="col-md-2">Tarif</th>
	  		<th class="col-md-2">Last Modified</th>
	  		<th class="col-md-3">Action</th>
	  	</tr>
	  	</thead>

	  	<tbody>
	  	@foreach($kecamatans as $kecamatan)
	  	<tr>
	  		<td class="col-md-1">{{ $kecamatan->id }}</td>
	  		<td class="col-md-2">{{ $kecamatan->kecamatanName }}</td>
	  		<td class="col-md-2">{{ $kecamatan->kecamatanTarif }}</td>
	  		<td class="col-md-2">
	  			<time class="timeago" datatime="{{ $kecamatan->updated_at->toIso8601String() }}" 
		    	title="{{ $kecamatan->updated_at->toDayDateTimeString() }}">
		    	{{ $kecamatan->updated_at->diffForHumans() }}	
		    	</time>	

	  		</td>
	  		<td class="col-md-3">
	  			<a href="{{ route('kecamatan.edit', $kecamatan->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Edit Content"><i class="fa fa-pencil-square-o"></i> Edit</a>
	  			
	  			<a href="{{ route('kecamatan.delete', $kecamatan->id)}}" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete Content" onclick="return confirm('Are you sure to delete this food?');" ><i class="fa fa-trash-o"></i> Delete</a>
	  		</td>
	  	</tr>
	  	@endforeach
	  	</tbody>

	  </table>
	
	<!-- end content page -->
	

	<div class="text-center">
	  	{!! $kecamatans->appends(request()->except('kecamatan'))->links() !!}
	  </div>

</div>

@endsection
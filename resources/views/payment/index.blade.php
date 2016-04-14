@extends('layouts.app')

@section('title')
    Payment Page
@endsection

@include('layouts.navbarAdmin')

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

	 @elseif(Session::has('flash_exist_data'))
        <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{ Session::get('flash_exist_data') }}
        </div>
	
	@elseif(Session::has('flash_delete'))
		<div class="alert alert-danger alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  {{ Session::get('flash_delete') }}
		</div>

	@endif
	
	<div class="clearfix">
        <div class="pull-left">
            <div class="lead">Daftar Payment</div>
        </div>
    </div>

	<form method="GET" action="{{ route('payment')}}" enctype="multipart/form-data">
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
	  		<th class="col-md-1">Makanan_id</th>
	  		<th class="col-md-2">memberName</th>
			<th class="col-md-2">total</th>
	  		<th class="col-md-2">Last Modified</th>
	  		<th class="col-md-3">Action</th>
	  	</tr>
	  	</thead>

	  	<tbody>
	  	@foreach($payments as $payment)
	  	<tr>
	  		<td class="col-md-1">{{ $payment->id }}</td>
	  		<td class="col-md-1">{{ $payment->makanan_id }}</td>
	  		<td class="col-md-3">{{ $payment->memberName }}</td>
	  		<td class="col-md-2">{{ $payment->total }}</td>
	  		<td class="col-md-2">
	  			<time class="timeago" datatime="{{ $payment->updated_at->toIso8601String() }}" 
		    	title="{{ $payment->updated_at->toDayDateTimeString() }}">
		    	{{ $payment->updated_at->diffForHumans() }}	
		    	</time>	

	  		</td>
	  		<td class="col-md-3">
	  			<a href="{{ route('payment.detail', $payment->id)}}" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="View Content"><i class="fa fa-caret-square-o-right"></i> View</a>
	  			<!-- <a href="{{ route('payment.edit', $payment->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Edit Content"><i class="fa fa-pencil-square-o"></i> Edit</a> -->
	  			
	  			<a href="{{ route('payment.delete', $payment->id)}}" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete Content" onclick="return confirm('Are you sure to delete this food?');" ><i class="fa fa-trash-o"></i> Delete</a>
	  		</td>
	  	</tr>
	  	@endforeach
	  	</tbody>

	  </table>
	
	<!-- end content page -->
	

	<div class="text-center">
	  	{!! $payments->appends(request()->except('payment'))->links() !!}
	  </div>

</div>

@endsection
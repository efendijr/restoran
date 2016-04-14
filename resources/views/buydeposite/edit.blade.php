@extends('layouts.app')

@section('title')
    Edit Token Deposite
@endsection

@include('layouts.navbarAdmin')

@section('content')
<div class="container">

    @if(Session::has('flash_exist_data'))
        <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{ Session::get('flash_exist_data') }}
        </div>
    @endif

    <div class="clearfix">
        <div class=k"pull-left">
            <div class="lead">Update deposite</div>
        </div>
        <div class="pull-right">
            <a href="{{ route('buydeposite')}}" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Add New Content"><i class="fa fa-btn fa-sign-out"></i>Back to List</a>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Update Deposite</div>
                
                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="{{ route('buydeposite.update', $buydeposite->id)}}" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        
                    	{!! method_field('PUT') !!}
                        @include('buydeposite.form')

                    </form>
                
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

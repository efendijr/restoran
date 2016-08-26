@extends('layouts.app')

@section('title')
    Tambah Makanan
@endsection

@include('layouts.navbarUser')

@section('content')
<div class="container">

    @if(Session::has('flash_exist_data'))

        <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{ Session::get('flash_exist_data') }}
        </div>

    @endif

    <div class="clearfix">
        <div class="pull-left">
            <div class="lead">Buat Makanan</div>
        </div>
        <div class="pull-right">
            <a href="{{ route('makanan.index')}}" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Add New Content"><i class="fa fa-btn fa-sign-out"></i>Back to List</a>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Buat Makanan baru</div>
                
                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="{{ route('makanan.store')}}" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        @include('makanan.form')

                    </form>
                
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

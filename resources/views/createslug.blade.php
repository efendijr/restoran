@extends('layouts.app')

@section('title')
    Artikerl
@endsection

@include('layouts.navbarUser')

@section('content')

	<div class="container">
		
		<h1>Tes Slug</h1>

		<div class="clearfix">
			<div class="pull-right">
				<a href="/tesslug" class="btn btn-default">List Slug</a>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-10 col-md-default">
				<div class="panel panel-default">
					<div class="panel-heading">Buat Slug Baru</div>

					<div class="panel-body">
						<form method="POST" action="/tesslug/store" class="form-horizontal">
							{!! csrf_field() !!}

							@include('form')

						</form>

					</div>
				</div>
			</div>

		</div>

	</div>

@endsection
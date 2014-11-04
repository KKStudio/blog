@extends('admin.template')

@section('content')

	<h3 class="pull-left">Edycja kategorii</h3>

	<div class=""> 

		{!! Form::open([ 'url' => 'admin/blog/categories/' . $category->slug . '/edit']) !!}

			{!! Form::submit('Zapisz zmiany', [ 'class' => 'btn btn-lg btn-primary pull-right']) !!}

			<div class="clearfix"></div>

			<h3>{!! Form::label('name', 'Nazwa wyświetlana') !!}</h3>
			{!! Form::text('name', $category->name, [ 'class' => 'form-control' ]) !!}

		{!! Form::close() !!}

	</div>

@stop
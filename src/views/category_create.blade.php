@extends('admin.template')

@section('content')

	<h3 class="pull-left">Dodawanie kategorii</h3>

	<div class=""> 

		{!! Form::open([ 'url' => 'admin/blog/categories/create']) !!}

			{!! Form::submit('Stwórz kategorię', [ 'class' => 'btn btn-lg btn-primary pull-right']) !!}

			<div class="clearfix"></div>

			<h3>{!! Form::label('name', 'Nazwa wyświetlana') !!}</h3>
			{!! Form::text('name', '', [ 'class' => 'form-control' ]) !!}

		{!! Form::close() !!}

	</div>

@stop
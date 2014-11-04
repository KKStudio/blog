@extends('admin.template')

@section('content')

	<h3 class="pull-left">Usuń kategorię</h3>

	<div class=""> 

		{!! Form::open([ 'url' => 'admin/blog/categories/' . $category->slug . '/delete']) !!}

			{!! Form::submit('Potwierdź usunięcie', [ 'class' => 'btn btn-lg btn-danger pull-right']) !!}

			<div class="clearfix"></div>

			<p>Potwierdź usunięcie kategorii na blogu <b>{{ $category->name }}</b> klikając przycisk powyżej.</p>

		{!! Form::close() !!}

	</div>

@stop
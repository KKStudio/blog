@extends('admin.template')

@section('content')

	<h3 class="pull-left">Usuń post</h3>

	<div class=""> 

		{!! Form::open([ 'url' => 'admin/blog/' . $post->slug . '/delete']) !!}

			{!! Form::submit('Potwierdź usunięcie', [ 'class' => 'btn btn-lg btn-danger pull-right']) !!}

			<div class="clearfix"></div>

			<p>Potwierdź usunięcie posta <b>{{ $post->name }}</b> klikając przycisk powyżej.</p>

		{!! Form::close() !!}

	</div>

@stop
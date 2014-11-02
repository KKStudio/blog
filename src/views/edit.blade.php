@extends('admin.template')

@section('content')

	<h3 class="pull-left">Edycja posta</h3>

	<div class=""> 

		{!! Form::open([ 'url' => 'admin/blog/' . $post->slug . '/edit', 'files' => 'true']) !!}

			{!! Form::submit('Zapisz zmiany', [ 'class' => 'btn btn-lg btn-primary pull-right']) !!}

			<div class="clearfix"></div>

			<div class="fileinput fileinput-new" data-provides="fileinput">
			  <div class="fileinput-new thumbnail" style="width: 150px; height: auto;">
			  	<img src="{{ $post->getThumb() }}">
			  </div>
			  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px; height: auto;"></div>
			  <div>
			    <span class="btn btn-default btn-file">
				    <span class="fileinput-new">Wybierz zdjęcie</span>
				    <span class="fileinput-exists">Zmień</span>		    
				    {!! Form::file('image', [ 'class' => 'form-control' ]) !!}
				    </span>
			    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Usuń</a>
			  </div>
			</div>

			<h3>{!! Form::label('title', 'Tytuł') !!}</h3>
			{!! Form::text('title', $post->title, [ 'class' => 'form-control' ]) !!}

			<h3>{!! Form::label('content', 'Treść') !!}</h3>
			{!! Form::textarea('content', $post->content, [ 'class' => 'editor form-control', 'rows' => 10 ]) !!}


			<h3>{!! Form::label('tags', 'Słowa kluczowe') !!}</h3>
			{!! Form::textarea('tags', $post->tags, [ 'class' => 'form-control', 'rows' => 2 ]) !!}

		{!! Form::close() !!}

	</div>

@stop
@extends('admin.template')

@section('content')

	<h3 class="pull-left">Stwórz nowy post</h3>

	<div class=""> 

		{!! Form::open([ 'url' => 'admin/blog/create', 'files' => 'true']) !!}

			{!! Form::submit('Dodaj', [ 'class' => 'btn btn-lg btn-primary pull-right']) !!}

			<div class="clearfix"></div>

			<div class="fileinput fileinput-new" data-provides="fileinput">
			  <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
			  </div>
			  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
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
			{!! Form::text('title', '', [ 'class' => 'form-control' ]) !!}

			<h3>{!! Form::label('category_id', 'Kategoria') !!}</h3>
			{!! Form::select('category_id', m('Blog')->categoriesArray(), '', [ 'class' => 'form-control' ]) !!}

			<h3>{!! Form::label('content', 'Treść') !!}</h3>
			{!! Form::textarea('content', '', [ 'class' => 'editor form-control', 'rows' => 10 ]) !!}

			<h3>{!! Form::label('tags', 'Słowa kluczowe') !!}</h3>
			{!! Form::textarea('tags', '', [ 'class' => 'form-control', 'rows' => 2 ]) !!}

		{!! Form::close() !!}

	</div>

@stop
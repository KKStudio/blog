@extends('admin.template')

@section('content')

	<h3 class="pull-left">Edit post</h3>

	<div class=""> 

		{!! Form::open([ 'url' => 'admin/blog/' . $post->slug . '/edit', 'files' => 'true']) !!}

			{!! Form::submit('Edit post', [ 'class' => 'btn btn-lg btn-primary pull-right']) !!}

			<div class="clearfix"></div>

			<div class="fileinput fileinput-new" data-provides="fileinput">
			  <div class="fileinput-new thumbnail" style="width: 150px; height: auto;">
			  	<img src="{{ $post->getThumb() }}">
			  </div>
			  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100%; height: auto;"></div>
			  <div>
			    <span class="btn btn-default btn-file">
				    <span class="fileinput-new">Select image</span>
				    <span class="fileinput-exists">Change</span>		    
				    {!! Form::file('image', [ 'class' => 'form-control' ]) !!}
				    </span>
			    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
			  </div>
			</div>

			<h3>{!! Form::label('title', 'Title') !!}</h3>
			{!! Form::text('title', $post->title, [ 'class' => 'form-control' ]) !!}

			<h3>{!! Form::label('content', 'Content') !!}</h3>
			{!! Form::textarea('content', $post->content, [ 'class' => 'form-control', 'rows' => 10 ]) !!}
			{!! Form::text('title', $post->title, [ 'class' => 'form-control' ]) !!}

			<h3>{!! Form::label('tags', 'Tags') !!}</h3>
			{!! Form::textarea('tags', $post->tags, [ 'class' => 'form-control', 'rows' => 2 ]) !!}

		{!! Form::close() !!}

	</div>

@stop
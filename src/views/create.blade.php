@extends('admin.template')

@section('content')

	<h3 class="pull-left">Add new post</h3>

	<div class=""> 

		{!! Form::open([ 'url' => 'admin/blog/create', 'files' => 'true']) !!}

			{!! Form::submit('Post', [ 'class' => 'btn btn-lg btn-primary pull-right']) !!}

			<div class="clearfix"></div>

			<div class="fileinput fileinput-new" data-provides="fileinput">
			  <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
			  </div>
			  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
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
			{!! Form::text('title', '', [ 'class' => 'form-control' ]) !!}

			<h3>{!! Form::label('content', 'Content') !!}</h3>
			{!! Form::textarea('content', '', [ 'class' => 'editor form-control', 'rows' => 10 ]) !!}

			<h3>{!! Form::label('tags', 'Tags') !!}</h3>
			{!! Form::textarea('tags', '', [ 'class' => 'form-control', 'rows' => 2 ]) !!}

		{!! Form::close() !!}

	</div>

@stop
@extends('admin.template')

@section('content')

	<h3 class="pull-left">Delete post</h3>

	<div class=""> 

		{!! Form::open([ 'url' => 'admin/blog/' . $post->slug . '/delete']) !!}

			{!! Form::submit('Delete post', [ 'class' => 'btn btn-lg btn-danger pull-right']) !!}

			<div class="clearfix"></div>

			<p>Confirm deleting post <b>{{ $post->name }}</b> by clicking the button above.</p>

		{!! Form::close() !!}

	</div>

@stop
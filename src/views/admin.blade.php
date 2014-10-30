@extends('admin.template')

@section('content')

	<h3 class="pull-left">Blog posts</h3>

	<div class=""> 

		<a href="{{ url('admin/blog/settings') }}" class="btn btn-default btn-lg pull-right" style="margin-left: 10px;">
			<i class="glyphicon glyphicon-cog"></i>
		</a>

		<a href="{{ url('admin/blog/create') }}" style="margin-left: 10px;" class="btn btn-lg btn-success pull-right">
			Add new post
		</a>

		{!! Form::open([ 'url' => 'admin/menu/create']) !!}

			{!! Form::hidden('display_name', 'Blog') !!}
			{!! Form::hidden('route', 'blog') !!}
			{!! Form::hidden('params', json_encode([])) !!}

			{!! Form::submit('Add to menu', [ 'class' => 'pull-right btn btn-lg btn-warning']) !!}

		{!! Form::close() !!}

		<div class="clearfix"></div>
		@if(count($posts))

		<table class="table table-striped">
			<thead>
				<th>#</th>
				<th>Title</th>
				<th>Published</th>
				<th></th>
				<th></th>
			</thead>
			<tbody>
				@foreach($posts as $k => $post)
				<tr>
					<td>{{ $post->id }}</td>
					<td>{{ $post->title }}</td>
					<td>{{ $post->published }}</td>
					<td>
						<a href="{{ url('admin/blog/' . $post->slug . '/edit') }}" class="btn btn-sm btn-primary">edit</a>
					</td>
					<td>
						<a href="{{ url('admin/blog/' . $post->slug . '/delete') }}" class="btn btn-sm btn-danger">delete</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@else
			<p class="text-muted">No posts found.</p>
		@endif

	</div>

@stop
@extends('admin.template')

@section('content')

	<h3 class="pull-left">Posty na blogu</h3>

	<div class=""> 

		<a href="{{ url('admin/blog/settings') }}" class="btn btn-default btn-lg pull-right" style="margin-left: 10px;">
			<i class="glyphicon glyphicon-cog"></i>
		</a>

		<a href="{{ url('admin/blog/create') }}" style="margin-left: 10px;" class="btn btn-lg btn-success pull-right">
			Stwórz nowy post
		</a>

		{!! Form::open([ 'url' => 'admin/menu/create']) !!}

			{!! Form::hidden('display_name', 'Blog') !!}
			{!! Form::hidden('route', 'blog') !!}
			{!! Form::hidden('params', json_encode([])) !!}

			{!! Form::submit('Dodaj do menu', [ 'class' => 'pull-right btn btn-lg btn-warning']) !!}

		{!! Form::close() !!}

		<div class="clearfix"></div>
		@if(count($posts))

		<table class="table table-striped">
			<thead>
				<th>#</th>
				<th>Tytuł</th>
				<th>Opublikowano</th>
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
						<a href="{{ url('admin/blog/' . $post->slug . '/edit') }}" class="btn btn-sm btn-primary">edytuj</a>
					</td>
					<td>
						<a href="{{ url('admin/blog/' . $post->slug . '/delete') }}" class="btn btn-sm btn-danger">usuń</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		{!! $post->links() !!}
		@else
			<p class="text-muted">Brak dodanych postów.</p>
		@endif

	</div>

@stop
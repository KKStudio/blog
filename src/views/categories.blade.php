@extends('admin.template')

@section('content')

	<h3 class="pull-left">Kategorie wpisów na blogu</h3>

	<div class=""> 

		<a href="{{ url('admin/blog/categories/create') }}" style="margin-left: 10px;" class="btn btn-lg btn-success pull-right">
			Dodaj nową
		</a>

		<div class="clearfix"></div>
		@if(count($categories))

		<table class="table table-striped">
			<thead>
				<th>#</th>
				<th>Nazwa wyświetlana</th>
				<th>Slug</th>
				<th></th>
				<th></th>
				<th>wyżej</th>
				<th>niżej</th>
			</thead>
			<tbody>
				@foreach($categories as $k => $c)
				<tr>
					<td>{{ $c->id }}</td>
					<td>{{ $c->name }}</td>
					<td>{{ $c->slug }}</td>
					<td>
						<a href="{{ url('admin/blog/categories/' . $c->slug . '/edit') }}" class="btn btn-sm btn-primary">edytuj</a>
					</td>
					<td>
						<a href="{{ url('admin/blog/categories/' . $c->slug . '/delete') }}" class="btn btn-sm btn-danger">usuń</a>
					</td>
					<td>
						@if($k-1 >= 0)
						{!! Form::open(['url' => 'admin/blog/categories/swap']) !!}

							{!! Form::hidden('id1', $categories[$k-1]->id) !!}
							{!! Form::hidden('id2', $c->id) !!}

							{!! Form::submit('w górę', [ 'class' => 'btn-sm btn btn-success']) !!}

						{!! Form::close() !!}
						@endif
					</td>
					<td>
						@if($k+1 < count($categories))
						{!! Form::open(['url' => 'admin/blog/categories/swap']) !!}

							{!! Form::hidden('id1', $c->id) !!}
							{!! Form::hidden('id2', $categories[$k+1]->id) !!}

							{!! Form::submit('w dół', [ 'class' => 'btn-sm btn btn-success']) !!}

						{!! Form::close() !!}
						@endif

					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@else
			<p class="text-muted">Brak dodanych kategorii.</p>
		@endif

	</div>

@stop
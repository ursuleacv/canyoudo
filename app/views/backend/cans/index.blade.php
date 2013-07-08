@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Can Management ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		Can Management

		<div class="pull-right">
			<a href="{{ route('create/can') }}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i> Create</a>
		</div>
	</h3>
</div>

{{ $cans->links() }}

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th class="span6">@lang('admin/cans/table.title')</th>
			<th class="span2">@lang('admin/cans/table.comments')</th>
			<th class="span2">@lang('admin/cans/table.created_at')</th>
			<th class="span2">@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($cans as $can)
		<tr>
			<td>{{ $can->title }}</td>
			<td>{{ $can->comments()->count() }}</td>
			<td>{{ $can->created_at->diffForHumans() }}</td>
			<td>
				<a href="{{ route('update/can', $can->id) }}" class="btn btn-mini">@lang('button.edit')</a>
				<a href="{{ route('delete/can', $can->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

{{ $cans->links() }}
@stop

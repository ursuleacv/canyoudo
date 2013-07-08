@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Want Management ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		Want Management

		<div class="pull-right">
			<a href="{{ route('create/want') }}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i> Create</a>
		</div>
	</h3>
</div>

{{ $wants->links() }}

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th class="span6">@lang('admin/wants/table.title')</th>
			<th class="span2">@lang('admin/wants/table.comments')</th>
			<th class="span2">@lang('admin/wants/table.created_at')</th>
			<th class="span2">@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($wants as $want)
		<tr>
			<td>{{ $want->title }}</td>
			<td>{{ $want->comments()->count() }}</td>
			<td>{{ $want->created_at->diffForHumans() }}</td>
			<td>
				<a href="{{ route('update/want', $want->id) }}" class="btn btn-mini">@lang('button.edit')</a>
				<a href="{{ route('delete/want', $want->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

{{ $wants->links() }}
@stop

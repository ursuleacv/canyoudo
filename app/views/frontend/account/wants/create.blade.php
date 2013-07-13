@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Say what do you want ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		Say what do you want 

		<div class="pull-right">
			<a href="{{ route('account') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> Back</a>
		</div>
	</h3>
</div>

<form class="form-horizontal" method="post" action="" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- Tabs Content -->
	<div class="tab-content">
		<!-- General tab -->
		<div class="tab-pane active" id="tab-general">
			

			<!-- Content -->
			<div class="control-group {{ $errors->has('content') ? 'error' : '' }}">
				<label class="control-label" for="content"><strong> I want </strong></label>
				<div class="controls">
					<textarea class="span8" name="content" id="content" value="content" rows="10">{{ Input::old('content') }}</textarea>
					{{ $errors->first('content', '<span class="help-inline">:message</span>') }}					
					
				</div>

			</div>
		</div>

		
	</div>

	<!-- Form actions -->
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-success">Publish</button>
			&nbsp;&nbsp;&nbsp; and tell your friends <input type="checkbox" name="updstatus" value="updstatus" checked>
			
		</div>
	</div>
</form>
@stop

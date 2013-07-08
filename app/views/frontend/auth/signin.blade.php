@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Account Sign in ::
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="page-header">
	<div class="row">
		<div class="span5"><h3>Sign in into your account </h3> </div> <div class="span7"> <h3>OR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Use your existing account from </h3></div>
	</div>
</div>
<div class="row">
	<div class="span6">
	<form method="post" action="{{ route('signin') }}" class="form-horizontal">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />

		<!-- Email -->
		<div class="control-group{{ $errors->first('email', ' error') }}">
			<label class="control-label" for="email">Email</label>
			<div class="controls">
				<input type="email" name="email" id="email" value="{{ Input::old('email') }}" />
				{{ $errors->first('email', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<!-- Password -->
		<div class="control-group{{ $errors->first('password', ' error') }}">
			<label class="control-label" for="password">Password</label>
			<div class="controls">
				<input type="password" name="password" id="password" value="" />
				{{ $errors->first('password', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<!-- Remember me -->
		<div class="control-group">
			<div class="controls">
			<label class="checkbox">
				<input type="checkbox" name="remember-me" id="remember-me" value="1" /> Remember me
			</label>
			</div>
		</div>

		<hr>

		<!-- Form actions -->
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-primary">Sign in</button>

				<a href="{{ route('forgot-password') }}" class="btn btn-link">I forgot my password</a>
			</div>
		</div>
	</form>
</div>
	<div class="span6">
			<a href="{{ route('hybridauth','facebook') }}" class="zocial facebook">Sign in with Facebook</a><br /><br />
			<a href="{{ route('hybridauth','google') }}" class="zocial googleplus">Sign in with Google+</a><br /><br />
			<a href="{{ route('hybridauth','twitter') }}" class="zocial twitter">Sign in with Twitter &nbsp;</a><br /><br />
			<a href="{{ route('hybridauth','linkedin') }}" class="zocial linkedin">Sign in with LinkedIn</a><br />
	
	</div>	
</div>
@stop

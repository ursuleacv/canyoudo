@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Account Sign up ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<div class="row">
		<div class="span5"><h3>Sign up </h3> </div> <div class="span7"> <h3>OR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Use your existing account from </h3></div>
	</div>
	  
</div>
<div class="row">
	<div class="span6">
	<form method="post" action="{{ route('signup') }}" class="form-horizontal" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />

		<!-- First Name -->
		<div class="control-group{{ $errors->first('first_name', ' error') }}">
		<label class="control-label" for="first_name">First Name</label>
			<div class="controls">
				<input type="text" name="first_name" id="first_name" value="{{ Input::old('first_name') }}" />
				{{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<!-- Last Name -->
		<div class="control-group{{ $errors->first('last_name', ' error') }}">
			<label class="control-label" for="last_name">Last Name</label>
			<div class="controls">
				<input type="text" name="last_name" id="last_name" value="{{ Input::old('last_name') }}" />
				{{ $errors->first('last_name', '<span class="help-block">:message</span>') }}
			</div>
		</div>

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

		

		<hr>

		<!-- Form actions -->
		<div class="control-group">
			<div class="controls">
				
				<button type="submit" class="btn btn-primary">Sign up</button>
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

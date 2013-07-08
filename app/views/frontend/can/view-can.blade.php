@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
	{{ $can->author->first_name }} can {{ $can->title }} - Do You Want?
@stop

{{-- Update the Meta Author --}}
@section('author')
<meta name="author" content="{{ $can->author->fullName() }}" /> 
@stop
{{-- Update the Meta Description --}}
@section('meta_description')
@if ($can->meta_description )
<meta name="description" content="{{ $can->meta_description }}" />
@else
@parent
@endif
@stop

{{-- Update the Meta Keywords --}}
@section('meta_keywords')
@if ($can->meta_keywords )
<meta name="keywords" content="{{ $can->meta_keywords }}" />
@else
@parent
@endif
@stop

{{-- Page content --}}
@section('content')
<div class="row">
	<div class="span7">
		<h3>{{ $can->author->fullname() }} can </h3>

		<p>{{ $can->content() }}</p>
		<div>
			<span class="badge badge-info" title="{{ $can->created_at }}">Created {{ $can->created_at->diffForHumans() }}</span>
		</div>
			<!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_16x16_style pull-right">
			<a class="addthis_button_facebook"></a>
			<a class="addthis_button_twitter"></a>
			<a class="addthis_button_reddit"></a>
			<a class="addthis_button_google_plusone_share"></a>
			<a class="addthis_button_pinterest_share"></a>
			</div>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=undefined" async></script>
			<!-- AddThis Button END -->

	</div>
	<div class="span4">
		<div class="row">
			<div class="span1">
				<img class="thumbnail" src="{{ $can->author->gravatar() }}" alt="">
			</div>
			<div class="span3">
				<h4><a href="{{ URL::to('user', array($can->author->id)) }}">{{ $can->author->fullName() }} </a></h4>
				<div>
					@if ($can->author->profileURL == '')
					No public profile
					@else
					<a href="{{ $can->author->profileURL }}">{{ $can->author->profileURL }} </a>
					@endif
				</div>

				<p>Last visit: {{ $can->author->updated_at->diffForHumans() }}</p>
			</div>
		</div>	
	</div>
</div>

<hr />

<div class="row">
	<!-- People can-->
	<div class="span11">

	</div>

</div>

<hr />
<a id="comments"></a>
<h4>{{ $comments->count() }} Comments</h4>

@if ($comments->count())
@foreach ($comments as $comment)
<div class="row">
	<div class="span1">
		<img class="thumbnail" src="{{ $comment->author->gravatar() }}" alt="{{ $comment->author->fullName() }}">
	</div>
	<div class="span11">
		<div class="row">
			<div class="span11">
				<a href="{{ URL::to('user', array($comment->author->id)) }}"><span class="muted">{{ $comment->author->fullName() }}</span></a>
				&bull;
				<span title="{{ $comment->created_at }}">{{ $comment->created_at->diffForHumans() }}</span>

				<hr />

				{{ $comment->content() }}
			</div>
		</div>
	</div>

</div>
<hr />
@endforeach
@else
<hr />
@endif

@if ( ! Sentry::check())
You need to be logged in to add comments.<br /><br />
Click <a href="{{ route('signin') }}">here</a> to login into your account.
@else
<h4>Add a Comment</h4>
<form method="post" action="{{ route('view-can', $can->slug) }}">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- Comment -->
	<div class="control-group{{ $errors->first('comment', ' error') }}">
		<textarea class="input-block-level" rows="4" name="comment" id="comment">{{ Input::old('comment') }}</textarea>
		{{ $errors->first('comment', '<span class="help-inline">:message</span>') }}
	</div>

	<!-- Form actions -->
	<div class="control-group">
		<div class="controls">
			<input type="submit" class="btn" id="submit" value="Submit" />
		</div>
	</div>
</form>
@endif
@stop

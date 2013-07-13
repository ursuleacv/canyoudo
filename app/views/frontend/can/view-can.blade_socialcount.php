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
			<script src="{{ asset('assets/js/socialcount.min.js') }}" async></script>
				<!-- Replace YOUR_CUSTOM_URL with the URL you're sharing -->
				<ul class="socialcount socialcount-small pull-right" data-url="{{ $can->url() }}" data-facebook-action="recommend" data-share-text="I can {{ $can->title }}">
					<li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u={{ $can->url() }}" title="Share on Facebook"><span class="icon icon-facebook"></span><span class="count">Like</span></a></li>
					<li class="twitter"><a href="https://twitter.com/intent/tweet?text={{ $can->url() }}" title="Share on Twitter"><span class="icon icon-twitter"></span><span class="count">Tweet</span></a></li>
					<li class="googleplus"><a href="https://plus.google.com/share?url={{ $can->url() }}" title="Share on Google Plus"><span class="icon icon-googleplus"></span><span class="count">+1</span></a></li>
				</ul>
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

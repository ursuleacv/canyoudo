@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
	{{ $want->author->first_name }} wants {{ $want->title }} - Can You Do It?
@stop

{{-- Update the Meta Author --}}
@section('author')
<meta name="author" content="{{ $want->author->fullName() }}" /> 
@stop
{{-- Update the Meta Description --}}
@section('meta_description')
@if ($want->meta_description )
<meta name="description" content="{{ $want->meta_description }}" />
@else
@parent
@endif
@stop
{{-- Update the Meta Keywords --}}
@section('meta_keywords')
@if ($want->meta_keywords )
<meta name="keywords" content="{{ $want->meta_keywords }}" />
@else
@parent
@endif
@stop

{{-- Page content --}}
@section('content')
<div class="row">
	<div class="span7">
		<h3>{{ $want->author->fullname() }} wants</h3>

		<p>{{ $want->content() }}</p>
		<p><a href="{{ URL::to('account/wants/want', array($want->id)) }}"> I can </a></p>
		<div>
			<span class="badge badge-info" title="{{ $want->created_at }}">wanted {{ $want->created_at->diffForHumans() }}</span>
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
				<img class="thumbnail" src="{{ $want->author->gravatar() }}" alt="">
			</div>
			<div class="span3">
				<h4><a href="{{ URL::to('user', array($want->author->id)) }}">{{ $want->author->fullName() }} </a></h4>
				<div>
					@if ($want->author->profileURL == '')
					No public profile
					@else
					<a href="{{ $want->author->profileURL }}">{{ $want->author->profileURL }} </a>
					@endif
				</div>
				
				<p>Last visit: {{ $want->author->updated_at->diffForHumans() }}</p>
			</div>
		</div>	
	</div>
</div>

<hr />

<div class="row">
	<!-- People want-->
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
				<a href="{{ URL::to('user', array($comment->author->id)) }}"> <span class="muted">{{ $comment->author->fullName() }}</span></a>
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
<form method="post" action="{{ route('view-want', $want->slug) }}">
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

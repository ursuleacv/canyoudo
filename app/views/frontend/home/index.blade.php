@extends('frontend/layouts/default')

{{-- Page content --}}
@section('content')
<div class="hero-unit" style="padding: 32px 45px 25px;">
        <h1 style="font-size: 40px;margin-bottom: 10px;">Helping each other: <small> say What do you want or What you can do</small></h1>

		<p align="justify">
		Tell us about your wishes and find somebody who can realize them. Or tell us about your capabilities and help someone who wants what you can do! Accomplish the dreams and help others.
		<br>We have <span class="badge badge-info">{{ $totalcans }}  </span><span style="color:blue"> I can </span> posts <span class="badge badge-important">{{ $totalwants }}  </span> <span style="color:red"> I want </span> posts

		</p>
</div>
<div class="row-fluid">
        <div class="span6">
        	 <a href="{{route('allwant')}}" class="btn btn-danger btn-large btn-block" type="button">Folks Want</a>
			@foreach ($wants as $want)
				<h4><strong><a href="{{ $want->url() }}">{{$want->author->first_name}} wants {{ $want->title }}</a></strong></h4>
          		<!-- want Content -->
				<div class="row-fluid">
					<div class="span2">
						<a href="{{ $want->url() }}" class="thumbnail"><img src="{{ $want->author->gravatar() }}" alt=""></a>
					</div>
					
					<p>
						{{$want->author->first_name}} wants {{ Str::limit($want->content, 200) }}

					</p>
					<p><a class="btn btn-primary pull-right" href="{{ $want->url() }}">I Can </a></p>
				</div>
				
				<!-- want Footer -->
				<div class="row-fluid">
					
						
						<p>
							<i class="icon-user"></i> by <a href="{{ URL::to('user', array($want->author->id)) }}"><span class="muted">{{ $want->author->first_name }}</span></a>
							| <i class="icon-calendar"></i> {{ $want->created_at->diffForHumans() }}
							| <i class="icon-comment"></i> <a href="{{ $want->url() }}#comments">{{ $want->comments()->count() }} Comments</a>
						</p>
					
				</div>

				<hr>

			@endforeach
			{{ $wants->links() }}
        </div>

        <div class="span6">
        	<a href="{{ route('allcan') }}" class="btn btn-large btn-primary btn-block" type="button">Folks Can</a>
			@foreach ($cans as $can)
				<h4><strong><a href="{{ $can->url() }}">{{$can->author->first_name}} can {{ $can->title }}</a></strong></h4>
          		<!-- can Content -->
				<div class="row-fluid">
					<div class="span2">
						<a href="{{ $can->url() }}" class="thumbnail"><img src="{{ $can->author->gravatar() }}" alt=""></a>
					</div>
					
					<p>
						{{$can->author->first_name}} can {{ Str::limit($can->content, 200) }}
					</p>
					<p><a class="btn btn-danger pull-right" href="{{ $can->url() }}">I Want </a></p>
				</div>

				<!-- can Footer -->
				<div class="row-fluid">
						
						<p>
							<i class="icon-user"></i> by <a href="{{ URL::to('user', array($can->author->id)) }}"><span class="muted">{{ $can->author->first_name }}</span></a>
							| <i class="icon-calendar"></i> {{ $can->created_at->diffForHumans() }}
							| <i class="icon-comment"></i> <a href="{{ $can->url() }}#comments">{{ $can->comments()->count() }} Comments</a>
						</p>
					
				</div>
				<hr>
			@endforeach
			{{ $cans->links() }}
        </div>
</div>

@stop

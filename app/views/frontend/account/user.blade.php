@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
User information
@stop

{{-- Account page content --}}
@section('content')
<div class="page-header">
	<h4></h4>
</div>

<div class="row">
	<div class="span8">
		<div class="row">
			<div class="span4">
				<a href="{{route('allwant')}}" class="btn btn-danger btn-large btn-block"  type="button">{{$user->first_name}} wants</a>
				@foreach ($wants as $want)
				<h4><strong><a href="{{ $want->url() }}">{{$want->author->first_name}} wants {{ $want->title }}</a></strong></h4>
				<!-- want Content -->
				
				<p><a class="label label-info pull-right" href="{{ $want->url() }}">I Can Do it</a></p>
				
				
				<!-- want Footer -->
				<div class="row-fluid">
					

					<p>	
						<i class="icon-calendar"></i> {{ $want->created_at->diffForHumans() }}
						| <i class="icon-comment"></i> <a href="{{ $want->url() }}#comments">{{ $want->comments()->count() }} Comments</a>
					</p>
					
				</div>
				<hr>
				@endforeach
				{{ $wants->links() }}

			</div>
			<div class="span4">
				<a href="{{ route('allcan') }}" class="btn btn-large btn-primary btn-block" type="button">{{$user->first_name}} can</a>
				@foreach ($cans as $can)
				<h4><strong><a href="{{ $can->url() }}">{{$can->author->first_name}} can {{ $can->title }}</a></strong></h4>
				<!-- can Content -->
				<p><a class="label label-important pull-right" href="{{ $can->url() }}">I Want to Do it</a></p>
				<!-- can Footer -->
				<div class="row-fluid">

					<p>
						<i class="icon-calendar"></i> {{ $can->created_at->diffForHumans() }}
						| <i class="icon-comment"></i> <a href="{{ $can->url() }}#comments">{{ $can->comments()->count() }} Comments</a>
					</p>
					
				</div>
				<hr>
				@endforeach
				{{ $cans->links() }}
			</div>
		</div>
	</div>
	<div class="span4">
		<div class="well">
			<a href="{{ URL::to('user', array($user->id)) }}" ><img src="{{ $user->gravatar() }}" alt="" width="300"></a>
			
			<h4>{{ $user->fullName() }} </h4>
			<div><a href="{{ $user->profileURL }}">{{$user->profileURL }}</a></div>
			<p>Last visit: {{ $user->updated_at->diffForHumans() }}</p>
		</div>
	</div>
</div>

@stop

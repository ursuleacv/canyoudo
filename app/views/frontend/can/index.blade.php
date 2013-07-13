@extends('frontend/layouts/default')

{{-- Page content --}}
@section('content')

<div class="row-fluid">
        <div class="span8">
        	 <a href="#" class="btn btn-danger btn-large btn-block"  type="button">I Can</a>
        	 <p>&nbsp;</p>
			@foreach ($cans as $can)
				<h4><strong><a href="{{ $can->url() }}">{{$can->author->first_name}} cans {{ $can->title }}</a></strong></h4>

          		<!-- can Content -->
				<div class="row-fluid">
					<div class="span2">
						<a href="{{ $can->url() }}" class="thumbnail"><img src="{{ $can->author->gravatar() }}" alt=""></a>						
					</div>
					
					<p>
						{{$can->author->first_name}} cans {{ Str::limit($can->content, 200) }}

					</p>
					<a class="btn btn-primary pull-right" href="{{ $can->url() }}">I Want</a>
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

	 <div class="span4">
	 	Sidebar
	 </div>    
</div>

@stop

@extends('frontend/layouts/default')

{{-- Page content --}}
@section('content')

<div class="row-fluid">
        <div class="span8">
        	 <a href="#" class="btn btn-danger btn-large btn-block" style="float:right;" type="button">I Want</a>
        	 <p>&nbsp;</p>
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
					<a class="btn btn-primary pull-right" href="{{ $want->url() }}">I Can</a>
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

	 <div class="span4">
	 	Sidebar
	 </div>    
</div>

@stop

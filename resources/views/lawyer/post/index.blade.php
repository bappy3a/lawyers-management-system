@extends('layouts.app')

@section('heading','Find Job')
@section('content')
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
          	@foreach($posts as $post)
	            <li>
					<div class="timeline-item">
						<span class="time"><i class="fa fa-clock-o"></i> {{ $post->created_at->diffForHumans() }}</span>
						<h3 class="timeline-header"><a>{{ $post->title }}</a></h3>
						<div class="timeline-body">
						  {!! $post->description !!}
						</div>
						<div class="timeline-footer">
						  <a href="{{ route('lawyer.post.show',$post->id) }}" class="btn btn-primary btn-xs">Read more</a>
						</div>
					</div>
	            </li>
	        @endforeach
          </ul>
        </div>
        <!-- /.col -->
      </div>
@endsection

@extends('layouts.app')

@section('heading','Case Posting')
@section('content')
  <div class="row">
    <div class="col-xs-12">

<div class="box box-widget">
  <div class="box-header with-border">
    <div class="user-block">
      <img class="img-circle" src="{{ asset($post->user->image) }}" alt="User Image">
      <span class="username"><a href="#">{{ $post->user->name }}</a></span>
      <span class="description">Shared publicly - {{ $post->created_at->diffForHumans() }}</span>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <h4 class="attachment-heading">
      <a >{{ $post->title }}</a></h4>
      {!! $post->description !!}
  </div>

  <div class="box-footer">
    <form action="{{ route('help.post.comment') }}" method="post">
      @csrf
      <input type="hidden" name="help_post_id" value="{{ $post->id }}">
      <img class="img-responsive img-circle img-sm" src="{{ asset(auth()->user()->image) }}" alt="User Image">
      <div class="img-push">
        <input required name="comment" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
      </div>
    </form>
  </div>

  <div class="box-footer box-comments">
    @foreach($post->comments as $comment)
      <div class="box-comment">
        <!-- User image -->
        <img class="img-circle img-sm" src="{{ asset($comment->user->image) }}" alt="User Image">

        <div class="comment-text">
              <span class="username">
                {{ $comment->user->name }}
                <span class="text-muted pull-right">{{ $comment->created_at->diffForHumans() }}</span>
              </span><!-- /.username -->
          {{ $comment->comment }}
        </div>
        <!-- /.comment-text -->
      </div>
    @endforeach
  </div>
            <!-- /.box-footer -->


</div>

    </div>
    <!-- /.col -->
  </div>
@endsection

@section('js')


@endsection
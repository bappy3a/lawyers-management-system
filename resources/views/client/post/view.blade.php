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
    <span class="pull-right text-muted">{{ $post->bit->count() }} Offer</span>
  </div>
  <!-- /.box-body -->
  <div class="box-footer box-comments">
    @foreach($post->bit as $bit)
    <div class="box-comment">
      <!-- User image -->
      <img class="img-circle img-sm" src="{{ asset($bit->user->image) }}" alt="User Image">

      <div class="comment-text">
            <span class="username">
              <a>{{ $bit->user->name }}</a> 
              <button class="btn btn-sm">Hare Rate  <b>BDT {{ $bit->user->rat }}</b> </button> 
              <button class="btn btn-sm">{{ renderStarRating($bit->user->review) }} </button> 
              @if($post->user_id == Auth::user()->id)
                <button onclick="userMessage({{ $bit->id }})" class="btn btn-sm btn-success">Send Message</button>
              @endif
              <span class="text-muted pull-right">{{ $bit->created_at->diffForHumans() }}</span>
            </span><!-- /.username -->
        {!! $bit->bit !!}
      </div>
      <!-- /.comment-text -->
    </div>
    @endforeach
  </div>
</div>

    </div>
    <!-- /.col -->
  </div>
@endsection

@section('js')


@endsection
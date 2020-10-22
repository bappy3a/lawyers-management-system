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

@if(!App\PostBit::where('user_id',Auth::user()->id)->where('post_id',$post->id)->first())
  <div class="box-footer">
    <form action="{{ route('lawyer.bit') }}" method="post">
      @csrf
      <input type="hidden" name="post_id" value="{{ $post->id }}">
      <img class="img-responsive img-circle img-sm" src="{{ asset(Auth::user()->image) }}" alt="Alt Text">
      <!-- .img-push is used to add margin to elements next to floating images -->
      <div class="img-push">
        <textarea name="bit" style="border: 2px solid #00000059" class="form-control @error('name') is-invalid @enderror" rows="3" placeholder="Press enter to post offer min 25  word" autofocus>{{ old('bit') }}</textarea>
        @error('bit')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            <br>
        @enderror
        <button type="submit" class="btn btn-sm btn-success" style="margin-top: 2px;">Submit</button>
      </div>

    </form>
  </div>
@else
  <h3 style="font-size: 16px;color: #398439;text-align: center;">Your Allready send offer</h3>
@endif


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
              <span class="text-muted pull-right">{{ $bit->created_at->diffForHumans() }}</span>
            </span><!-- /.username -->
        {!! $bit->bit !!}
      </div>
      <!-- /.comment-text -->
    </div>
    @endforeach
  </div>
  <!-- /.box-footer -->

  <!-- /.box-footer -->
</div>

    </div>
    <!-- /.col -->
  </div>
@endsection

@section('js')


@endsection
@extends('layouts.app')

@section('heading','Support')
@section('content')
  <div class="row">
    <div class="col-md-12">
      
<div class="box box-success">
  <div class="box-header">
    <i class="fa fa-comments-o"></i>

    <h3 class="box-title">Support Chat</h3>
  </div>
  <div class="box-body chat" id="chat-box">
    @foreach($supports as $support)
      <div class="item">
        <img src="{{ asset($support->user->image) }}" class="online">

        <p class="message">
          <a href="#" class="name">
            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{ $support->created_at->diffForHumans() }}</small>
            {{ $support->user->name }}
          </a>
          {{ $support->message }}
        </p>
        <!-- /.attachment -->
      </div>
    @endforeach
  </div>
  <!-- /.chat -->
  <div class="box-footer">
    <form action="{{ route('support.store') }}" method="post">
      @csrf
      <input type="hidden" name="sender_id" value="{{ $id }}">
      <div class="input-group">
        <input name="message" class="form-control" placeholder="Type message..." required>

        <div class="input-group-btn">
          <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i></button>
        </div>
      </div>
    </form>
  </div>
</div>

    </div>
  </div>
@endsection

@extends('layouts.app')

@section('heading','Message')
@section('content')
      <div class="row">
        <div class="col-md-3">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Conversation Lowyer</h3>
              <p class="text-red">Select Lowyer and show message</p>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            @include('message.user_list')
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary direct-chat direct-chat-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Direct Chat</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div id="message">
              <div class="box-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">

                  @foreach($messages as $message)
                    <div class="direct-chat-msg @if($message->from == Auth::user()->id) right @endif ">
                      <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name @if($message->from == Auth::user()->id) pull-right @else pull-left @endif">{{ $message->user->name }}</span>
                        <span class="direct-chat-timestamp @if($message->from == Auth::user()->id) pull-left @else pull-right @endif">{{ $message->created_at->diffForHumans() }}</span>
                      </div>
                      <!-- /.direct-chat-info -->
                      <img class="direct-chat-img" src="{{ asset($message->user->image) }}">
                      <div class="direct-chat-text">
                        {!! $message->message !!}
                      </div>
                    </div>
                  @endforeach
                </div>
                <!-- /.direct-chat-pane -->
              </div>

              <div class="box-footer">
                <form action="{{ route('message.send') }}" method="post">
                  @csrf
                  @if(Auth::user()->role == 'client')
                    <input type="hidden" name="to" value="{{ $messages->first()->to }}">
                  @else
                    <input type="hidden" name="to" value="{{ $messages->first()->from }}">
                  @endif
                  <input type="hidden" name="message_id" value="{{ $messages->first()->message_id }}">
                  <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                    @error('message')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-primary btn-flat">Send</button>
                    </span>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
@endsection

















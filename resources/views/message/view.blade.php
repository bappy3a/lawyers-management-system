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
          <h3 class="box-title">Message Bood</h3>
          
          <div class="box-tools pull-right">
            @if(Auth::user()->role == 'client')
              <a href="{{ route('client.lawyer.view',$messages->first()->to) }}" class="btn btn-danger btn-sm">View Lawyer Profile</a>
            @endif
            @if(auth()->user()->role == 'lawyer')
              <button data-toggle="modal" data-target="#exampleModal" class="btn btn-danger btn-sm">Send Appointment</button>
            @endif
          </div>
        </div>
        <!-- /.box-header -->
        <div id="message">
          <div class="box-body">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages" id="chatboox">

              @foreach($messages as $message)
                <div class="direct-chat-msg @if($message->from == Auth::user()->id) right @endif ">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name @if($message->from == Auth::user()->id) pull-right @else pull-left @endif">{{ $message->user->name }}</span>
                    <span class="direct-chat-timestamp @if($message->from == Auth::user()->id) pull-left @else pull-right @endif">{{ $message->created_at->diffForHumans() }}</span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="{{ asset($message->user->image) }}">
                  @if($message->appointment == 1)
                      <div class="direct-chat-text">
                        Lawyer Send a appointment plase pay this  
                        <br> Amount {{ $message->appointment_amount }} Tk
                        <br> Date {{ $message->appointment_date }}<br>
                        <form action="{{ route('message.appointment.pay') }}" method="post">
                          @csrf
                          <input type="hidden" name="message_id" value="{{ $message->id }}" required>
                          <button type="submit" class="btn btn-danger btn-sm"> Pay now</button>
                        </form>
                      </div>
                  @else
                    <div class="direct-chat-text">
                      {!! $message->message !!}
                    </div>
                  @endif
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
                <input type="text" name="message" placeholder="Type Message ..." class="form-control" required>
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

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{ route('message.appointment') }}" method="post">
          @csrf
          @if(Auth::user()->role == 'client')
            <input type="hidden" name="to" value="{{ $messages->first()->to }}">
          @else
            <input type="hidden" name="to" value="{{ $messages->first()->from }}">
          @endif
          <input type="hidden" name="message_id" value="{{ $messages->first()->message_id }}">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Appointment Form</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Appointment Date:</label>
              <input name="appointment_date" type="datetime-local" class="form-control" id="recipient-name">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Appointment Amount:</label>
              <input name="appointment_amount" class="form-control" id="message-text" placeholder="0.00" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit Appointment</button>
          </div>
        </form>
      </div>
    </div>
  </div>


@endsection


@section('js')

  <script>
    $(document).ready(function(){
        $('#chatboox').animate({
          scrollTop: $("#chatboox").offset().top
        }, 200);
    });
  </script>

@endsection














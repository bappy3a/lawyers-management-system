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
              <div class="box-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                  <markiq>Plice select user and show messages</markiq>
                </div>
                <!-- /.direct-chat-pane -->
              </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
@endsection

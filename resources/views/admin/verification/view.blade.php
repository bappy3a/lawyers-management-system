@extends('layouts.app')

@section('heading','Support')
@section('content')

  <div class="row">
    <div class="col-md-2"></div>
    <!-- /.col -->
    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Read Mail</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
            <button type="button" class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="mailbox-read-info">
            <h3>Barcode Registration ( <span style="color: green">{{ $data->reg_no }}</span> )</h3>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <ul class="mailbox-attachments clearfix">
            @foreach(json_decode($data->certificate_2) as $key=>$image)
              <li>
                <span class="mailbox-attachment-icon has-img"><img src="{{ asset($image) }}" alt="Attachment"></span>

                <div class="mailbox-attachment-info">
                  <a download href="{{ asset($image) }}" class="mailbox-attachment-name"><i class="fa fa-camera"></i> certificate_{{ $key+1 }}.png</a>
                      <span class="mailbox-attachment-size">
                        <a download href="{{ asset($image) }}" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                      </span>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
      <!-- /. box -->
    </div>
    <!-- /.col -->
  </div>

@endsection

@section('js')


@endsection
@extends('layouts.app')

@section('heading','Support')
@section('content')

  <div class="row">
    <div class="col-md-2"></div>
    <!-- /.col -->
    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Verification Request</h3>
          @if($data->status == 'Pending')
            <div class="box-tools pull-right">
              <a href="{{ route('verification.action', [$data->id, 'Approved']) }}" class="btn btn-success"><i class="fa fa-check"></i> Approved</a>
              <a href="{{ route('verification.action', [$data->id, 'Rejected']) }}" class="btn btn-danger"><i class="fa fa-ban"></i> Rejected</a>
            </div>
          @else
            <div class="box-tools pull-right">
                <h3 class="box-title" style="color: red;margin-top: 4px;font-weight: bold;">Your {{ $data->status }} this request</h3>
            </div>
          @endif
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
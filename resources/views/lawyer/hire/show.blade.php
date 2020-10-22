@extends('layouts.app')

@section('heading','Case Report')
@section('content')
  <div class="row">
    <div class="col-lg-7 ">

      <div class="box box-info">
        <div class="box-body">
          <form action="{{ route('lawyer.hire.details.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="hire_id" value="{{ $hire->id }}">
            <div>
              <textarea name="message" class="textarea" placeholder="Message" rows="4" cols="96" required></textarea>
            </div>
            <div class="form-group">
              <input type="file" class="form-control" name="documents[]" multiple>
            </div>
            <div class="form-group">
              <button type="submit" class="pull-right btn btn-primary" id="sendEmail">Submit
              </button>
            </div>
          </form>
        </div>
      </div>

      <div class="box box-success">
        <div class="box-header">
          <i class="fa fa-file"></i>
          <h3 class="box-title">Case Report</h3>
        </div>
        <div class="box-body chat" id="chat-box">
          <!-- chat item -->
@foreach(App\HireDetails::where('hire_id',$hire->id)->latest()->get() as $details )     
  <div class="item">
    <img src="{{ asset($details->user->image) }}" class="online">

    <p class="message">
      <a href="#" class="name">
        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{ $details->created_at->diffForHumans() }}</small>
        {{ $details->user->name }}
      </a>
      {{ $details->message }}
    </p>
    @if($details->documents)
      <div class="attachment">
        <h4>Attachments:</h4>

        <p class="filename">
          @foreach(json_decode($details->documents) as $file)
            <a href="{{ asset($file) }}" download data-toggle="tooltip" data-placement="top" title="Clink download this file"><img style="width: 80px" src="{{ asset('img/file.png') }}" class="margin"></a>
          @endforeach
        </p>
      </div>
    @endif
    <!-- /.attachment -->
  </div>
@endforeach
          <!-- /.item -->
        </div>
      </div>

    </div>
  </div>
@endsection

@section('js')

  <script>
  </script>

@endsection
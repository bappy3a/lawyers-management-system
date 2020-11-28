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
              <textarea name="message" class="textarea" placeholder="Message" required style="width: 100%; height: 60px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
    <div class="col-lg-5">
      <div class="box box-info">
        <form action="{{ route('milestone.store') }}" method="post">
          @csrf
          <input type="hidden" name="hire_id" value="{{ $hire->id }}">
          <input type="hidden" name="lawyer_id" value="{{ $hire->lowyer_id }}">
          <table class="table table-striped">
            <thead>
              <tr>
                <th width="40%">Date</th>
                <th width="30%">Date of appearance fee</th>
                <th width="10%"><button type="button" onclick="addrow()" class="btn btn-primary btn-xs"> Add New Row</button></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input required class="form-control" type="date" name="date[]" ></td>
                <td><input required class="form-control" type="number" name="price[]" placeholder="Date of appearance fee"></td>
                <td style="text-align: center;"><a href="javascript:void(0);" id="remove" class="btn btn-danger btn-sm remove"> <i class="fa fa-times"></i> </a> </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td style="border:none;"></td>               
                <td style="border:none;"></td>               
                <td> <button type="submit" class="btn btn-block btn-success btn-sm">Submit</button></td>
              </tr>
            </tfoot>
          </table>
        </form>
      </div>
      <div class="box box-primary">
        <div class="box-header">
          <i class="ion ion-clipboard"></i>
          <h3 class="box-title">Case Milestones List <span style="color: red;font-size: 14px">(Next Case Date)</span></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <ul class="todo-list">
            @foreach(App\Milestone::where('hire_id',$hire->id)->orderBy('date', 'ASC')->get() as $milestone)
              <li>
                <span class="handle">
                  <i class="fa fa-ellipsis-v"></i>
                  <i class="fa fa-ellipsis-v"></i>
                </span>
                <span class="text">{{ $milestone->date }},</span>
                <span class="text">Pay Tk{{ $milestone->pay }}</span>
                @if($milestone->status == "Unpaid")
                  <small class="label label-danger"><i class="fa fa-money"></i> Dou</small>
                @else
                  <small class="label label-success"><i class="fa fa-money"></i> Paid</small>
                @endif
              </li>
            @endforeach
          </ul>
        </div>
      </div>
      @if($hire->status == 'runing')
        <a href="{{ route('hare.complete',$hire->id) }}" class="btn btn-success btn-lg btn-block">Complete Case</a>
      @endif
    </div>
  </div>
@endsection

@section('js')

  <script>

    function addrow(){
      var tr = '<tr>'+
          '<td><input required class="form-control" type="date" name="date[]" ></td>'+
          ' <td><input required class="form-control" type="number" name="price[]" placeholder="Date of appearance fee"></td>'+
          '<td style="text-align: center;"><a href="javascript:void(0);" id="remove" class="btn btn-danger btn-sm remove"> <i class="fa fa-times"></i> </a> </td>'+                 
       '</tr>';
        $('tbody').append(tr);
    };

    $('body').delegate('#remove','click', function(){
      var l= $('tbody tr').length;
      console.log(l);
      if (l == 1) {
        alert('you can not remove Last Row');
      }else{
        $(this).parent().parent().remove();
        total();
      }
      
    });

  </script>

@endsection
@extends('layouts.app')

@section('css')

<style>
  .rate {
    float: left;
    height: 46px;
    padding: 0 10px;
  }
  .rate:not(:checked) > input {
      position:absolute;
      top:-9999px;
  }
  .rate:not(:checked) > label {
      float:right;
      width:1em;
      overflow:hidden;
      white-space:nowrap;
      cursor:pointer;
      font-size:30px;
      color:#ccc;
  }
  .rate:not(:checked) > label:before {
      content: '★ ';
  }
  .rate > input:checked ~ label {
      color: #ffc700;    
  }
  .rate:not(:checked) > label:hover,
  .rate:not(:checked) > label:hover ~ label {
      color: #deb217;  
  }
  .rate > input:checked + label:hover,
  .rate > input:checked + label:hover ~ label,
  .rate > input:checked ~ label:hover,
  .rate > input:checked ~ label:hover ~ label,
  .rate > label:hover ~ input:checked ~ label {
      color: #c59b08;
  }
</style>

@endsection

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

      
<div class="box box-warning">
  <div class="box-header with-border">
    <h3 class="box-title">Your Case Is Complete Please Review</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    @if($hire->status = 'complete')
      @php
        $review = \App\Review::where('hire_id',$hire->id)->first();
      @endphp
      @if($review)
        <form role="form">
          <div class="form-group">
            <label style="display: block;">Review Star</label>
              <div class="rate">
                  <input type="radio" id="star5" name="rating" value="5" @if($review->rating == 5) checked @endif />
                  <label for="star5" title="text">5 stars</label>
                  <input type="radio" id="star4" name="rating" value="4" @if($review->rating == 4) checked @endif />
                  <label for="star4" title="text">4 stars</label>
                  <input type="radio" id="star3" name="rating" value="3" @if($review->rating == 3) checked @endif />
                  <label for="star3" title="text">3 stars</label>
                  <input type="radio" id="star2" name="rating" value="2" @if($review->rating == 2) checked @endif />
                  <label for="star2" title="text">2 stars</label>
                  <input type="radio" id="star1" name="rating" value="1" @if($review->rating == 1) checked @endif />
                  <label for="star1" title="text">1 star</label>
              </div>
          </div>
          <!-- textarea -->
          <div class="form-group">
            <textarea required name="comment" class="form-control" rows="3" placeholder="Enter Comment..." required readonly >{{ $review->comment }}</textarea>
          </div>
          <div class="form-group">
            @php
              $result = \App\CaseResult::where('case_id',\App\Hare::find($hire->id)->case_id)->first();
            @endphp
            <label>Case Result</label>
            @if($result->win == 1)
              <h3 style="color: green">Case Win</h3>
            @else
              <h3 style="color: red">Case Lose</h3>
            @endif
          </div>

        </form>
      @else
        <form role="form" action="{{ route('review.submit') }}" method="post">
          @csrf
          <input type="hidden" name="hire_id" value="{{ $hire->id }}">
          <input type="hidden" name="lowyer_id" value="{{ $hire->lowyer_id }}">
          <div class="form-group">
            <label style="display: block;">Review Star</label>
              <div class="rate">
                  <input type="radio" id="star5" name="rating" value="5" />
                  <label for="star5" title="text">5 stars</label>
                  <input type="radio" id="star4" name="rating" value="4" />
                  <label for="star4" title="text">4 stars</label>
                  <input type="radio" id="star3" name="rating" value="3" />
                  <label for="star3" title="text">3 stars</label>
                  <input type="radio" id="star2" name="rating" value="2" />
                  <label for="star2" title="text">2 stars</label>
                  <input type="radio" id="star1" name="rating" value="1" checked />
                  <label for="star1" title="text">1 star</label>
              </div>
          </div>

          <!-- textarea -->
          <div class="form-group">
            <textarea name="comment" class="form-control" rows="3" placeholder="Enter Comment..." required></textarea>
          </div>
          <div class="form-group">
            <label>Case Result</label>
            <div class="row">
              <div class="col-md-6">
                  <div class="form-check">
                    <input name="winorlose" type="radio" class="form-check-input" id="win" required value="win">
                    <label class="form-check-label" for="win">Win Case</label>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-check">
                    <input name="winorlose" type="radio" class="form-check-input" id="lose" required value="lose">
                    <label class="form-check-label" for="lose">Lose Case</label>
                  </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="pull-right btn btn-primary" id="sendEmail">Submit
            </button>
          </div>
        </form>
      @endif
    @endif
  </div>
  <!-- /.box-body -->
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
                <span class="text">{{ $milestone->date }} Pay an amount <span class="text-red">{{ $milestone->pay }}</span> Tk </span>
                @if($milestone->status == "Unpaid")
                  <small class="label label-danger"><i class="fa fa-money"></i> Dou</small>  
                  <form action="{{ route('milestone.pay') }}" method="post" class="pull-right" style="margin-top: -4px;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $milestone->id }}">
                    <button class="btn btn-success btn-sm">Pay Now</button>
                  </form>
                @else
                  <small class="label label-success"><i class="fa fa-money"></i> Paid</small>
                @endif
                
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')

  <script>


  </script>

@endsection
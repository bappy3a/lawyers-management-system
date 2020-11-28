@extends('layouts.app')

@section('heading','Lawyers')
@section('content')

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{ asset($lawyer->image) }}">

              <h3 class="profile-username text-center">
                {{ $lawyer->name }}
                @if($lawyer->is_verified)
                  <i data-toggle="tooltip" data-placement="top" title="Verified" style="color: #3c763d" class="fa fa-check"></i>
                @else
                  <i data-toggle="tooltip" data-placement="top" title="Not Verified" style="color: red" class="fa fa-close"></i>
                @endif
              </h3>

              <p class="text-muted text-center">{{ $lawyer->lawyer_type }}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Hire Rate</b> <a class="pull-right">BDT {{ $lawyer->rat }}</a>
                </li>
                <li class="list-group-item">
                  <b>Reting</b> <a class="pull-right">{{ renderStarRating($lawyer->review) }}</a>
                </li>
                <li class="list-group-item">
                  <b>Case</b> <a class="pull-right">{{ \App\Hare::where('lowyer_id',$lawyer->id)->count() }}</a>
                </li>
              </ul>

              <button type="button" data-toggle="modal" data-target="#HireLowyer" class="btn btn-primary btn-block"><b>Hire This Lowyer</b></button>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Lawyer About</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                {{ $lawyer->certificate }}
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Home Location</strong>

              <p class="text-muted">{{ $lawyer->address }}</p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Chember Location</strong>

              <p class="text-muted">{{ $lawyer->chember_address }}</p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Barcouncil Id Number</strong>

              <p class="text-muted">{{ $lawyer->reg_no }}</p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>NID Number</strong>

              <p class="text-muted">{{ $lawyer->natnal_id }}</p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Date Of Barth</strong>

              <p class="text-muted">{{ $lawyer->dob }}</p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Experience</strong>

              <p>{{ $lawyer->experience }}</p>

              <hr>
              @if($lawyer->certificate_2)
                <strong><i class="fa fa-map-marker margin-r-5"></i>Certificate</strong>
                <ul class="mailbox-attachments clearfix">
                  @foreach(json_decode($lawyer->certificate_2) as $key=>$certificate)
                    <li style="width: 104px !important;">
                      <span class="mailbox-attachment-icon has-img"><img src="{{ asset($certificate) }}" alt="Attachment"></span>

                      <div class="mailbox-attachment-info">
                        
                            <span class="mailbox-attachment-size">
                              <a download href="{{ asset($certificate) }}" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                            </span>
                      </div>
                    </li>
                  @endforeach
                </ul>
              @endif
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Client Review</a></li>
              <li><a href="#settings" data-toggle="tab">Message</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                @foreach(\App\Review::where('lowyer_id',$lawyer->id)->latest()->get() as $review )
                  <div class="post">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="{{ asset($review->user->image) }}" alt="user image">
                          <span class="username">
                            <a href="#">{{ $review->user->name }}</a>
                            <a class="pull-right btn-box-tool">{{ renderStarRating($lawyer->review) }}</a>
                          </span>
                      <span class="description">SHired publicly - {{ $review->created_at->diffForHumans() }}</span>
                    </div>
                    <p>
                      {{ $review->comment }}
                    </p>
                  </div>
                @endforeach
                @if(\App\Review::where('lowyer_id',$lawyer->id)->latest()->count() == 0)
                  <div class="post">
                    <h3>No review found this lawyer</h3>
                  </div>
                @endif
              </div>


              <div class="tab-pane" id="settings">
                <form class="form-horizontal" action="{{ route('message.store') }}" method="post">
                  @csrf
                  <input type="hidden" name="to" value="{{ $lawyer->id }}">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Your Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Message</label>

                    <div class="col-sm-10">
                      <textarea name="message" class="form-control" id="inputExperience" placeholder="Type sumthing ......."></textarea>
                      @error('message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Send</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>



  <div class="modal fade" id="HireLowyer">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hire <u>{{ $lawyer->name }}</u></h4>
        </div>
        <div class="modal-body">
            <form role="form" action="{{ route('hire.payment') }}" method="POST">
              @csrf
              <input type="hidden" name="lawyer_id" value="{{ $lawyer->id }}">
              <div class="box-body">
                <div class="form-group">
                  <label>Select Case</label>
                  <select name="case_id" class="form-control" required>
                      <option value="" selected>--- Select case ---</option>
                    @foreach(\App\Cas::where('user_id',auth()->user()->id)->get() as $case)
                      <option value="{{ $case->id }}">{{ $case->case_title }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" required> Hire this lowyer play <b class="text-red">BDT {{ $lawyer->rat }}</b>
                  </label>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Hire</button>
              </div>
            </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

@endsection

@section('js')

 

@endsection
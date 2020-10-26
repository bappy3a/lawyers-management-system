@extends('layouts.app')

@section('heading','User Profile')
@section('content')
      <div class="row">
        <div class="col-md-3">
  			@php
  				$user = Auth::user();
  			@endphp
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{ asset($user->image) }}" alt="{{ $user->name }}">

              <h3 class="profile-username text-center">{{ $user->name }}</h3>
      			  @if($user->role == 'lawyer')
                <p class="text-muted text-center">{{ $user->lawyer_type }}</p>
      			  @endif
              <ul class="list-group list-group-unbordered">
              	@if($user->role == 'lawyer')
	                <li class="list-group-item">
	                  <b>Verification Status</b> <a class="pull-right">
        						@if($user->is_verified)
      		                  <i data-toggle="tooltip" data-placement="top" title="Verified" style="color: #3c763d" class="fa fa-check"></i>
      		                @else
      		                  <i data-toggle="tooltip" data-placement="top" title="Not Verified" style="color: red" class="fa fa-close"></i>
      		                @endif

      	                  </a>
      	                </li>
      	            @endif
    	            @if($user->role == 'lawyer')
    	                <li class="list-group-item">
    	                  <b>Hire Rate</b> <a class="pull-right">{{ $user->rat }} Tk</a>
    	                </li>
    	            @endif
    	            @if($user->role == 'lawyer')
    	                <li class="list-group-item">
    	                  <b>Reating</b> <a class="pull-right">{{ renderStarRating($user->review) }}</a>
    	                </li>
                      <li class="list-group-item">
                        <b>Your Balance</b> <a class="pull-right">{{ $user->balance }} Tk</a>
                      </li>
    	            @endif
              </ul>
              @if($user->role == 'lawyer')
                @if(!$user->is_verified)
                  <button data-toggle="modal" data-target="#accoutn-acctive" type="button" class="btn btn-danger btn-block"><b>Active Your Profile</b></button>
                @endif
              @endif
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          @if($user->role == 'lawyer')
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">About Me</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                <p class="text-muted">
                  {{ $user->certificate }}
                </p>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i>Home Location</strong>

                <p class="text-muted">{{ $user->address }}</p>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i>Chember Location</strong>

                <p class="text-muted">{{ $user->chember_address }}</p>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i>Barcouncil Id Number</strong>

                <p class="text-muted">{{ $user->reg_no }}</p>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i>NID Number</strong>

                <p class="text-muted">{{ $user->natnal_id }}</p>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i>Date Of Barth</strong>

                <p class="text-muted">{{ $user->dob }}</p>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i>Experience</strong>

                <p>{{ $user->experience }}</p>

                <hr>
                @if($user->certificate_2)
                  <strong><i class="fa fa-map-marker margin-r-5"></i>Certificate</strong>
                  <ul class="mailbox-attachments clearfix">
                    @foreach(json_decode($user->certificate_2) as $key=>$certificate)
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
          @endif
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">



              <div class="active tab-pane" id="settings">
                <form class="form-horizontal" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                	@csrf
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $user->name }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" value="{{ $user->email }}" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Phone Number</label>

                    <div class="col-sm-10">
                      <input type="text" name="number" class="form-control" id="inputName" placeholder="Phone Number" value="{{ $user->number }}">
                    </div>
                  </div>
                  @if($user->role == 'lawyer')
                    <div class="form-group">
                      <label for="inputExperience" class="col-sm-2 control-label">Lawyer education institution name</label>

                      <div class="col-sm-10">
                        <input type="text" name="certificate" placeholder="Lawyer education institution name" class="form-control" value="{{ $user->certificate }}">
                      </div>
                    </div>
                  @endif
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">NID Number</label>

                    <div class="col-sm-10">
                      <input type="number" name="natnal_id" class="form-control" id="inputSkills" placeholder="NID Number" value="{{ $user->natnal_id }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Date Of Barth</label>

                    <div class="col-sm-10">
                      <input type="date" name="dob" class="form-control" id="inputSkills" placeholder="Date Of Barth" value="{{ $user->dob }}">
                    </div>
                  </div>
                  @if($user->role == 'lawyer')
                    <div class="form-group">
                      <label for="inputSkills" class="col-sm-2 control-label">Experience</label>

                      <div class="col-sm-10">
                        <input type="text" name="experience" class="form-control" id="inputSkills" placeholder="Experience" value="{{ $user->experience }}">
                      </div>
                    </div>
                  @endif
                  @if($user->role == 'lawyer')
                    <div class="form-group">
                      <label for="inputSkills" class="col-sm-2 control-label">Chember Address</label>

                      <div class="col-sm-10">
                        <input type="text" name="chember_address" class="form-control" id="inputSkills" placeholder="Chember Address" value="{{ $user->chember_address }}">
                      </div>
                    </div>
                  @endif
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Home Address</label>

                    <div class="col-sm-10">
                      <input type="text" name="address" class="form-control" placeholder="Home Address" value="{{ $user->address }}">
                    </div>
                  </div>
                  @if($user->role == 'lawyer')
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Hire Rat</label>

                    <div class="col-sm-10">
                      <input type="text" name="rat" class="form-control" id="inputSkills" placeholder="Hire Rat" value="{{ $user->rat }}">
                    </div>
                  </div>
                  @endif
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Profile Photo</label>

                    <div class="col-sm-10">
                      <input type="file" name="image" class="form-control" id="inputSkills" placeholder="Profile Photo">
                    </div>
                  </div>
                  
                  <hr>
                  <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>New Password</label>
                           <input type="password" id="password" class="form-control" placeholder="Enter your new password" name="password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Confirm Password</label>
                          <input type="password" id="confirm_password" class="form-control" placeholder="Enter your new password again" name="password_confirmation">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>


@if($user->role == 'lawyer')
  <div class="modal fade" id="accoutn-acctive">
    <div class="modal-dialog">
      <div class="modal-content">
        @php
          $verification = App\Verification::where('user_id',$user->id)->first();
        @endphp
        @if($verification)
          @if($verification->status == 'Pending')
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Account Verified From</h4> <span class="text-red">Verification free 500 Bdt</span>
            </div>
            <div class="modal-body">
                <h3>Your request is {{ $verification->status }} please wait for chack your certificate</h3>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
          @else
            <form action="{{ route('verification.update',$verification->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Account Verified Re-Submit From</h4>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                    <label>Bar council registration number</label>
                    <input type="text" name="reg_no" class="form-control" placeholder="Bar council registration number">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputFile">Inpurt Your all certificate</label>
                      <input type="file" name="certificate_2[]" multiple>
                      <p class="help-block">Multiple upload.</p>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Re Submit</button>
              </div>
            </form>
          @endif
        @else
          <form action="{{ route('verification.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Account Verified From</h4> <span class="text-red">Verification free 500 Bdt</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Bar council registration number</label>
                  <input type="text" name="reg_no" class="form-control" placeholder="Bar council registration number">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Inpurt Your all certificate</label>
                    <input type="file" name="certificate_2[]" multiple>
                    <p class="help-block">Multiple upload.</p>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" required> Pay BDT 500 For Verified
                  </label>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        @endif
      </div>
    </div>
  </div>
@endif


@endsection

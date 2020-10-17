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
	                  <b>Hire Rate</b> <a class="pull-right">BDT {{ $user->rat }}</a>
	                </li>
	            @endif
	            @if($user->role == 'lawyer')
	                <li class="list-group-item">
	                  <b>Reating</b> <a class="pull-right">{{ renderStarRating($user->review) }}</a>
	                </li>
	            @endif
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
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
            </div>
            <!-- /.box-body -->
          </div>
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
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Lawyer Registration Number</label>

                    <div class="col-sm-10">
                      <input type="text" name="reg_no" placeholder="Lawyer Registration Number" class="form-control" value="{{ $user->reg_no }}">
                    </div>
                  </div>
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
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <input type="text" name="experience" class="form-control" id="inputSkills" placeholder="Experience" value="{{ $user->experience }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Chember Address</label>

                    <div class="col-sm-10">
                      <input type="text" name="chember_address" class="form-control" id="inputSkills" placeholder="Chember Address" value="{{ $user->chember_address }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Home Address</label>

                    <div class="col-sm-10">
                      <input type="text" name="address" class="form-control" placeholder="Home Address" value="{{ $user->address }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Hire Rat</label>

                    <div class="col-sm-10">
                      <input type="text" name="rat" class="form-control" id="inputSkills" placeholder="Hire Rat" value="{{ $user->rat }}">
                    </div>
                  </div>
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
@endsection

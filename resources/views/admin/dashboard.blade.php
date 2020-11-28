@extends('layouts.app')

@section('heading','Dashboard')
@section('content')
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Client</span>
              <span class="info-box-number">{{ \App\User::where('role','client')->count() }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Lawyer</span>
              <span class="info-box-number">{{ \App\User::where('role','Lawyer')->count() }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        
      </div>
      <!-- /.row -->


      <!-- Main row -->
      <div class="row">

            <div class="col-md-4">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Members</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger">{{ count(\App\User::latest()->get()) }} New Members</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    @foreach(\App\User::latest()->get() as $user)
                      <li>
                        <img src="{{ asset($user->image) }}">
                        <a class="users-list-name" href="#">{{ $user->name }}</a>
                        <span class="users-list-date">{{ $user->created_at->diffForHumans() }}</span>
                      </li>
                    @endforeach
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="{{ route('admin.client') }}" class="uppercase">View All Users</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>
			
			<div class="col-md-8">
	          <div class="box box-info">
	            <div class="box-header with-border">
	              <h3 class="box-title">Latest Verification Required</h3>

	              <div class="box-tools pull-right">
	                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
	                </button>
	                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	              </div>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
	              <div class="table-responsive">
	                <table class="table no-margin">
	                  <thead>
	                  <tr>
	                    <th>#Si</th>
                      <th>Lawyer Name</th>
	                    <th>Status</th>
	                    <th width="15%">View</th>
	                  </tr>
	                  </thead>
	                  <tbody>
                      @foreach(\App\Verification::latest()->get() as $key=>$data)
  	                  <tr>
                        <td>{{ $key +1 }}</td>
  	                    <td><a href="{{ route('verification.show',$data->id) }}">{{ $data->user->name }}</a></td>
                        @if($data->status == 'Rejected')
                          <td><span class="label label-danger">Rejected</span></td>
                        @elseif($data->status == 'Approved')
                          <td><span class="label label-success">Approved</span></td>
                        @else
                          <td><span class="label label-primary">Pending</span></td>
                        @endif
  	                    <td>
  	                      <a href="{{ route('verification.show',$data->id) }}" class="btn btn-sm btn-info">See Document</a>
  	                    </td>
  	                  </tr>
                      @endforeach
	                  </tbody>
	                </table>
	              </div>
	              <!-- /.table-responsive -->
	            </div>
	            <!-- /.box-body -->
	            <div class="box-footer clearfix">
	              <a href="{{ route('verification.index') }}" class="btn btn-sm btn-default btn-flat pull-right">View All Required</a>
	            </div>
	            <!-- /.box-footer -->
	          </div>
			</div>








        <!-- /.col -->
      </div>
@endsection

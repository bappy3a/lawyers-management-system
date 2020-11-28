@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/seiyria-bootstrap-slider/css/bootstrap-slider.min.css') }}">
@endsection

@section('heading','Fine Your Lawyer')
@section('content')

      <div class="row">
        <div class="col-xs-12">


      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Search Lowyer</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form action="{{ url()->current() }}" method="GET" autocomplete="off">
            <input type="hidden" name="s" value="on">
            <div class="row">
              <div class="col-xs-3">
                <div class="form-group">
                  <label>Lowyer Type</label>
                  <select class="form-control" name="lawyer_type">
                    <option value=""> Select Lowyer Type</option>
              
                    @if(request()->query('lawyer_type'))
                      <option selected value="{{ request()->query('lawyer_type') }}">{{ request()->query('lawyer_type') }}</option>
                    @endif
                    <option value="Personal Injury">Personal Injury</option>
                    <option value="Estate Planning">Estate Planning</option>
                    <option value="Bankruptcy">Bankruptcy</option>
                    <option value="Intellectual Property">Intellectual Property</option>
                    <option value="Employment">Employment</option>
                    <option value="Corporate">Corporate</option>
                    <option value="Immigration">Immigration</option>
                    <option value="Criminal">Criminal</option>
                  </select>
                </div>
              </div>
              <div class="col-xs-2">
                <div class="form-group">
                  <label>Reting</label>
                  <select class="form-control" name="review">
                    <option value="">Select Reting</option>
                    @if(request()->query('review'))
                      <option selected value="{{ request()->query('review') }}">Star {{ request()->query('review') }}</option>
                    @endif
                    <option value="0">Star 0</option>
                    <option value="1">Star 1</option>
                    <option value="2">Star 2</option>
                    <option value="3">Star 3</option>
                    <option value="4">Star 4</option>
                    <option value="5">Star 5</option>
                  </select>
                </div>
              </div>
              <div class="col-xs-2">
                <div class="form-group">
                  <label>Verified</label>
                  <select class="form-control" name="is_verified">
                    <option value="">Select Verified Status</option>
                    <option @if(request()->query('review')) selected @endif value="1">Yes</option>
                  </select>
                </div>
              </div>
              <div class="col-xs-3">
                <div class="form-group">
                  <label>Price</label> <br>
                  <input type="text" name="price" value="" class="slider form-control" data-slider-min="0" data-slider-max="20000" data-slider-step="5" 
                  @if(request()->query('price'))
                  data-slider-value="[{{ request()->query('price') }}]" 
                  @else
                  data-slider-value="[10,1000]" 
                  @endif
                  data-slider-orientation="horizontal"
                         data-slider-selection="before" data-slider-tooltip="show" data-slider-id="green">
                </div>
              </div>
              <div class="col-xs-2">
                <label style="margin-bottom: 20px;"> </label>
                <button type="submit" class="btn btn-block btn-success"> Search</button>
              </div>
            </div>
          </form>
        </div>
      </div>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Lawyer List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="3%">SI</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Lawyer Type</th>
                  <th>Chember Address</th>
                  <th>Review</th>
                  <th>Price</th>
                  <th width="5%">Verified</th>
                  <th width="10%">Acction</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($lawyers as $key=>$lawyer)
                    <tr>
                      <td>{{ $key +1 }}</td>
                      <td><img style="width: 60px;height: 60px" src="{{ asset($lawyer->image) }}" alt=""></td>
                      <td>
                        {{ $lawyer->name }} <br>
                        {{ $lawyer->email }}
                      </td>
                      <td>{{ $lawyer->lawyer_type }}</td>
                      <td>{{ $lawyer->chember_address }}</td>
                      <td>{{ renderStarRating($lawyer->review) }}</td>
                      <td>${{ $lawyer->rat }}</td>
                      <td>
                        @if($lawyer->is_verified)
                          <span class="btn btn-sm btn-success"><i class="fa fa-check-circle"></i></span>
                        @else
                          <span class="btn btn-sm btn-danger"><i class="fa fa-ban"></i></span>
                        @endif
                      </td>
                      <td>
                        <a href="{{ route('client.lawyer.view',$lawyer->id) }}" class="btn btn-sm btn-primary">View</a>
                      </td>
                    </tr>
                  @endforeach
                
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

@endsection

@section('js')

  <script>
    $(function () {
      $('#example1').DataTable()
    })
  </script>
  <!-- Bootstrap slider -->
  <script src="{{ asset('plugins/seiyria-bootstrap-slider/bootstrap-slider.min.js') }}"></script>
  <script>
    $(function () {
      /* BOOTSTRAP SLIDER */
      $('.slider').slider()
    })
  </script>

@endsection
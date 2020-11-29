@extends('layouts.app')

@section('heading','Lawyers')
@section('content')

      <div class="row">
        <div class="col-xs-12">

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
                  <th>Email</th>
                  <th>Chember Address</th>
                  <th width="5%">Verified</th>
                  <th width="10%">Acction</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($lawyers as $key=>$lawyer)
                    <tr>
                      <td>{{ $key +1 }}</td>
                      <td><img src="{{ asset($lawyer->image) }}" alt="" style="width: 60px;height: 60px;"></td>
                      <td>{{ $lawyer->name }}</td>
                      <td>{{ $lawyer->email }}</td>
                      <td>{{ $lawyer->chember_address }}</td>
                      <td>
                        @if($lawyer->is_verified)
                          <span class="btn btn-sm btn-success"><i class="fa fa-check-circle"></i></span>
                        @else
                          <span class="btn btn-sm btn-danger"><i class="fa fa-ban"></i></span>
                        @endif
                      </td>
                      <td>
                        <a href="{{ route('admin.lawyer.view',$lawyer->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
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

@endsection
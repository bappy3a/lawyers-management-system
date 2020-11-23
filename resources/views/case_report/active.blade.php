@extends('layouts.app')

@section('heading','Case Posting')
@section('content')
  <div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <div class="row">
            <div class="col-md-6">
              <h3 class="box-title">Active Case List</h3>
            </div>
          </div>
          
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th width="3%">SI</th>
              <th>Case No</th>
              <th>Type Of Case</th>
              <th>Case Date</th>
              <th>Courte Name</th>
              <th width="40%"> Case Description</th>
            </tr>
            </thead>
            <tbody>
              @foreach($hares as $key=>$hare)
                <tr>
                  <td>{{ $key +1 }}</td>
                  <td>{{ $hare->case->case_no }}</td>
                  <td>{{ $hare->case->case_title }}</td>
                  <td>{{ $hare->case->case_date }}</td>
                  <td>{{ $hare->case->court }}</td>
                  <td>{!! $hare->case->case_description !!}</td>
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
    });
  </script>

@endsection
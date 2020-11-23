@extends('layouts.app')

@section('heading','Lawyers')
@section('content')

      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Case Report</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="3%">SI</th>
                  <th width="10%">type of case</th>
                  <th width="15%">Date</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($cases as $key=>$case)
                    <tr>
                      <td>{{ $key +1 }}</td>
                      <td>{{ $case->case_title }}</td>
                      <td>{{ $case->created_at->format('d M, Y') }}</td>
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
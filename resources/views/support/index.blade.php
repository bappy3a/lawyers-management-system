@extends('layouts.app')

@section('heading','Support')
@section('content')

      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Support Message</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="3%">SI</th>
                  <th width="15%">User Image</th>
                  <th>User Name</th>
                  <th width="15%">View Message</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($supports as $key=>$support)
                    @php
                      $user = \App\User::find($support->sender_id)
                    @endphp
                    <tr>
                      <td>{{ $key +1 }}</td>
                      <td> <img src="{{ asset($user->image) }}" style="width: 50px;height: 50px;border-radius: 50%;"></td>
                      <td>{{ $user->name }}</td>
                      <td>
                        <a href="{{ route('support.show',$support->sender_id) }}" class="btn btn-sm btn-info">View Message</a>
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
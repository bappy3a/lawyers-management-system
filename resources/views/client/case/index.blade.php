@extends('layouts.app')

@section('heading','Case Posting')
@section('content')
  <div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <div class="row">
            <div class="col-md-6">
              <h3 class="box-title">Your Case List</h3>
            </div>
            <div class="col-md-6">
              <a href="{{ route('case.create') }}" class="btn btn-primary btn-sm pull-right">Add New</a>
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
              <th>Case Description</th>
              <th width="12%">Acction</th>
            </tr>
            </thead>
            <tbody>
              @foreach($cases as $key=>$case)
                <tr>
                  <td>{{ $key +1 }}</td>
                  <td>{{ $case->case_no }}</td>
                  <td>{{ $case->case_title }}</td>
                  <td>{{ $case->case_date }}</td>
                  <td>{{ $case->court }}</td>
                  <td>{!! $case->case_description !!}</td>
                  <td>
                    <a href="{{ route('case.edit',$case->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                    <button onclick="deletecat({{ $case->id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    <form id="delete-form-{{ $case->id }}" action="{{ route('case.destroy',$case->id) }}" method="post" style="display: none;">
                          @csrf
                          @method('DELETE')
                      </form>
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
    });
    function deletecat(id) {
            const swalWithBootstrapButtons = Swal.mixin({
              confirmButtonClass: 'btn btn-success',
              cancelButtonClass: 'btn btn-danger',
              buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, delete it!',
              cancelButtonText: 'No, cancel!',
              reverseButtons: true
            }).then((result) => {
              if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-'+id).submit();
              } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
              ) {
                swalWithBootstrapButtons.fire(
                  'Cancelled',
                  'Your Data  is safe :)',
                  'error'
                )
              }
            })
        }
  </script>

@endsection
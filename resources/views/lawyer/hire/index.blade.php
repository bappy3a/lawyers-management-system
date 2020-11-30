@extends('layouts.app')

@section('heading','Case Posting')
@section('content')
  <div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <div class="row">
            <div class="col-md-6">
              <h3 class="box-title">Hire Lawyer List</h3>
            </div>
          </div>
          
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th width="3%">SI</th>
              <th>Client Name</th>
              <th>Court Name</th>
              <th>Type Of Case</th>
              <th>Case No</th>
              <th>Case Date</th>
              <th width="10%">Acction</th>
            </tr>
            </thead>
            <tbody>
              @foreach($hires as $key=>$hire)
                <tr>
                  <td>{{ $key +1 }}</td>
                  <td><a href="#">{{ $hire->cleint->name }}</a></td>
                  <td>{{ $hire->case->court }}</td>
                  <td>{{ $hire->case->case_no }}</td>
                  <td>{{ $hire->case->case_title }}</td>
                  <td>{{ $hire->case->case_date }}</td>
                  <td>
                    <a href="{{ route('lawyer.hire.view',$hire->id) }}" class="btn btn-sm btn-primary">View Details</a>
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
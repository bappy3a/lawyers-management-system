@extends('layouts.app')

@section('heading','Help Post')
@section('content')
  <div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <div class="row">
            <div class="col-md-6">
              <h3 class="box-title">Help Post</h3>
            </div>
            <div class="col-md-6">
              <a href="{{ route('helppost.create') }}" class="btn btn-primary btn-sm pull-right">Add Your Post</a>
            </div>
          </div>
          
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th width="3%">SI</th>
              <th width="10%">Author</th>
              <th width="15%">Title</th>
              <th>Description</th>
              <th width="12%">Acction</th>
            </tr>
            </thead>
            <tbody>
              @foreach($posts as $key=>$post)
                <tr>
                  <td>{{ $key +1 }}</td>
                  <td>{{ $post->user->name }}</td>
                  <td>{{ $post->title }}</td>
                  <td>{!! $post->description !!}</td>
                  <td>
                    <a href="{{ route('helppost.show',$post->id) }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="View Post"><i class="fa fa-eye"></i></a>
                    @if(auth()->user()->id == $post->user->id or  auth()->user()->role == 'admin')
                      <a href="{{ route('helppost.edit',$post->id) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edite Post"><i class="fa fa-edit"></i></a>
                      <button onclick="deletecat({{ $post->id }})" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Post"><i class="fa fa-trash"></i></button>
                      <form  id="delete-form-{{ $post->id }}" action="{{ route('helppost.destroy',$post->id) }}" method="post" style="display: none;">
                            @csrf
                            @method('DELETE')
                      </form>
                    @endif
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
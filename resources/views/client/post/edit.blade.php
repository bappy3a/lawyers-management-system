@extends('layouts.app')

@section('heading','Case Posting')
@section('content')
  <div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Enter Your Post ..</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            @if ($errors->any())
              @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible col-md-3" style="margin: 5px;">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-ban"></i> Warning!</h4>
                  {{ $error }}
                </div>
              @endforeach
            @endif
          </div>
          <form class="form-horizontal" action="{{ route('post.update',$post->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label class="col-sm-2 control-label">Title</label>
              <div class="col-sm-10">
                <input value="{{ $post->title }}" type="text" name="title" class="form-control" placeholder="Post Title Here ...">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Description</label>
              <div class="col-sm-10">
                <textarea  id="edtor" name="description" rows="10" cols="80" placeholder="Enter your case Description ..">{{ $post->description }}</textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-info pull-right">UPDATE</button>
              </div>
            </div>
          </form>
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
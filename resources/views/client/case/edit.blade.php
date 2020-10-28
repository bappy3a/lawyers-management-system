@extends('layouts.app')

@section('heading','Case Posting')
@section('content')
  <div class="row">
    <div class="col-xs-8" >

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Enter Your Post ..</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form class="form-horizontal" action="{{ route('case.update',$case->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
              <label class="col-sm-3 control-label">Type of Case</label>
              <div class="col-sm-9">
                <input type="text" name="case_title" class="form-control" placeholder="Type of Case ..." value="{{ $case->case_title }}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Case Date</label>
              <div class="col-sm-9">
                <input type="text" name="case_date" class="form-control pull-right" id="datepicker" value="{{ $case->case_date }}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Case Number</label>
              <div class="col-sm-9">
                <input value="{{ $case->case_no }}" type="text" name="case_no" class="form-control" placeholder="Case Number ...">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Court Name</label>
              <div class="col-sm-9">
                <input value="{{ $case->court }}" type="text" name="court" class="form-control" placeholder="Case Number ..." >
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Description</label>
              <div class="col-sm-9">
                <textarea  id="editor1" name="case_description" rows="10" cols="80" placeholder="Enter your case Description ..">{{ $case->case_description }}</textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-info pull-right">Update</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <div class="col-xs-4">
      @if ($errors->any())
            @foreach ($errors->all() as $error)
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Warning!</h4>
                {{ $error }}
              </div>
            @endforeach
          @endif
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
  <script>
    $('#datepicker').datepicker({
      autoclose: true
    })
  </script>
  <script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
@endsection
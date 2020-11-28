<form action="{{ route('message.store') }}" method="post">
  @csrf
  <input type="hidden" name="to" value="{{ $bit->user->id }}">
  <div class="">
    <div class="box-header with-border">
      <h3 class="box-title">Compose New Message</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="form-group">
        <input class="form-control" placeholder="To:" value="To: {{ $bit->user->name }}" readonly>
      </div>
      <div class="form-group">
          <textarea name="message" class="form-control @error('message') is-invalid @enderror" style="height: 250px" placeholder="Type your message" required></textarea>
          @error('message')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="pull-right">
        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
      </div>
      <button type="button" data-dismiss="modal"  class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
    </div>
    <!-- /.box-footer -->
  </div>
</form>
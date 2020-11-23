@extends('layouts.app')

@section('heading','Lawyers')
@section('content')

      <div class="row">

<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-aqua">
    <div class="inner">
      <h3>Tk {{ \App\Verification::whereMonth('created_at', date('m'))->count() * 500 }}</h3>

      <p>This monthly approve fee</p>
    </div>
    <div class="icon">
      <i class="fa fa-shopping-cart"></i>
    </div>
  </div>
</div>

<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-green">
    <div class="inner">
      <h3>Tk {{ \App\Verification::whereYear('created_at', date('Y')) ->count() * 500 }}</h3>

      <p>This year approve fee</p>
    </div>
    <div class="icon">
      <i class="fa fa-shopping-cart"></i>
    </div>
  </div>
</div>

<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-yellow">
    <div class="inner">
      <h3>Tk {{ \App\Milestone::whereMonth('created_at', date('m'))->sum('date') }}</h3>

      <p>This Monthly Lawyer income</p>
    </div>
    <div class="icon">
      <i class="fa fa-shopping-cart"></i>
    </div>
  </div>
</div>

<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-red">
    <div class="inner">
      <h3>Tk {{ \App\Milestone::whereYear('created_at', date('Y'))->sum('date') }}</h3>

      <p>This year Lawyer income</p>
    </div>
    <div class="icon">
      <i class="fa fa-shopping-cart"></i>
    </div>
  </div>
</div>


      </div>

@endsection

@section('js')

  <script>
    $(function () {
      $('#example1').DataTable()
    })
  </script>

@endsection
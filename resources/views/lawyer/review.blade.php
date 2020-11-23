@extends('layouts.app')

@section('heading','review')
@section('content')

<div class="row">

        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            @foreach(\App\Review::where('lowyer_id', auth()->user()->id)->get() as $review )
              <li class="time-label">
                    <span class="bg-red">
                      {{ $review->created_at->format('d M. Y') }}
                    </span>
              </li>
              <li>
                <i class="fa fa-comments bg-blue"></i>

                <div class="timeline-item">
                  <span class="time"><i class="fa fa-clock-o"></i> {{ $review->created_at->format('H:i:s') }}</span>

                  <h3 class="timeline-header"><a href="#">{{ $review->user->name }}</a> (Rating {{ renderStarRating($review->rating) }})</h3>

                  <div class="timeline-body">
                    {{ $review->comment }}
                  </div>
                </div>
              </li>
            @endforeach

          </ul>
        </div>

</div>
@endsection


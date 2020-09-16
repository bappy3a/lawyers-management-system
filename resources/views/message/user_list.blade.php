@if(Auth::user()->role == 'client')
	<div class="box-body no-padding">
	  <ul class="nav nav-pills nav-stacked">
	    @foreach(App\Message::where('user_id',Auth::user()->id)->latest()->get() as $message )
	      <li class="active">
	        <a href="{{ route('message.details',$message->id) }}"><i class="fa fa-trash-o"></i> {{ $message->lowyer->name }}</a>
	      </li>
	    @endforeach
	  </ul>
	</div>
@endif

@if(Auth::user()->role == 'lawyer')
	<div class="box-body no-padding">
	  <ul class="nav nav-pills nav-stacked">
	    @foreach(App\Message::where('lawyer_id',Auth::user()->id)->latest()->get() as $message )
	      <li class="active">
	        <a href="{{ route('message.details',$message->id) }}"><i class="fa fa-trash-o"></i> {{ $message->user->name }}</a>
	      </li>
	    @endforeach
	  </ul>
	</div>
@endif
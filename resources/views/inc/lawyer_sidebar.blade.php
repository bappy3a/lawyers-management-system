<li class="{{ Request::is('lawyer/dashboard') ? 'active' : '' }}">
	<a href="{{ route('lawyer.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
</li>
<li class="{{ Request::is('lawyer/post*') ? 'active' : '' }}">
	<a href="{{ route('lawyer.post') }}"><i class="fa fa-bank"></i> Job Post For Law</a>
</li>
<li class="{{ Request::is('message*') ? 'active' : '' }}">
	<a href="{{ route('message.index') }}"><i class="fa fa-envelope-o"></i>Message</a>
</li>
<li class="{{ Request::is('helppost*') ? 'active' : '' }}">
	<a href="{{ route('helppost.index') }}"><i class="fa fa-briefcase"></i>Help Post</a>
</li>
<li class="{{ Request::is('lawyer/hire*') ? 'active' : '' }}">
	<a href="{{ route('lawyer.hire') }}"><i class="fa fa-briefcase"></i>
		<span>Your Client Case</span>
		<span class="pull-right-container">
         	<span class="label label-primary pull-right">{{ App\Hare::where('lowyer_id',auth()->user()->id)->where('status','runing')->count() }}</span>
        </span>
	</a>
</li>

<li class="{{ Request::is('active/case*') ? 'active' : '' }}">
	<a href="{{ route('active.case') }}"><i class="fa fa-briefcase"></i>Active Case</a>
</li>
<li class="{{ Request::is('complete/case*') ? 'active' : '' }}">
	<a href="{{ route('complete.case') }}"><i class="fa fa-briefcase"></i>Complete Case</a>
</li>
<li class="{{ Request::is('lawyer/reviews') ? 'active' : '' }}">
	<a href="{{ route('lawyer.reviews') }}"><i class="fa fa-user-circle-o"></i>Customer Reviews</a>
</li>
<li class="{{ Request::is('support*') ? 'active' : '' }}">
	<a href="{{ route('support.show',auth()->user()->id) }}"><i class="fa fa-question-circle"></i>Support</a>
</li>
<li class="{{ Request::is('profile*') ? 'active' : '' }}">
	<a href="{{ route('profile') }}"><i class="fa fa-user-circle-o"></i>Your Account</a>
</li>
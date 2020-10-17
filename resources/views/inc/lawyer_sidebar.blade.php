<li class="{{ Request::is('lawyer/dashboard') ? 'active' : '' }}">
	<a href="{{ route('lawyer.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
</li>
<li class="{{ Request::is('lawyer/post*') ? 'active' : '' }}">
	<a href="{{ route('lawyer.post') }}"><i class="fa fa-bank"></i> Job Post For Law</a>
</li>
<li class="{{ Request::is('message*') ? 'active' : '' }}">
	<a href="{{ route('message.index') }}"><i class="fa fa-envelope-o"></i>Message</a>
</li>
<li class="{{ Request::is('profile*') ? 'active' : '' }}">
	<a href="{{ route('profile') }}"><i class="fa fa-user-circle-o"></i>Your Account</a>
</li>
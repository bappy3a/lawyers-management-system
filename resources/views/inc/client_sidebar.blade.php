<li class="{{ Request::is('client/dashboard') ? 'active' : '' }}">
	<a href="{{ route('client.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
</li>
<li class="{{ Request::is('client/find/lawyer*') ? 'active' : '' }}">
	<a href="{{ route('client.lawyer') }}"><i class="fa fa-user-secret"></i>Find Lawyers</a>
</li>
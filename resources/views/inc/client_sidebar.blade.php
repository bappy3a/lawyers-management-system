<li class="{{ Request::is('client/dashboard') ? 'active' : '' }}">
	<a href="{{ route('client.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
</li>
<li class="{{ Request::is('client/find/lawyer*') ? 'active' : '' }}">
	<a href="{{ route('client.lawyer') }}"><i class="fa fa-user-secret"></i>Find Lawyers</a>
</li>
<li class="{{ Request::is('client/post*') ? 'active' : '' }}">
	<a href="{{ route('post.index') }}"><i class="fa fa-briefcase"></i>Post Your Case</a>
</li>
<li class="{{ Request::is('client/case*') ? 'active' : '' }}">
	<a href="{{ route('case.index') }}"><i class="fa fa-briefcase"></i>Case</a>
</li>
<li class="{{ Request::is('hire*') ? 'active' : '' }}">
	<a href="{{ route('hire.index') }}"><i class="fa fa-user-circle"></i>Hire Lowyer</a>
</li>
<li class="{{ Request::is('message*') ? 'active' : '' }}">
	<a href="{{ route('message.index') }}"><i class="fa fa-envelope-o"></i>Message</a>
</li>
<li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
	<a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
</li>
<li class="{{ Request::is('admin/lawyer*') ? 'active' : '' }}">
	<a href="{{ route('admin.lawyer') }}"><i class="fa fa-user-secret"></i> Lawyers</a>
</li>
<li class="{{ Request::is('helppost*') ? 'active' : '' }}">
	<a href="{{ route('helppost.index') }}"><i class="fa fa-briefcase"></i>Help Post</a>
</li>























<li class="{{ Request::is('profile*') ? 'active' : '' }}">
	<a href="{{ route('profile') }}"><i class="fa fa-user-circle-o"></i>Your Account</a>
</li>
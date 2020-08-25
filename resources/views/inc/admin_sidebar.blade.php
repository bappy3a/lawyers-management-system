<li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
	<a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
</li>
<li class="{{ Request::is('admin/lawyer*') ? 'active' : '' }}">
	<a href="{{ route('admin.lawyer') }}"><i class="fa fa-user-secret"></i> Lawyers</a>
</li>
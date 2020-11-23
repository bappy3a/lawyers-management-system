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
<li class="{{ Request::is('active/case*') ? 'active' : '' }}">
	<a href="{{ route('active.case') }}"><i class="fa fa-briefcase"></i>Active Case</a>
</li>
<li class="{{ Request::is('complete/case*') ? 'active' : '' }}">
	<a href="{{ route('complete.case') }}"><i class="fa fa-briefcase"></i>Complete Case</a>
</li>
<li class="{{ Request::is('hire*') ? 'active' : '' }}">
	<a href="{{ route('hire.index') }}"><i class="fa fa-user-circle"></i>Hire Lowyer & Case Details</a>
</li>
<li class="{{ Request::is('helppost*') ? 'active' : '' }}">
	<a href="{{ route('helppost.index') }}"><i class="fa fa-briefcase"></i>Help Post</a>
</li>
<li class="{{ Request::is('message*') ? 'active' : '' }}">
	<a href="{{ route('message.index') }}"><i class="fa fa-envelope-o"></i>Message</a>
</li>
<li class="{{ Request::is('support*') ? 'active' : '' }}">
	<a href="{{ route('support.show',auth()->user()->id) }}"><i class="fa fa-question-circle"></i>Support</a>
</li>
<li class="{{ Request::is('profile*') ? 'active' : '' }}">
	<a href="{{ route('profile') }}"><i class="fa fa-user-circle-o"></i>Your Account</a>
</li>
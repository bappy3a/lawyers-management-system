<li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
	<a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
</li>
<li class="{{ Request::is('admin/lawyer*') ? 'active' : '' }}">
	<a href="{{ route('admin.lawyer') }}"><i class="fa fa-user-secret"></i> Lawyers</a>
</li>
<li class="{{ Request::is('admin/client*') ? 'active' : '' }}">
	<a href="{{ route('admin.client') }}"><i class="fa fa-user-secret"></i> Client</a>
</li>
<li class="{{ Request::is('helppost*') ? 'active' : '' }}">
	<a href="{{ route('helppost.index') }}"><i class="fa fa-briefcase"></i>Help Post</a>
</li>
<li class="{{ Request::is('verification*') ? 'active' : '' }}">
	<a href="{{ route('verification.index') }}"><i class="fa fa-certificate"></i>Verification Required</a>
</li>
<li class="{{ Request::is('admin/report*') ? 'active' : '' }} treeview">
  <a href="#">
    <i class="fa fa-question-circle"></i> <span>Report</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="{{ route('report.lawyer') }}"><i class="fa fa-circle-o"></i>Lawyer</a></li>
    <li><a href="{{ route('report.financial') }}"><i class="fa fa-circle-o"></i>Financial status </a></li>
    <li><a href="{{ route('report.case') }}"><i class="fa fa-circle-o"></i>Case Ctatus </a></li>
  </ul>
</li>
<li class="{{ Request::is('support*') ? 'active' : '' }}">
	<a href="{{ route('support.index') }}"><i class="fa fa-question-circle"></i>Support</a>
</li>
<li class="{{ Request::is('profile*') ? 'active' : '' }}">
	<a href="{{ route('profile') }}"><i class="fa fa-user-circle-o"></i>Your Account</a>
</li>
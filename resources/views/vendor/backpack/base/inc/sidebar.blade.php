@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <part class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="https://placehold.it/160x160/00a65a/ffffff/&text={{ mb_substr(Auth::user()->name, 0, 1) }}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">{{ trans('backpack::base.administration') }}</li>

          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/assessments') }}"><i class="fa fa-edit"></i>
              <span>Assessments</span></a>
          </li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/improvements') }}"><i class="fa fa-list-ol"></i>
              <span>Improvements</span></a>
          </li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/parts') }}"><i class="fa fa-folder-o"></i>
              <span>Parts</span></a>
          </li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/sections') }}"><i class="fa fa-align-left"></i>
              <span>Sections</span></a>
          </li>

          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/users') }}"><i class="fa fa-user"></i>
              <span>Users</span></a>
          </li>

          <!-- ======================================= -->
          <li class="header">{{ trans('backpack::base.user') }}</li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>
        </ul>
      </part>
      <!-- /.sidebar -->
    </aside>
@endif

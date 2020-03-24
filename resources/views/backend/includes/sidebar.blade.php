<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! access()->user()->picture !!}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{!! access()->user()->user_nick !!}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('strings.backend.general.search_placeholder') }}" value="{{ !empty($_GET['q'])?$_GET['q']:''}}"/>
                  <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.sidebar.general') }}</li>

            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Active::pattern('admin/dashboard') }}">
                <a href="{!! route('admin.dashboard') !!}"><span>{{ trans('menus.backend.sidebar.dashboard') }}</span></a>
            </li>

            @permission('view-access-management')
                <li class="{{ Active::pattern('admin/access/*') }}">
                    <a href="{!!url('admin/access/users')!!}"><span>{{ trans('menus.backend.access.title') }}</span></a>
                </li>
            @endauth

            @permission('view-report-management')
            <li class="{{ Active::pattern('admin/report/*') }}">
                <a href="{!!url('admin/report/reports')!!}"><span>{{ trans('menus.backend.report.title') }}</span></a>
            </li>
            @endauth

            @permission('view-wxconfig-management')
            <li class="{{ Active::pattern('admin/wxconfig/*') }}">
                <a href="{!!url('admin/wxconfig/wxconfigs')!!}"><span>{{ trans('menus.backend.wxconfig.title') }}</span></a>
            </li>
            @endauth

            <li class="{{ Active::pattern('admin/log-viewer*') }} {{ Active::pattern('admin/logs/*') }} treeview">
                <a href="#">
                    <span>{{ trans('menus.backend.log-viewer.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/log-viewer*', 'menu-open') }} {{ Active::pattern('admin/logs/*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/log-viewer*', 'display: block;') }}{{ Active::pattern('admin/logs*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/log-viewer') }}">
                        <a href="{!! url('admin/log-viewer') !!}">{{ trans('menus.backend.log-viewer.dashboard') }}</a>
                    </li>
                    <li class="{{ Active::pattern('admin/log-viewer/logs') }}">
                        <a href="{!! url('admin/log-viewer/logs') !!}">{{ trans('menus.backend.log-viewer.logs') }}</a>
                    </li>
                    <li class="{{ Active::pattern('admin/logs/report-send-logs') }}">
                        <a href="{!! url('admin/logs/report-send-logs') !!}">{{ trans('menus.backend.report.report-send-logs') }}</a>
                    </li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
    <div class="pull-right" style="margin-bottom:10px">
        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              {{ trans('menus.backend.report.reports.main') }} <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ route('admin.report.reports.index') }}">{{ trans('menus.backend.report.reports.all') }}</a></li>

            @permission('create-reports')
                <li><a href="{{ route('admin.report.reports.create') }}">{{ trans('menus.backend.report.reports.create') }}</a></li>
            @endauth

          </ul>
        </div><!--btn group-->

        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              {{ trans('menus.backend.report.groups.main') }} <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ route('admin.report.groups.index') }}">{{ trans('menus.backend.report.groups.all') }}</a></li>

            @permission('create-groups')
                <li><a href="{{ route('admin.report.groups.create') }}">{{ trans('menus.backend.report.groups.create') }}</a></li>
            @endauth
          </ul>
        </div><!--btn group-->

    </div><!--pull right-->

    <div class="clearfix"></div>

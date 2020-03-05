    <div class="pull-right" style="margin-bottom:10px">
        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              {{ trans('menus.backend.wxconfig.wxconfigs.main') }} <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ route('admin.wxconfig.wxconfigs.index') }}">{{ trans('menus.backend.wxconfig.wxconfigs.all') }}</a></li>

            @permission('create-wxconfigs')
                <li><a href="{{ route('admin.wxconfig.wxconfigs.create') }}">{{ trans('menus.backend.wxconfig.wxconfigs.create') }}</a></li>
            @endauth

          </ul>
        </div><!--btn group-->

        {{--<div class="btn-group">--}}
          {{--<button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">--}}
              {{--{{ trans('menus.backend.wxconfig.groups.main') }} <span class="caret"></span>--}}
          {{--</button>--}}
          {{--<ul class="dropdown-menu" role="menu">--}}
            {{--<li><a href="{{ route('admin.wxconfig.groups.index') }}">{{ trans('menus.backend.wxconfig.groups.all') }}</a></li>--}}

            {{--@permission('create-groups')--}}
                {{--<li><a href="{{ route('admin.wxconfig.groups.create') }}">{{ trans('menus.backend.wxconfig.groups.create') }}</a></li>--}}
            {{--@endauth--}}
          {{--</ul>--}}
        {{--</div><!--btn group-->--}}

    </div><!--pull right-->

    <div class="clearfix"></div>

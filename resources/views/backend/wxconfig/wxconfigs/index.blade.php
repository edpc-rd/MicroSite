@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.wxconfig.wxconfigs.management'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.wxconfig.wxconfigs.management') }}
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.wxconfig.wxconfigs.management') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.wxconfig.includes.partials.header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover font-size:12px">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.backend.wxconfig.wxconfigs.table.id') }}</th>
                        <th>{{ trans('labels.backend.wxconfig.wxconfigs.table.name') }}</th>
                        <th>{{ trans('labels.backend.wxconfig.wxconfigs.table.appid') }}</th>
                        <th>{{ trans('labels.backend.wxconfig.wxconfigs.table.agentid') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.wxconfig.wxconfigs.table.updated') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($wxconfigs as $wxconfig)
                        <tr>
                            <td>{!! $wxconfig->id !!}</td>
                            <td>{!! $wxconfig->name !!}</td>
                            <td>{!! $wxconfig->appid !!}</td>
                            <td>{!! $wxconfig->agentid !!}</td>
                            <td class="visible-lg">{!! $wxconfig->updated_at->toDateString() !!}</td>
                            <td>{!! $wxconfig->action_buttons !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pull-left">
                {!! $wxconfigs->total() !!} {{ trans_choice('labels.backend.wxconfig.wxconfigs.table.total', $wxconfigs->total()) }}
            </div>

            <div class="pull-right">
                {!! $wxconfigs->render() !!}
            </div>

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
@stop
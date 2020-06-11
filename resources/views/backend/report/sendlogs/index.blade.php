@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.report.logs.management'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.report.logs.management') }}
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.report.logs.management') }}</h3>

            {{--<div class="box-tools pull-right">--}}
                {{--@include('backend.report.includes.partials.header-buttons')--}}
            {{--</div>--}}
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover font-size:12px">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.backend.report.logs.table.id') }}</th>
                        <th>{{ trans('labels.backend.report.logs.table.report_id') }}</th>
                        <th>{{ trans('labels.backend.report.logs.table.report_name') }}</th>
                        <th>{{ trans('labels.backend.report.logs.table.send_id') }}</th>
                        <th>{{ trans('labels.backend.report.logs.table.wxid') }}</th>
                        <th>{{ trans('labels.backend.report.logs.table.status') }}</th>
                        <th>{{ trans('labels.backend.report.logs.table.message') }}</th>
                        {{--<th>{{ trans('labels.backend.report.logs.table.schedule') }}</th>--}}
                        {{--<th>{{ trans('labels.backend.report.logs.table.allow_subscribe') }}</th>--}}
                        {{--<th>{{ trans('labels.backend.report.logs.table.allow_query') }}</th>--}}
                        {{--<th>{{ trans('labels.backend.report.logs.table.receive_mode') }}</th>--}}
                        {{--<th>{{ trans('labels.backend.report.logs.table.query_url') }}</th>--}}
                        {{--<th>{{ trans('labels.backend.report.logs.table.status') }}</th>--}}
                        <th class="visible-lg">{{ trans('labels.backend.report.logs.table.updated') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($logs as $report)
                        <tr>
                            <td>{!! $report->id !!}</td>
                            <td>{!! $report->report_id !!}</td>
                            <td>{!! $report->report->name !!}</td>
                            <td>{!! $report->send_id !!}</td>
                            <td>{!! $report->wx_name !!}</td>
                            <td>{!! $report->status_code !!}</td>
                            <td>{!! $report->message !!}</td>
                            {{--<td>{!! $report->schedule !!}</td>--}}
                            {{--<td>{!! $report->allow_subscribe_label !!}</td>--}}
                            {{--<td>{!! $report->allow_query_label !!}</td>--}}
                            {{--<td>{!! $report->receive_mode !!}</td>--}}
                            {{--<td>{!! $report->query_url !!}</td>--}}
                            {{--<td>{!! $report->status_label !!}</td>--}}
                            <td class="visible-lg">{!! $report->updated_at->toDateTimeString() !!}</td>
                            <td>{!! $report->action_buttons !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pull-left">
                {!! $logs->total() !!} {{ trans_choice('labels.backend.report.reports.table.total', $logs->total()) }}
            </div>

            <div class="pull-right">
                {!! $logs->render() !!}
            </div>

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
@stop
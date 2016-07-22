@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.report.reports.management'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.report.reports.management') }}
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.report.reports.management') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.report.includes.partials.header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover font-size:12px">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.backend.report.reports.table.report_id') }}</th>
                        <th>{{ trans('labels.backend.report.reports.table.report_no') }}</th>
                        <th>{{ trans('labels.backend.report.reports.table.name') }}</th>
                        <th>{{ trans('labels.backend.report.reports.table.group') }}</th>
                        <th>{{ trans('labels.backend.report.reports.table.format') }}</th>
                        <th>{{ trans('labels.backend.report.reports.table.schedule') }}</th>
                        <th>{{ trans('labels.backend.report.reports.table.allow_subscribe') }}</th>
                        <th>{{ trans('labels.backend.report.reports.table.allow_query') }}</th>
                        <th>{{ trans('labels.backend.report.reports.table.receive_mode') }}</th>
                        <th>{{ trans('labels.backend.report.reports.table.query_url') }}</th>
                        <th>{{ trans('labels.backend.report.reports.table.status') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.report.reports.table.updated') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td>{!! $report->report_id !!}</td>
                            <td>{!! $report->report_no !!}</td>
                            <td>{!! $report->name !!}</td>
                            <td>
                                @if ($report->group)
                                    {!! $report->group->name !!}
                                @else
                                    <!--{{ trans('labels.general.none') }} -->
                                @endif
                            </td>
                            <td>{!! $report->format !!}</td>
                            <td>{!! $report->schedule !!}</td>
                            <td>{!! $report->allow_subscribe_label !!}</td>
                            <td>{!! $report->allow_query_label !!}</td>
                            <td>{!! $report->receive_mode !!}</td>
                            <td>{!! $report->query_url !!}</td>
                            <td>{!! $report->status_label !!}</td>
                            <td class="visible-lg">{!! $report->updated_at->toDateString() !!}</td>
                            <td>{!! $report->action_buttons !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pull-left">
                {!! $reports->total() !!} {{ trans_choice('labels.backend.report.reports.table.total', $reports->total()) }}
            </div>

            <div class="pull-right">
                {!! $reports->render() !!}
            </div>

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
@stop
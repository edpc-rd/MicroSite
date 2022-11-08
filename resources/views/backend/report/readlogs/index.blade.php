@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.report.logs.reportread'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.report.logs.reportread') }}
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.report.logs.reportread') }}</h3>

            <div class="box-tools pull-right">
                <div class="pull-right" style="margin-bottom:10px">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            {{ trans('menus.backend.report.reports.main') }} <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('admin.logs.report-read-logs.index',['explode' => 1]) }}">{{ trans('labels.backend.report.logs.table.explode') }}</a></li>
                        </ul>
                    </div><!--btn group-->
                </div><!--pull right-->

                <div class="clearfix"></div>
            </div>
        </div><!-- /.box-header -->
        <form action="#" method="get" class="btn-primary">
            <div class="input-group">
                {{--<input type="date" name="start" class="form-control" placeholder="{{ trans('strings.backend.general.search_placeholder_nick') }}" value="{{ !empty($_GET['start'])?$_GET['start']:''}}"/>--}}

                <input type="date" name="start" style="color: #555555;padding-top: 0;padding-bottom: 0" class="form-control-static col-lg-6"  value="{{ !empty($_GET['start'])?$_GET['start']:''}}"/>
                <input type="date" name="end" style="color: #555555;padding-top: 0;padding-bottom: 0" class="form-control-static col-lg-6"  value="{{ !empty($_GET['end'])?$_GET['end']:''}}"/>

                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class=" form-control-static btn btn-flat"><i class="fa fa-search"></i></button>
                  </span>
            </div>
        </form>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover font-size:12px">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.backend.report.logs.table.id') }}</th>
                        <th>{{ trans('labels.backend.report.logs.table.report_id') }}</th>
                        <th>{{ trans('labels.backend.report.logs.table.report_name') }}</th>
                        <th>{{ trans('labels.backend.report.logs.table.user_name') }}</th>
                        <th>{{ trans('labels.backend.report.logs.table.action') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.report.logs.table.created') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($reads as $report)
                        <tr>
                            <td>{!! $report->id !!}</td>
                            <td>{!! $report->report_id !!}</td>
                            <td>{!! $report->report->name !!}</td>
                            <td>{!! $report->user_name !!}</td>
                            <td>{!! $report->action !!}</td>
                            <td class="visible-lg">{!! $report->created_at->toDateTimeString() !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pull-left">
                {!! $reads->total() !!} {{ trans_choice('labels.backend.report.reports.table.total', $reads->total()) }}
            </div>

            <div class="pull-right">
                {!! $reads->render() !!}
            </div>

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
@stop
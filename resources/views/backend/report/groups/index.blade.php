@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.report.groups.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.report.groups.management') }}</h1>
@endsection

@section('after-styles-end')
    {!! Html::style('css/backend/plugin/nestable/jquery.nestable.css') !!}
@stop

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.report.groups.management') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.report.includes.partials.header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#groups" aria-controls="groups" role="tab" data-toggle="tab">
                            {{ trans('labels.backend.report.reports.tabs.groups') }}
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="groups" style="padding-top:20px">

                        <div class="row">
                            <div class="col-lg-6">

                                <div class="alert alert-info">
                                    <i class="fa fa-info-circle"></i> {{ trans('strings.backend.report.groups.sort_explanation') }}
                                </div><!--alert info-->

                                <div class="dd permission-hierarchy">
                                    <ol class="dd-list">
                                        @foreach ($groups as $group)
                                            <li class="dd-item" data-id="{!! $group->group_id !!}">
                                                    <div class="dd-handle">{!! $group->name !!} <span class="pull-right">{!! $group->reports->count() !!} {{ trans('labels.backend.report.reports.label') }}</span></div>

                                                    @if ($group->children->count())
                                                        <ol class="dd-list">
                                                            @foreach($group->children as $child)
                                                                <li class="dd-item" data-id="{!! $child->group_id !!}">
                                                                    <div class="dd-handle">{!! $child->name !!} <span class="pull-right">{!! $child->reports->count() !!} {{ trans('labels.backend.report.reports.label') }}</span></div>
                                                                </li>
                                                            @endforeach
                                                        </ol>
                                                </li>
                                            @else
                                                </li>
                                            @endif
                                        @endforeach
                                    </ol>
                                </div><!--master-list-->
                            </div><!--col-lg-4-->

                            <div class="col-lg-6">

                                <div class="alert alert-info">
                                    <i class="fa fa-info-circle"></i> {{ trans('strings.backend.report.groups.edit_explanation') }}
                                </div><!--alert info-->

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>{{ trans('labels.backend.report.groups.table.name') }}</th>
                                            <th>{{ trans('labels.general.actions') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($groups as $group)
                                            <tr>
                                                <td>
                                                    {!! $group->name !!}

                                                    @if ($group->reports->count())
                                                        <div style="padding-left:40px;font-size:.8em">
                                                            @foreach ($group->reports as $report)
                                                                {!! $report->report_no !!}<br/>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>{!! $group->action_buttons !!}</td>
                                            </tr>

                                            @if ($group->children->count())
                                                @foreach ($group->children as $child)
                                                    <tr>
                                                        <td style="padding-left:40px">
                                                            <em>{!! $child->name !!}</em>

                                                            @if ($child->reports->count())
                                                                <div style="padding-left:40px;font-size:.8em">
                                                                    @foreach ($child->reports as $report)
                                                                        {!! $report->report_no !!}<br/>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>{!! $child->action_buttons !!}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div><!--col-lg-8-->
                        </div><!--row-->

                    </div><!--groups-->
                </div>
            </div><!--permission tabs-->
        </div><!-- /.box-body -->
    </div><!--box-->
@stop

@section('after-scripts-end')
    {!! Html::script('js/backend/plugin/nestable/jquery.nestable.js') !!}

    <script>
        $(function() {

            var hierarchy = $('.permission-hierarchy');
            hierarchy.nestable({maxDepth:2});

            hierarchy.on('change', function() {
                @permission('sort-report-groups')
                    $.ajax({
                        url : "{!! route('admin.report.groups.update-sort') !!}",
                        type: "post",
                        data : {data:hierarchy.nestable('serialize')},
                        success: function(data) {
                            if (data.status == "OK")
                                toastr.success("{!! trans('strings.backend.report.groups.hierarchy_saved') !!}");
                            else
                                toastr.error("{!! trans('auth.unknown') !!}.");
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            toastr.error("{!! trans('auth.unknown') !!}: " + errorThrown);
                        }
                    });
                @else
                    toastr.error("{!! trans('auth.general_error') !!}");
                @endauth
            });
        });
    </script>
@stop

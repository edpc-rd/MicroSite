@inject('subscriptions', 'App\Repositories\Backend\User\Subscription\UserSubscriptionRepositoryContract')

@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.access.users.management'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.users.management') }}
        <small>{{ trans('labels.backend.access.users.subscription') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.access.users.subscription') }} {!! ' ' . $user->user_nick !!}</h3>

            <div class="box-tools pull-right">
                @include('backend.access.includes.partials.header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover font-size:12px">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.backend.access.users.subscriptions.table.report_id') }}</th>
                        <th>{{ trans('labels.backend.access.users.subscriptions.table.report_no') }}</th>
                        <th>{{ trans('labels.backend.access.users.subscriptions.table.name') }}</th>
                        <th>{{ trans('labels.backend.access.users.subscriptions.table.group') }}</th>
                        <th>{{ trans('labels.backend.access.users.subscriptions.table.format') }}</th>
                        <th>{{ trans('labels.backend.access.users.subscriptions.table.allow_subscribe') }}</th>
                        <th>{{ trans('labels.backend.access.users.subscriptions.table.subscribe_status') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.subscriptions.table.subscribe_time') }}</th>
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
                            <td>
                                @if($subscription = $subscriptions->findByUserAndReport($user->user_id,$report->report_id))
                                    {!! "<label class='label label-info'>".trans('labels.general.yes')."</label>" !!}
                                @else
                                    {!! "<label class='label label-danger'>".trans('labels.general.no')."</label>" !!}
                                @endif
                            </td>
                            <td>
                                @if($subscription)
                                    {!! $subscription->status_label !!}
                                @else
                                    {!! "<label class='label label-danger'>".trans('labels.general.no')."</label>" !!}
                                @endif
                            </td>
                            <td class="visible-lg">
                                @if(isset($subscription->subscribe_time))
                                    {!! $subscription->subscribe_time->toDateString() !!}
                                @else
                                    {{ trans('labels.general.none') }}
                                @endif
                            </td>
                            <td>
                                @if($subscription)
                                    {!! $subscription->action_buttons !!}
                                @else
                                    {!! $subscriptions->getActionButtons($report->report_id,$user->user_id) !!}
                                @endif
                            </td>
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
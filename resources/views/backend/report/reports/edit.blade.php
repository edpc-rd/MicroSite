@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.report.reports.management') . ' | ' . trans('labels.backend.report.reports.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.report.reports.management') }}
        <small>{{ trans('labels.backend.report.reports.edit') }}</small>
    </h1>
@endsection

@section('content')
    {!! Form::model($report, ['route' => ['admin.report.reports.update', $report->report_id], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) !!}

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.report.reports.edit') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.report.includes.partials.header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">

            <div class="form-group">
                {!! Form::label('group_id', trans('validation.attributes.backend.report.reports.group'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <select name="group_id" class="form-control">
                        <option value="">{{ trans('labels.general.none') }}</option>
                        @foreach ($groups as $group)
                            <option value="{!! $group->group_id !!}" {!! $report->group_id == $group->group_id ? 'selected' : '' !!}>{!! $group->name !!}</option>
                        @endforeach
                    </select>
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('report_no', trans('validation.attributes.backend.report.reports.report_no'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('report_no', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.report.reports.report_no')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('name', trans('validation.attributes.backend.report.reports.name'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.report.reports.name')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('format', trans('validation.attributes.backend.report.reports.format'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <select name="format" class="form-control">
                        <option value='MPNEWS' {!! $report->format == 'MPNEWS' ? 'selected' : '' !!}> MPNEWS</option>
                        <option value='IMAGE' {!! $report->format == 'IMAGE' ? 'selected' : '' !!}> IMAGE</option>
                        <option value='TEXT' {!! $report->format == 'TEXT' ? 'selected' : '' !!}> TEXT</option>
                        <option value='FILE' {!! $report->format == 'FILE' ? 'selected' : '' !!}> FILE</option>
                    </select>
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('schedule', trans('validation.attributes.backend.report.reports.schedule'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('schedule', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.report.reports.schedule')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('allow_subscribe', trans('validation.attributes.backend.report.reports.allow_subscribe'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <select name="allow_subscribe" class="form-control">
                        <option value='false' {!! $report->allow_subscribe == 'false' ? 'selected' : '' !!}> 否</option>
                        <option value='true' {!! $report->allow_subscribe == 'true' ? 'selected' : '' !!}> 是</option>
                    </select>
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('allow_query', trans('validation.attributes.backend.report.reports.allow_query'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <select name="allow_query" class="form-control">
                        <option value='false' {!! $report->allow_query == 'false' ? 'selected' : '' !!}> 否</option>
                        <option value='true' {!! $report->allow_query == 'true' ? 'selected' : '' !!}> 是</option>
                    </select>
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('receive_mode', trans('validation.attributes.backend.report.reports.receive_mode'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <select name="receive_mode" class="form-control">
                        <option value='wechat' {!! $report->receive_mode == 'wechat' ? 'selected' : '' !!}> 微信</option>
                        <option value='email' {!! $report->receive_mode == 'email' ? 'selected' : '' !!}> 郵件</option>
                    </select>
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('query_url', trans('validation.attributes.backend.report.reports.query_url'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('query_url', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.report.reports.query_url')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('description', trans('validation.attributes.backend.report.reports.description'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.report.reports.description')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('status', trans('validation.attributes.backend.report.reports.status'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <select name="status" class="form-control">
                        <option value=0 {!! $report->status == 0 ? 'selected' : '' !!}> 禁用</option>
                        <option value=1 {!! $report->status == 1 ? 'selected' : '' !!}> 啟用</option>
                    </select>
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('send_wxid', trans('validation.attributes.backend.access.users.send_wxid'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <select name="send_wxid" class="form-control">
                        <option value='0' {!! 0  == $report->send_wxid ? 'selected' : '' !!}> 無 </option>
                        @foreach ($wx_config as $wx)
                            <option value='{{$wx->id}}' {!! $wx->id == $report->send_wxid ? 'selected' : '' !!}> {{$wx->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div><!--form control-->

        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-success">
        <div class="box-body">
            <div class="pull-left">
                <a href="{{route('admin.report.reports.index')}}"
                   class="btn btn-danger btn-xs">{{ trans('buttons.general.cancel') }}</a>
            </div>

            <div class="pull-right">
                <input type="submit" class="btn btn-success btn-xs" value="{{ trans('buttons.general.crud.update') }}"/>
            </div>
            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->

    {!! Form::close() !!}
@stop

@section('after-scripts-end')
    {!! Html::script('js/backend/access/permissions/script.js') !!}
    {!! Html::script('js/backend/access/users/script.js') !!}
@stop

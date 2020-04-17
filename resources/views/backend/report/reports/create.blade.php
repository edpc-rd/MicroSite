@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.report.reports.management') . ' | ' . trans('labels.backend.report.reports.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.report.reports.management') }}
        <small>{{ trans('labels.backend.report.reports.create') }}</small>
    </h1>
@endsection

@section('content')
    {!! Form::open(['route' => 'admin.report.reports.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!}

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.report.reports.create') }}</h3>

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
                            <option value="{!! $group->group_id !!}">{!! $group->name !!}</option>
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
                        <option value='MPNEWS'> MPNEWS</option>
                        <option value='IMAGE'> IMAGE</option>
                        <option value='TEXT'> TEXT</option>
                        <option value='FILE'> FILE</option>
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
                        <option value='false'> 否</option>
                        <option value='true'> 是</option>
                    </select>
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('allow_query', trans('validation.attributes.backend.report.reports.allow_query'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <select name="allow_query" class="form-control">
                        <option value='false'> 否</option>
                        <option value='true'> 是</option>
                    </select>
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('receive_mode', trans('validation.attributes.backend.report.reports.receive_mode'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <select name="receive_mode" class="form-control">
                        <option value='wechat'> 微信</option>
                        <option value='email'> 郵件</option>
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
                        <option value=0> 禁用</option>
                        <option value=1> 啟用</option>
                    </select>
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('send_wxid', trans('validation.attributes.backend.access.users.send_wxid'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <select name="send_wxid" class="form-control">
                        <option value='0' selected> 無 </option>
                        @foreach ($wx_config as $wx)
                            <option value='{{$wx->id}}'> {{$wx->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div><!--form control-->

        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-info">
        <div class="box-body">
            <div class="pull-left">
                <a href="{{route('admin.report.reports.index')}}"
                   class="btn btn-danger btn-xs">{{ trans('buttons.general.cancel') }}</a>
            </div>

            <div class="pull-right">
                <input type="submit" class="btn btn-success btn-xs" value="{{ trans('buttons.general.crud.create') }}"/>
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


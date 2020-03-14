@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.wxconfig.wxconfigs.management') . ' | ' . trans('labels.backend.wxconfig.wxconfigs.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.wxconfig.wxconfigs.management') }}
        <small>{{ trans('labels.backend.wxconfig.wxconfigs.edit') }}</small>
    </h1>
@endsection

@section('content')
    {!! Form::model($wxconfig, ['route' => ['admin.wxconfig.wxconfigs.update', $wxconfig->id], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH','files' => true]) !!}

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.wxconfig.wxconfigs.edit') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.wxconfig.includes.partials.header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            {{--<div class="form-group">--}}
                {{--{!! Form::label('id', trans('validation.attributes.backend.wxconfig.wxconfigs.id'), ['class' => 'col-lg-2 control-label']) !!}--}}
                {{--<div class="col-lg-10">--}}
                    {{--{!! Form::text('id', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.wxconfig.wxconfigs.id')]) !!}--}}
                {{--</div>--}}
            {{--</div><!--form control-->--}}
            <div class="form-group">
                {!! Form::label('id', trans('validation.attributes.backend.wxconfig.wxconfigs.id'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('id', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.wxconfig.wxconfigs.id'),'disabled' => true]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('name', trans('validation.attributes.backend.wxconfig.wxconfigs.name'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.wxconfig.wxconfigs.name')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('appid', trans('validation.attributes.backend.wxconfig.wxconfigs.appid'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('appid', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.wxconfig.wxconfigs.appid')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('appsecret', trans('validation.attributes.backend.wxconfig.wxconfigs.appsecret'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('appsecret', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.wxconfig.wxconfigs.appsecret')]) !!}
                </div>
            </div><!--form control-->


            <div class="form-group">
                {!! Form::label('agentid', trans('validation.attributes.backend.wxconfig.wxconfigs.agentid'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('agentid', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.wxconfig.wxconfigs.agentid')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('token', trans('validation.attributes.backend.wxconfig.wxconfigs.token'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('token', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.wxconfig.wxconfigs.token')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('aeskey', trans('validation.attributes.backend.wxconfig.wxconfigs.aeskey'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('aeskey', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.wxconfig.wxconfigs.aeskey')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('check', trans('validation.attributes.backend.wxconfig.wxconfigs.check'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10" style="padding-top:7px;">
                    <a href="{{route('admin.wxconfig.wxconfig.check', $wxconfig->id)}}"
                       data-method="post"
                       data-trans-button-cancel="{{trans('buttons.general.cancel')}}"
                       data-trans-button-confirm="{{trans('buttons.general.crud.check')}}"
                       data-trans-title="{{trans('strings.backend.general.are_you_sure')}}"
                       class="btn btn-xs btn-warning">{{trans('buttons.backend.wxconfig.wxconfig.check')}}</a>
                    <br /><span style="color: red">保存後在檢測</span>
                </div>

            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('file', trans('validation.attributes.backend.wxconfig.wxconfigs.upload'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10" style="padding-top:5px;">
                    {!! Form::file('file', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.wxconfig.wxconfigs.upload')]) !!}
                </div>
            </div><!--form control-->

        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-success">
        <div class="box-body">
            <div class="pull-left">
                <a href="{{route('admin.wxconfig.wxconfigs.index')}}"
                   class="btn btn-danger btn-xs">{{ trans('buttons.general.back') }}</a>
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

@extends('frontend.layouts.master')

@section('content')
    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('labels.frontend.auth.register_box_title') }}</div>

                <div class="panel-body">

                    {!! Form::open(['url' => 'register', 'class' => 'form-horizontal']) !!}

                    <div class="form-group">
                        {!! Form::label('user_name', trans('validation.attributes.frontend.name'), ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::input('user_name', 'user_name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.name')]) !!}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {!! Form::label('user_nick', trans('validation.attributes.frontend.nick'), ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::input('user_nick', 'user_nick', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.nick')]) !!}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {!! Form::label('weixin_id', trans('validation.attributes.frontend.weixin_id'), ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::input('weixin_id', 'weixin_id', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.weixin_id')]) !!}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {!! Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) !!}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {!! Form::label('password', trans('validation.attributes.frontend.password'), ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password')]) !!}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {!! Form::label('password_confirmation', trans('validation.attributes.frontend.password_confirmation'), ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password_confirmation')]) !!}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    {{--<div class="form-group">
                         {!! Form::label('captcha', trans('validation.attributes.frontend.captcha'), ['class' => 'col-md-4 control-label']) !!}
                         <div class="col-md-6">
                             {!! app('captcha')->display() !!}
                         </div>
                     </div>--}}


                    <div class="form-group">
                        {!! Form::label('captcha', trans('validation.attributes.frontend.captcha'), ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-3">
                            {!! Form::input('text', 'captcha', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.captcha')]) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Captcha::img() !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            {!! Form::submit(trans('labels.frontend.auth.register_button'), ['class' => 'btn btn-primary']) !!}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    {!! Form::close() !!}

                </div><!-- panel body -->

            </div><!-- panel -->

        </div><!-- col-md-8 -->

    </div><!-- row -->
@endsection
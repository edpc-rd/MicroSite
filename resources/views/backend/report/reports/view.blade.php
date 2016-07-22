@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.wineSale.orders.management') . ' | ' . trans('labels.backend.wineSale.orders.view'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.wineSale.orders.management') }}
        <small>{{ trans('labels.backend.wineSale.orders.view') }}</small>
    </h1>
@endsection

@section('content')
    {!! Form::model($order, ['class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) !!}
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.wineSale.orders.view') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.wineSale.includes.partials.header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">

            <div class="form-group">
                {!! Form::label('developer', trans('validation.attributes.backend.wineSale.orders.developer'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <select name="developer" class="form-control" >
                        @foreach ($users as $user)
                            @if($order->developer == $user->user_id)
                            <option value="{!! $user->user_id !!}" {!! 'selected' !!}>{!! $user->user_name !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('store_id', trans('validation.attributes.backend.wineSale.orders.store_id'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <select name="store_id" class="form-control">
                        @foreach ($stores as $store)
                            @if($order->store_id == $store->store_id)
                                <option value="{!! $store->store_id !!}" {!! 'selected' !!}>{!! $store->store_name !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('type_id', trans('validation.attributes.backend.wineSale.orders.type_id'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <select name="type_id" class="form-control">
                        @foreach ($types as $type)
                            @if($order->type_id == $type->type_id)
                                <option value="{!! $type->type_id !!}" {!! 'selected' !!}>{!! $type->type_name  !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('bnd_id', trans('validation.attributes.backend.wineSale.orders.bnd_id'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <select name="bnd_id" class="form-control">
                        @foreach ($brands as $brand)
                            @if($order->bnd_id == $brand->bnd_id)
                                <option value="{!! $brand->bnd_id !!}" {!! 'selected' !!}>{!! $brand->bnd_name  !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('product_name', trans('validation.attributes.backend.wineSale.orders.product_name'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('product_name', null, ['readonly'=>'true','class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.wineSale.orders.product_name')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('qty', trans('validation.attributes.backend.wineSale.orders.qty'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('qty', null, ['readonly'=>'true','class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.wineSale.orders.qty')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('unit', trans('validation.attributes.backend.wineSale.orders.unit'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('unit', null, ['readonly'=>'true','class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.wineSale.orders.unit')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('price', trans('validation.attributes.backend.wineSale.orders.price'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('price', null, ['readonly'=>'true','class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.wineSale.orders.price')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('amount', trans('validation.attributes.backend.wineSale.orders.amount'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('amount', null, ['readonly'=>'true','class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.wineSale.orders.amount')]) !!}
                </div>

            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('amount_real', trans('validation.attributes.backend.wineSale.orders.amount_real'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('amount_real', null, ['readonly'=>'true','class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.wineSale.orders.amount_real')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('accounted_mode', trans('validation.attributes.backend.wineSale.orders.accounted_mode'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <select name="accounted_mode" class="form-control">
                        @if($order->accounted_mode == '现金')
                            <option value="现金" {!! 'selected' !!}> 现金</option>
                        @else
                            <option value="普通铺货" {!! 'selected' !!}> 普通铺货</option>
                        @endif
                    </select>
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('materials_1', trans('validation.attributes.backend.wineSale.orders.materials_1'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('materials_1', null, ['readonly'=>'true','class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.wineSale.orders.materials_1')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('materials_2', trans('validation.attributes.backend.wineSale.orders.materials_2'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('materials_2', null, ['readonly'=>'true','class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.wineSale.orders.materials_2')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('materials_3', trans('validation.attributes.backend.wineSale.orders.materials_3'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('materials_3', null, ['readonly'=>'true','class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.wineSale.orders.materials_3')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('remark', trans('validation.attributes.backend.wineSale.orders.remark'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('remark', null, ['readonly'=>'true','class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.wineSale.orders.remark')]) !!}
                </div>
            </div><!--form control-->

        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-success">
        <div class="box-body">

        </div><!-- /.box-body -->
    </div><!--box-->

    {!! Form::close() !!}
@stop

@section('after-scripts-end')
    {!! Html::script('js/backend/access/permissions/script.js') !!}
    {!! Html::script('js/backend/access/users/script.js') !!}
@stop

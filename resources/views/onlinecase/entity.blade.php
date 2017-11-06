@extends('layouts.app')

@section('content')

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="/onlinecases">列表</a> &gt; <i class="fa fa-plus"></i> {{ $case->id == 0 ? '添加' : '编辑' }}
        </div>
        <div class="panel-body">
            <!-- 显示验证错误 -->
            @include('common.errors')
            
            <!-- 新建编辑的表单II -->
            {{ Form::open(['url' => '/onlinecase', 'class' => 'form-horizontal form-inline', 'name' => 'mainForm']) }}
                {{ Form::hidden('id', $case->id) }}
                
                <div class="row">
                    <div class="form-group col-md-4{{ $errors->has('shop_code') ? ' has-error' : '' }}">
                        {{ Form::label('shop_code', '商户号', ['class' => 'control-label col-md-4']) }}
                        {{ Form::number('shop_code', $case->shop_code, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('shop_name') ? ' has-error' : '' }}">
                        {{ Form::label('shop_name', '商户名', ['class' => 'control-label col-md-4']) }}
                        {{ Form::text('shop_name', $case->shop_name, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('terminal_code') ? ' has-error' : '' }}">
                        {{ Form::label('terminal_code', '终端号', ['class' => 'control-label col-md-4']) }}
                        {{ Form::number('terminal_code', $case->terminal_code, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('institute_category') ? ' has-error' : '' }}">
                        {{ Form::label('institute_category', '机构小类', ['class' => 'control-label col-md-4']) }}
                        {{ Form::text('institute_category', $case->institute_category, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('profit_institute') ? ' has-error' : '' }}">
                        {{ Form::label('profit_institute', '分润机构', ['class' => 'control-label col-md-4']) }}
                        {{ Form::text('profit_institute', $case->profit_institute, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('do') ? ' has-error' : '' }}">
                        {{ Form::label('do', '是否DO', ['class' => 'control-label col-md-4']) }}
                        {{ Form::select('do', ['' => '无', '是' => '是', '否' => '否'], $case->do, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('case_date') ? ' has-error' : '' }}">
                        {{ Form::label('case_date', '报案日期', ['class' => 'control-label col-md-4']) }}
                        {{ Form::date('case_date', $case->case_date, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('transaction_date') ? ' has-error' : '' }}">
                        {{ Form::label('transaction_date', '交易日期', ['class' => 'control-label col-md-4']) }}
                        {{ Form::date('transaction_date', $case->transaction_date, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('cheat_money') ? ' has-error' : '' }}">
                        {{ Form::label('cheat_money', '投诉金额', ['class' => 'control-label col-md-4']) }}
                        {{ Form::text('cheat_money', $case->cheat_money, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('freeze_money') ? ' has-error' : '' }}">
                        {{ Form::label('freeze_money', '冻结金额', ['class' => 'control-label col-md-4']) }}
                        {{ Form::text('freeze_money', $case->freeze_money, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('transfer_money') ? ' has-error' : '' }}">
                        {{ Form::label('transfer_money', '划款成功金额', ['class' => 'control-label col-md-4']) }}
                        {{ Form::text('transfer_money', $case->transfer_money, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('case_from') ? ' has-error' : '' }}">
                        {{ Form::label('case_from', '案件来源', ['class' => 'control-label col-md-4']) }}
                        {{ Form::select('case_from', ['' => '无', '银行' => '银行', '支付宝' => '支付宝', '微信' => '微信', '客服' => '客服', '监控' => '监控', 'other' => '其他'], $case->case_from, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('scan_category') ? ' has-error' : '' }}">
                        {{ Form::label('scan_category', '扫码类别', ['class' => 'control-label col-md-4']) }}
                        {{ Form::select('scan_category', ['' => '无', 'Q码+扫码' => 'Q码+扫码', '扫码支付' => '扫码支付', '平台扫码ws' => '平台扫码ws', '平台扫码lkl' => '平台扫码lkl'], $case->scan_category, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('trigger_rule') ? ' has-error' : '' }}">
                        {{ Form::label('trigger_rule', '是否触发规则', ['class' => 'control-label col-md-4']) }}
                        {{ Form::select('trigger_rule', ['' => '无', '是' => '是', '否' => '否'], $case->trigger_rule, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('close') ? ' has-error' : '' }}">
                        {{ Form::label('close', '是否关闭', ['class' => 'control-label col-md-4']) }}
                        {{ Form::select('close', ['' => '无', '是' => '是', '否' => '否'], $case->close, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('complainant') ? ' has-error' : '' }}">
                        {{ Form::label('complainant', '投诉人', ['class' => 'control-label col-md-4']) }}
                        {{ Form::text('complainant', $case->complainant, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('complaint_call') ? ' has-error' : '' }}">
                        {{ Form::label('complaint_call', '投诉电话', ['class' => 'control-label col-md-4']) }}
                        {{ Form::text('complaint_call', $case->complaint_call, ['class' => 'form-control col-md-8']) }}
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col-md-4{{ $errors->has('remark') ? ' has-error' : '' }}">
                            {{ Form::label('remark', '备注', ['class' => 'control-label col-md-4']) }}
                            {{ Form::textarea('remark', $case->remark, ['class' => 'form-control col-md-8', 'rows' => 2, 'cols' => 20]) }}
                    </div>
                </div>
                
                <h1></h1>
                
                <!-- 新增编辑按钮-->
                <div class="form-group col-md-offset-3 col-md-8">
                    <button type="submit" class="btn btn-primary">
                        保存
                    </button>
                    <a class="btn btn-default" href="/onlinecases">
                        取消
                    </a>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

@endsection
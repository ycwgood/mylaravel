@extends('layouts.app')

@section('content')

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="/cases">列表</a> &gt; <i class="fa fa-plus"></i> {{ $case->id == 0 ? '添加' : '编辑' }}
        </div>
        <div class="panel-body">
            <!-- 显示验证错误 -->
            @include('common.errors')
            
            <!-- 新建编辑的表单II -->
            {{ Form::open(['url' => '/case', 'class' => 'form-horizontal form-inline', 'name' => 'mainForm']) }}
                {{ Form::hidden('id', $case->id) }}
                
                <div class="row">
                    <div class="form-group col-md-4{{ $errors->has('TD_shop_code') ? ' has-error' : '' }}">
                        {{ Form::label('TD_shop_code', '商户编号', ['class' => 'control-label col-md-4']) }}
                        {{ Form::number('TD_shop_code', $case->TD_shop_code, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('TD_terminal_code') ? ' has-error' : '' }}">
                        {{ Form::label('TD_terminal_code', '终端号', ['class' => 'control-label col-md-4']) }}
                        {{ Form::number('TD_terminal_code', $case->TD_terminal_code, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('TD_business') ? ' has-error' : '' }}">
                        {{ Form::label('TD_business', '业务类型', ['class' => 'control-label col-md-4']) }}
                        {{ Form::select('TD_business', ['' => '无', '传统POS' => '传统POS', '智能POS' => '智能POS', 'MPOS个人' => 'MPOS个人', 'MPOS商户' => 'MPOS商户', '平台扫码' => '平台扫码', 'other' => '其他'], $case->TD_business, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('TD_do') ? ' has-error' : '' }}">
                        {{ Form::label('TD_do', '是否DO', ['class' => 'control-label col-md-4']) }}
                        {{ Form::select('TD_do', ['' => '无', '是' => '是', '否' => '否'], $case->TD_do, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('case_from') ? ' has-error' : '' }}">
                        {{ Form::label('case_from', '案件来源', ['class' => 'control-label col-md-4']) }}
                        {{ Form::select('case_from', ['' => '无', '银行' => '银行', '银联' => '银联', '人行' => '人行', '客服' => '客服', '监控' => '监控', 'other' => '其他'], $case->case_from, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('case_reason') ? ' has-error' : '' }}">
                        {{ Form::label('case_reason', '案件原因', ['class' => 'control-label col-md-4']) }}
                        {{ Form::select('case_reason', ['' => '无', '集资诈骗' => '集资诈骗', '电信诈骗' => '电信诈骗', '普通类诈骗' => '普通类诈骗', '盗刷' => '盗刷', '非法经营' => '非法经营', 'CPP' => 'CPP', '二清' => '二清', '赌博' => '赌博', '疑似伪卡' => '疑似伪卡', '洗钱' => '洗钱', '套现' => '套现', '云闪付盗刷' => '云闪付盗刷', '跨境移机' => '跨境移机', 'other' => '其他'], $case->case_reason, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('case_result') ? ' has-error' : '' }}">
                        {{ Form::label('case_result', '处理结果', ['class' => 'control-label col-md-4']) }}
                        {{ Form::select('case_result', ['' => '无', '冻结账户' => '冻结账户', '加入黑名单' => '加入黑名单', '冻结账户，加入黑名单' => '冻结账户，加入黑名单', 'other' => '其他'], $case->case_result, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('case_date') ? ' has-error' : '' }}">
                        {{ Form::label('case_date', '报案日期', ['class' => 'control-label col-md-4']) }}
                        {{ Form::date('case_date', $case->case_date, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('case_cheat_money') ? ' has-error' : '' }}">
                        {{ Form::label('case_cheat_money', '欺诈金额', ['class' => 'control-label col-md-4']) }}
                        {{ Form::text('case_cheat_money', $case->case_cheat_money, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('case_freeze') ? ' has-error' : '' }}">
                        {{ Form::label('case_freeze', '冻结金额', ['class' => 'control-label col-md-4']) }}
                        {{ Form::text('case_freeze', $case->case_freeze, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="form-group col-md-4{{ $errors->has('case_remark') ? ' has-error' : '' }}">
                            {{ Form::label('case_remark', '案件备注', ['class' => 'control-label col-md-4']) }}
                            {{ Form::textarea('case_remark', $case->case_remark, ['class' => 'form-control col-md-8', 'rows' => 2, 'cols' => 20]) }}
                    </div>
                </div>
                
                <h1></h1>
                
                <div class="row">
                    <div class="form-group col-md-4{{ $errors->has('DD_money') ? ' has-error' : '' }}">
                        {{ Form::label('DD_money', '调单金额', ['class' => 'control-label col-md-4']) }}
                        {{ Form::text('DD_money', $case->DD_money, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('DD_date') ? ' has-error' : '' }}">
                        {{ Form::label('DD_date', '调单日期', ['class' => 'control-label col-md-4']) }}
                        {{ Form::date('DD_date', $case->DD_date, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('DD_reply_date') ? ' has-error' : '' }}">
                        {{ Form::label('DD_reply_date', '回复日期', ['class' => 'control-label col-md-4']) }}
                        {{ Form::date('DD_reply_date', $case->DD_reply_date, ['class' => 'form-control col-md-8']) }}
                    </div>
                </div>
               
                <div class="row">
                    <div class="form-group col-md-4{{ $errors->has('DD_remark') ? ' has-error' : '' }}">
                            {{ Form::label('DD_remark', '调单备注', ['class' => 'control-label col-md-4']) }}
                            {{ Form::textarea('DD_remark', $case->DD_remark, ['class' => 'form-control col-md-8', 'rows' => 2, 'cols' => 20]) }}
                    </div>
                </div>
                
                <h1></h1>
                
                <div class="row">
                    <div class="form-group col-md-4{{ $errors->has('case_card') ? ' has-error' : '' }}">
                        {{ Form::label('case_card', '卡号信息', ['class' => 'control-label col-md-4']) }}
                        {{ Form::number('case_card', $case->case_card, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('case_card2') ? ' has-error' : '' }}">
                        {{ Form::label('case_card2', '卡号II信息', ['class' => 'control-label col-md-4']) }}
                        {{ Form::number('case_card2', $case->case_card2, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    
                    <div class="form-group col-md-4{{ $errors->has('TD_date') ? ' has-error' : '' }}">
                        {{ Form::label('TD_date', '退单日期', ['class' => 'control-label col-md-4']) }}
                        {{ Form::date('TD_date', $case->TD_date, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('TD_reply_date') ? ' has-error' : '' }}">
                        {{ Form::label('TD_reply_date', '回复日期', ['class' => 'control-label col-md-4']) }}
                        {{ Form::date('TD_reply_date', $case->TD_reply_date, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('TD_code') ? ' has-error' : '' }}">
                        {{ Form::label('TD_code', '退单代码', ['class' => 'control-label col-md-4']) }}
                        {{ Form::select('TD_code', ['' => '无', '4502' => '4502', '4503' => '4503', '4507' => '4507', '4508' => '4508', '4512' => '4512', '4514' => '4514', '4515' => '4515', '4522' => '4522', '4526' => '4526', '4527' => '4527', '4532' => '4532', '4536' => '4536', '4544' => '4544', '4558' => '4558', '4559' => '4559', '4562' => '4562', '4752' => '4752', '4806' => '4806', '4802' => '4802', '4803' => '4803', ], $case->TD_code, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('TD_money') ? ' has-error' : '' }}">
                        {{ Form::label('TD_money', '退单金额', ['class' => 'control-label col-md-4']) }}
                        {{ Form::text('TD_money', $case->TD_money, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('TD_post_freeze') ? ' has-error' : '' }}">
                        {{ Form::label('TD_post_freeze', '事后冻结', ['class' => 'control-label col-md-4']) }}
                        {{ Form::text('TD_post_freeze', $case->TD_post_freeze, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('TD_pre_freeze') ? ' has-error' : '' }}">
                        {{ Form::label('TD_pre_freeze', '监控冻结', ['class' => 'control-label col-md-4']) }}
                        {{ Form::text('TD_pre_freeze', $case->TD_pre_freeze, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('TD_request_funds') ? ' has-error' : '' }}">
                        {{ Form::label('TD_request_funds', '再请款', ['class' => 'control-label col-md-4']) }}
                        {{ Form::text('TD_request_funds', $case->TD_request_funds, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    
                </div>
                
                <div class="row">
                    <div class="form-group col-md-4{{ $errors->has('TD_remark') ? ' has-error' : '' }}">
                            {{ Form::label('TD_remark', '退单备注', ['class' => 'control-label col-md-4']) }}
                            {{ Form::textarea('TD_remark', $case->TD_remark, ['class' => 'form-control col-md-8', 'rows' => 2, 'cols' => 20]) }}
                    </div>
                </div>
                
                
                <h1></h1>
                
                <div class="row">
                    <div class="form-group col-md-4{{ $errors->has('case_police_contact') ? ' has-error' : '' }}">
                        {{ Form::label('case_police_contact', '警方联系人', ['class' => 'control-label col-md-4']) }}
                        {{ Form::text('case_police_contact', $case->case_police_contact, ['class' => 'form-control col-md-8']) }}
                    </div>
                    
                    <div class="form-group col-md-4{{ $errors->has('case_police_office') ? ' has-error' : '' }}">
                        {{ Form::label('case_police_office', '警方公安局', ['class' => 'control-label col-md-4']) }}
                        {{ Form::text('case_police_office', $case->case_police_office, ['class' => 'form-control col-md-8']) }}
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col-md-4{{ $errors->has('case_police_remark') ? ' has-error' : '' }}">
                            {{ Form::label('case_police_remark', '警方协查备注', ['class' => 'control-label col-md-4']) }}
                            {{ Form::textarea('case_police_remark', $case->case_police_remark, ['class' => 'form-control col-md-8', 'rows' => 2, 'cols' => 20]) }}
                    </div>
                </div>
                
                <h1></h1>
                
                <!-- 新增编辑按钮-->
                <div class="form-group col-md-offset-3 col-md-8">
                    <button type="submit" class="btn btn-primary">
                        保存
                    </button>
                    <a class="btn btn-default" href="/cases">
                        取消
                    </a>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

@endsection
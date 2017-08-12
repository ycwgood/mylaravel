<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->increments('id');
            
            $table->date('TD_date')->nullable()->comment('退单日期');
            $table->date('TD_reply_date')->nullable()->comment('退单回复日期');
            $table->string('TD_code')->nullable()->comment('退单代码');
            $table->float('TD_money')->nullable()->comment('退单金额');
            $table->float('TD_post_freeze')->nullable()->comment('事后冻结');
            $table->float('TD_pre_freeze')->nullable()->comment('监控冻结');
            $table->string('TD_shop_code')->nullable()->comment('商户编号');
            $table->string('TD_terminal_code')->unique()->comment('终端号');   // unique
            $table->string('TD_request_funds')->nullable()->comment('是否再请款');
            $table->text('TD_remark')->nullable()->comment('退单备注');
            
            $table->float('DD_money')->nullable()->comment('调单金额');
            $table->date('DD_date')->nullable()->comment('调单日期');
            $table->date('DD_reply_date')->nullable()->comment('调单回复日期');
            $table->text('DD_remark')->nullable()->comment('调单备注');
            
            $table->string('case_card')->nullable()->comment('卡号信息');
            $table->string('case_from')->nullable()->comment('案件来源');
            $table->string('case_reason')->nullable()->comment('案件原因');
            $table->string('case_result')->nullable()->comment('处理结果');
            $table->date('case_date')->nullable()->comment('报案日期');
            $table->float('case_cheat_money')->nullable()->comment('涉案欺诈金额');
            $table->float('case_freeze')->nullable()->comment('拦截/冻结金额');
            $table->text('case_remark')->nullable()->comment('案件备注');
            $table->string('case_police_contact')->nullable()->comment('警方协查联系人');
            $table->string('case_police_office')->nullable()->comment('警方公安局');
            $table->string('case_police_remark')->nullable()->comment('警方协查备注');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cases');
    }
}

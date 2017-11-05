<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlinecasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onlinecases', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('shop_code')->nullable()->comment('商户号');
            $table->string('shop_name')->nullable()->comment('商户名');
            $table->string('terminal_code')->unique()->comment('终端号');   // unique
            $table->string('institute_category')->nullable()->comment('机构小类');
            $table->string('profit_institute')->nullable()->comment('分润机构');
            $table->string('do')->nullable()->comment('是否DO');
            $table->date('case_date')->nullable()->comment('报案日期');
            $table->date('transaction_date')->nullable()->comment('交易日期');
            $table->float('cheat_money')->nullable()->comment('投诉金额');
            $table->float('freeze_money')->nullable()->comment('冻结金额');
            $table->string('case_from')->nullable()->comment('案件来源');
            $table->string('scan_category')->nullable()->comment('扫码类别');
            $table->string('trigger_rule')->nullable()->comment('是否触发规则');
            $table->string('close')->nullable()->comment('是否关闭');
            $table->text('remark')->nullable()->comment('备注');
            
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
        Schema::dropIfExists('onlinecases');
    }
}

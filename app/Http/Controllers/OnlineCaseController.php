<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OnlineCase;

class OnlineCaseController extends Controller
{
    public function index(Request $request)
    {
        $cases = OnlineCase::where([
                ['shop_code', 'like', "%{$request->shop_code}%"],
                ['terminal_code', 'like', "%{$request->terminal_code}%"],
            ])->orderBy('id', 'desc')->paginate(20);
            
            return view('onlinecase.index', [
                'cases' => $cases,
                'request' => $request,
            ]);
    }
    
    public function get($id)
    {
        $case = OnlineCase::findOrFail($id);
        
        return $case;
    }
    
    public function add()
    {
        $case = new OnlineCase();
        
        return view('onlinecase.entity', [
            'case' => $case
        ]);
    }
    
    public function edit($id)
    {
        $case = OnlineCase::findOrFail($id);
        
        return view('onlinecase.entity', [
            'case' => $case
        ]);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'shop_code' => 'required|integer',
            'terminal_code' => "required|integer|unique:onlinecases,terminal_code,{$request->id}",
            'case_date' => empty($request->case_date) ? '' : 'date',
            'transaction_date' => empty($request->transaction_date) ? '' : 'date',
            'cheat_money' => empty($request->cheat_money) ? '' : 'numeric',
            'freeze_money' => empty($request->freeze_money) ? '' : 'numeric',
            'transfer_money' => empty($request->transfer_money) ? '' : 'numeric',
        ]);
        
        if ($request->id == 0) {
            $case = new OnlineCase();
        }
        else {
            $case = OnlineCase::findOrFail($request->id);
        }
        
        $case->shop_code = $request->shop_code;
        $case->shop_name = $request->shop_name;
        $case->terminal_code = $request->terminal_code;
        $case->institute_category = $request->institute_category;
        $case->profit_institute = $request->profit_institute;
        $case->do = $request->do;
        $case->case_date = $request->case_date;
        $case->transaction_date = $request->transaction_date;
        $case->cheat_money = $request->cheat_money;
        $case->freeze_money = $request->freeze_money;
        $case->transfer_money = $request->transfer_money;
        $case->case_from = $request->case_from;
        $case->scan_category = $request->scan_category;
        $case->trigger_rule = $request->trigger_rule;
        $case->close = $request->close;
        $case->complainant = $request->complainant;
        $case->complaint_call = $request->complaint_call;
        $case->remark = $request->remark;
        
        $case->save();
        
        return redirect('/onlinecases');
    }
    
    public function destroy($id)
    {
        OnlineCase::findOrFail($id)->delete();
        
        return redirect('/onlinecases');
    }
    
    public function export()
    {
        static $fieldList = array(
            'shop_code' => '商户号',
            'shop_name' => '商户名',
            'terminal_code' => '终端号',
            'institute_category' => '机构小类',
            'profit_institute' => '分润机构',
            'do' => '是否DO',
            'case_date' => '报案日期',
            'transaction_date' => '交易日期',
            'cheat_money' => '投诉金额',
            'freeze_money' => '冻结金额',
            'transfer_money' => '划款成功金额',
            'case_from' => '案件来源',
            'scan_category' => '扫码类别',
            'trigger_rule' => '是否触发规则',
            'close' => '是否关闭',
            'complainant' => '投诉人',
            'complaint_call' => '投诉电话',
            'remark' => '备注',
        );
        
        $content = '';
        
        // header
        foreach ($fieldList as $fieldName) {
            $content .= $this->csvItem($fieldName);
        }
        $content .= PHP_EOL;
        
        // body
        $cases = OnlineCase::all();
        
        foreach ($cases as $case) {
            foreach ($fieldList as $field => $fieldName) {
                $content .= $this->csvItem($case->$field);
            }
            $content .= PHP_EOL;
        }
        
        $fileName = rawurlencode('export.csv');
        return response($content)
        ->withHeaders([
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"; filename*=utf-8' . "''" . $fileName,
            'Content-Type' => 'application/octet-stream',
        ]);
    }
    
    protected function csvItem($item)
    {
        $item = str_replace(array('"', "\n"), array('""', ''), $item);
        return '"' . iconv('UTF-8', 'gbk//TRANSLIT', $item) . '",';
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyCase;

class CaseController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $cases = MyCase::where([
            ['TD_shop_code', 'like', "%{$request->TD_shop_code}%"],
            ['TD_terminal_code', 'like', "%{$request->TD_terminal_code}%"],
        ])->orderBy('id', 'desc')->paginate(5);
        
        return view('case.index', [
            'cases' => $cases,
            'request' => $request,
        ]);
    }
    
    public function get($id)
    {
        $case = MyCase::findOrFail($id);
        
        return $case;
    }
    
    public function add()
    {
        $case = new MyCase();
        
        if (old('TD_date') == '') {
            $case->TD_date = $case->TD_reply_date = date('Y-m-d');
        }
        
        return view('case.entity', [
            'case' => $case
        ]);
    }
    
    public function edit($id)
    {
        $case = MyCase::findOrFail($id);
        
        return view('case.entity', [
            'case' => $case
        ]);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'TD_terminal_code' => "required|integer|unique:cases,TD_terminal_code,{$request->id}",
            'TD_request_funds' => empty($request->TD_request_funds) ? '' : 'numeric',
            'TD_date' => empty($request->TD_date) ? '' : 'date',
            'TD_reply_date' => empty($request->TD_reply_date) ? '' : 'date',
            'TD_code' => empty($request->TD_code) ? '' : 'integer',
            'TD_money' => empty($request->TD_money) ? '' : 'numeric',
            'TD_post_freeze' => empty($request->TD_post_freeze) ? '' : 'numeric',
            'TD_pre_freeze' => empty($request->TD_pre_freeze) ? '' : 'numeric',
            'TD_shop_code' => 'required|integer',
            'TD_remark' => '',
            
            'DD_money' => empty($request->DD_money) ? '' : 'numeric',
            'DD_date' => empty($request->DD_date) ? '' : 'date',
            'DD_reply_date' => empty($request->DD_reply_date) ? '' : 'date',
            'DD_remark' => '',
            
            'case_card' => empty($request->case_card) ? '' : 'integer',
            'case_from' => '',
            'case_reason' => '',
            'case_result' => '',
            'case_date' => empty($request->case_date) ? '' : 'date',
            'case_cheat_money' => empty($request->case_cheat_money) ? '' : 'numeric',
            'case_freeze' => empty($request->case_freeze) ? '' : 'numeric',
            'case_remark' => '',
            'case_police_contact' => '',
            'case_police_office' => '',
            'case_police_remark' => '',
        ]);
        
        if ($request->id == 0) {
            $case = new MyCase();
        }
        else {
            $case = MyCase::findOrFail($request->id);
        }
        
        $case->TD_date = $request->TD_date;
        $case->TD_reply_date = $request->TD_reply_date;
        $case->TD_code = $request->TD_code;
        $case->TD_money = $request->TD_money;
        $case->TD_post_freeze = $request->TD_post_freeze;
        $case->TD_pre_freeze = $request->TD_pre_freeze;
        $case->TD_shop_code = $request->TD_shop_code;
        $case->TD_terminal_code = $request->TD_terminal_code;
        $case->TD_request_funds = $request->TD_request_funds;
        $case->TD_remark = $request->TD_remark;
        
        $case->DD_money = $request->DD_money;
        $case->DD_date = $request->DD_date;
        $case->DD_reply_date = $request->DD_reply_date;
        $case->DD_remark = $request->DD_remark;
        
        $case->case_card = $request->case_card;
        $case->case_from = $request->case_from;
        $case->case_reason = $request->case_reason;
        $case->case_result = $request->case_result;
        $case->case_date = $request->case_date;
        $case->case_cheat_money = $request->case_cheat_money;
        $case->case_freeze = $request->case_freeze;
        $case->case_remark = $request->case_remark;
        $case->case_police_contact = $request->case_police_contact;
        $case->case_police_office = $request->case_police_office;
        $case->case_police_remark = $request->case_police_remark;
        
        $case->save();
        
        return redirect('/cases');
    }
    
    public function destroy($id)
    {
        MyCase::findOrFail($id)->delete();
        
        return redirect('/cases');
    }
}

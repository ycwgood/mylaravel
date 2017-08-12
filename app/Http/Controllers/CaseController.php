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
        
        $case->TD_date = $case->TD_reply_date = $case->DD_date = $case->DD_reply_date = $case->case_date = date('Y-m-d');
        
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
            'TD_shop_code' => 'required|max:255',
            'TD_terminal_code' => 'required|max:255',
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

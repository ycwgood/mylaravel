@extends('layouts.app')

@section('content')

<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="/cases" method="GET" class="form-horizontal form-inline">
                <label for=TD_shop_code class="col-md-1 control-label">商户编号</label>
                <input type="text" name="TD_shop_code" class="form-control col-md-3" value="{{ $request->TD_shop_code }}">
                <label for=TD_terminal_code class="col-md-1 control-label">终端号</label>
                <input type="text" name="TD_terminal_code" class="form-control col-md-3" value="{{ $request->TD_terminal_code }}">
                <span class="col-md-1"></span>
                <button class="btn btn-default">搜索</button>
                <a href="/cases" class="btn btn-default">全部</a>
            </form>
        </div>
    </div>
    
    @if (count($cases) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                列表 &gt; <a href="/case" class="btn btn-default">添加</a>
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- 表头 -->
                    <thead>
                        <th>商户编号</th>
                        <th>终端号</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- 表身 -->
                    <tbody>
                        @foreach ($cases as $case)
                            <tr>
                                <!-- 案件 -->
                                <td class="table-text">
                                    <div>{{ $case->TD_shop_code }}</div>
                                </td>
                                
                                <td class="table-text">
                                    <div>{{ $case->TD_terminal_code }}</div>
                                </td>

                                <td>
                                    <form action="/case/{{ $case->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a href="/case/{{ $case->id }}" class="btn btn-default">编辑</a>
                                        <button class="btn btn-default">删除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $cases->links() }}
            </div>
        </div>
    @else
        <div class="panel panel-default">
            <div class="panel-heading">
                无
            </div>
        </div>
    @endif
</div>

@endsection
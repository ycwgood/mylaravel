@extends('layouts.app')

@section('content')

<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="/onlinecases" method="GET" class="form-horizontal form-inline">
                <a href="/cases" class="col-md-1 btn btn-default">收单</a>
                <a href="/onlinecases" class="col-md-1 btn btn-primary">扫码</a>
                <label for=shop_code class="col-md-1 control-label">商户号</label>
                <input type="text" name="shop_code" class="form-control col-md-3" value="{{ $request->shop_code }}">
                <label for=terminal_code class="col-md-1 control-label">终端号</label>
                <input type="text" name="terminal_code" class="form-control col-md-3" value="{{ $request->terminal_code }}">
                <span class="col-md-1">&nbsp;</span>
                <button class="btn btn-default">搜索</button>
                <a href="/onlinecases" class="btn btn-default">全部</a>
                
                <a href="/onlinecase" class="btn btn-primary" style="float:right">+添加</a>
                <a href="/onlinecases/export" class="btn btn-default" style="float:right">导出</a>
            </form>
        </div>
    </div>
    
    @if (count($cases) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                列表
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- 表头 -->
                    <thead>
                        <th>ID</th>
                        <th>商户号</th>
                        <th>终端号</th>
                        <th>创建时间</th>
                        <th>最后修改时间</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- 表身 -->
                    <tbody>
                        @foreach ($cases as $case)
                            <tr>
                                <!-- 案件 -->
                                <td class="table-text">
                                    <div>{{ $case->id }}</div>
                                </td>
                                
                                <td class="table-text">
                                    <div>{{ $case->shop_code }}</div>
                                </td>
                                
                                <td class="table-text">
                                    <div>{{ $case->terminal_code }}</div>
                                </td>
                                
                                <td class="table-text">
                                    <div>{{ $case->created_at }}</div>
                                </td>
                                
                                <td class="table-text">
                                    <div>{{ $case->updated_at }}</div>
                                </td>
                                
                                <td align="right">
                                    <form action="/onlinecase/{{ $case->id }}" method="POST" onsubmit="return confirm('确定要删除？');">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a href="/onlinecase/{{ $case->id }}" class="btn btn-primary">编辑</a>
                                        <input type="submit" class="btn btn-danger" value="删除">
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
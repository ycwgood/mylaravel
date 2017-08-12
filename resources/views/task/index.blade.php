@extends('layouts.app')

@section('content')

    <!-- Bootstrap 模版... -->

    <div class="panel-body">
        <!-- 显示验证错误 -->
        @include('common.errors')
        <!-- 新任务的表单 -->
        <form action="/task" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- 任务名称 -->
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="task" class="col-sm-3 control-label">Task</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control" value="{{ old('name') }}">
                </div>
            </div>

            <!-- 增加任务按钮-->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> 增加任务
                    </button>
                </div>
            </div>
        </form>
        
        <!-- 新任务的表单II -->
        
        <!-- 目前任务 -->
        @if (count($tasks) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    目前任务
                </div>
    
                <div class="panel-body">
                    <table class="table table-striped task-table">
    
                        <!-- 表头 -->
                        <thead>
                            <th>Task</th>
                            <th>&nbsp;</th>
                        </thead>
    
                        <!-- 表身 -->
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <!-- 任务名称 -->
                                    <td class="table-text">
                                        <div><a href="/task/{{ $task->id }}">{{ $task->name }}</a></div>
                                    </td>
    
                                    <td>
                                        <form action="/task/{{ $task->id }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                
                                            <button>删除任务</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $tasks->links() }}
                </div>
            </div>
        @endif
    </div>

    <!-- 代办：目前任务 -->
@endsection
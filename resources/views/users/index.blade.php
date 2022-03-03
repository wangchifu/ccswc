@extends('layouts.master')

@section('title','使用者管理-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>使用者管理</h1>
<a href="{{ route('users.create') }}" class="btn btn-success btn-sm">新增本機使用者</a>
<table class="table table-striped">
    <thead class="table-light">
        <tr>
            <th>
                群組
            </th>
            <th>
                帳號
            </th>
            <th>
                姓名
            </th>
            <th>
                職稱
            </th>
            <th>
                登入
            </th>
            <th>
                動作
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>
                {{ $user->code }}
                @if($user->code == "079999")
                    教育處人員
                @else
                    {{ $communities[$user->code] }}
                @endif
                @if ($user->admin==1)
                    <span class="text-danger">(系統管理者)</span>
                @endif
                @if ($user->school_admin==1)
                <span class="text-danger">(社大管理者)</span>
            @endif

            </td>
            <td>
                @if (empty($user->disable))
                    <i class="fas fa-check-circle text-success"></i>
                @else
                    <i class="fas fa-times-circle text-danger"></i>
                @endif
                {{ $user->username }}
            </td>
            <td>
                {{ $user->name }}
            </td>
            <td>
                {{ $user->title }}
            </td>
            <td>
                {{ $user->login_type }}
            </td>
            <td>
                @if(empty($user->disable))
                    <a href="{{ route('users.edit',$user->id) }}" class="btn btn-primary btn-sm">編輯</a>
                    @if($user->id != auth()->user()->id)
                        <a href="{{ route('users.able',$user->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定停用？')">停用</a>
                    @endif
                    @if($user->login_type=="local")
                        <a href="{{ route('users.back_pwd',$user->id) }}" class="btn btn-dark btn-sm" onclick="return confirm('確定還原密碼為預設 {{ env('DEFAULT_PWD') }}')">還原</a>
                    @endif
                    <a href="{{ route('sims.impersonate',$user->id) }}" class="btn btn-secondary btn-sm">模擬</a>

                @else
                    <a href="{{ route('users.able',$user->id) }}" class="btn btn-info btn-sm" onclick="return confirm('確定啟用？')">啟用</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
<br>
@endsection
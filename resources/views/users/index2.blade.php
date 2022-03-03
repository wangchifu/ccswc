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
<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link" aria-current="page" href="{{ route('users.index') }}">全部使用者</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="{{ route('users.index2') }}">社教科成員({{ $apply_users }})</a>
    </li>
</ul>

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
                狀態
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
                @if($user->social_education===null)
                    未申請
                @endif
                @if($user->social_education===0)
                    申請中
                @endif
                @if($user->social_education===1)
                    科員 可發佈
                @endif
                @if($user->social_education===2)
                    科長 可審核
                @endif
            </td>
            <td>
                <form action="{{ route('users.social_education') }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <select class="form-control" name="social_education">
                                    <option value="">未申請</option>
                                    <option value="0">申請中</option>
                                    <option value="1">科員</option>
                                    <option value="2">科長</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <button class="btn btn-primary btn-sm">更改狀態</button>
                            </div>
                        </div>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
<br>
@endsection
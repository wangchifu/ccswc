@extends('layouts.master')

@section('title','新增本機使用者-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>新增本機使用者</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('users.index') }}">使用者管理</a></li>
      <li class="breadcrumb-item active" aria-current="page">新增本機使用者</li>
    </ol>
  </nav>
  <form action="{{ route('users.store') }}" method="post" id="this_form">
    @csrf
    <div class="mb-3">
        <label for="code" class="form-label"><span class="text-danger">*</span>帳號群組</label>
        <select class="form-select rq" required id="code" name="code" onchange="check_admin()" onclick="change_button2()">
            <option value="" selected>--請選擇--</option>
            <option value="079999">教育處人員</option>
            @foreach($communities as $k=>$v)
                <option value="{{ $k }}">{{ $v }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" name="admin" id="admin" disabled>
        <label class="form-check-label" for="admin">
          <span class="text-danger">系統管理者</span>
        </label>
    </div>
    
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" name="school_admin" id="school_admin" disabled>
        <label class="form-check-label" for="school_admin">
          <span class="text-danger">社大管理審核者</span>
        </label>
    </div>
    <br>
    <div class="mb-3">
        <label for="username" class="form-label"><span class="text-danger">*</span>本機帳號</label>
        <input type="text" class="form-control rq" id="username" name="username" required onclick="change_button2()">
    </div>
    
    <div class="mb-3">
        <label for="name" class="form-label"><span class="text-danger">*</span>姓名</label>
        <input type="text" class="form-control rq" id="name" name="name" required onclick="change_button2()">
    </div>
    
    <div class="mb-3">
        <label for="title" class="form-label">職稱</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="mb-3">
        <button id="submit_button" class="btn btn-primary" onclick="change_button1()">送出</button>
    </div>
    
    @include('layouts.change_button')
    
  </form>

  @include('users.form_script')
<br>
@endsection
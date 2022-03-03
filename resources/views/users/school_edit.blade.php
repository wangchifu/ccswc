@extends('layouts.master')

@section('title','使用者管理-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>{{ $communities[auth()->user()->code] }} 修改本校使用者</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('users.school_index') }}">使用者管理</a></li>
      <li class="breadcrumb-item active" aria-current="page">修改本校使用者</li>
    </ol>
  </nav>
  <form action="{{ route('users.school_update',$user->id) }}" method="post" id="this_form">
    @csrf
    @method('patch')
    
    <div class="form-check">
      @if($user->school_admin)
        <input class="form-check-input" type="checkbox" value="1" name="school_admin" id="school_admin" checked>
      @else
        <input class="form-check-input" type="checkbox" value="1" name="school_admin" id="school_admin">
      @endif
        <label class="form-check-label" for="school_admin">
          <span class="text-danger">社大管理者</span>
        </label>
    </div>
    <br>
    <div class="mb-3">
        <label for="username" class="form-label"><span class="text-danger">*</span>本機帳號</label>
        <input type="text" class="form-control rq" id="username" name="username" readonly onclick="change_button2()" value={{ $user->username }}>
    </div>
    
    <div class="mb-3">
        <label for="name" class="form-label"><span class="text-danger">*</span>姓名</label>
        <input type="text" class="form-control rq" id="name" name="name" readonly onclick="change_button2()" value={{ $user->name }}>
    </div>
    
    <div class="mb-3">
        <label for="title" class="form-label">職稱</label>
        <input type="text" class="form-control" id="title" name="title" value={{ $user->title }}>
    </div>
    <div class="mb-3">
        <button id="submit_button" class="btn btn-primary" onclick="change_button1()">送出</button>
    </div>
    
    @include('layouts.change_button')
    
  </form>

  @include('users.form_script')
<br>
@endsection
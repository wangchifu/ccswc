@extends('layouts.master')

@section('title','使用者管理-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>更改本機使用者密碼</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('users.index') }}">使用者管理</a></li>
      <li class="breadcrumb-item active" aria-current="page">更改本機使用者密碼</li>
    </ol>
  </nav>
  <form action="{{ route('users.update_pwd') }}" method="post">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label for="password" class="form-label"><span class="text-danger">*</span>舊密碼</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    
    <div class="mb-3">
      <label for="password1" class="form-label"><span class="text-danger">*</span>新密碼</label>
      <input type="password" class="form-control" id="password1" name="password1" required>
    </div>

  <div class="mb-3">
    <label for="password2" class="form-label"><span class="text-danger">*</span>重複一次新密碼</label>
    <input type="password" class="form-control" id="password2" name="password2" required>
  </div>
    
  <div class="mb-3">
    <button id="submit_button" class="btn btn-primary">送出</button>
  </div>
  </form>
  @include('layouts.errors')

<br>
@endsection
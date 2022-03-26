@extends('layouts.master')

@section('title','修改教師名冊-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>
    {{ $communities[auth()->user()->code] }} 修改教師名冊
</h1>
<br>
<br>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('teachers.index') }}">教師名冊</a></li>
      <li class="breadcrumb-item active" aria-current="page">修改教師名冊</li>
    </ol>
  </nav>
<form action="{{ route('teachers.update_one',$teacher->id) }}" method="post" id="this_form">
    @csrf
    @method('patch')
    <div class="mb-3 w-25">
        <label for="year" class="form-label"><span class="text-danger">*</span>年度</label>
        <input type="text" class="form-control rq" id="year" name="year" required onclick="change_button2()" value="{{ $teacher->teacher_season->year }}" readonly>
    </div> 

    <?php 
      $checked1 = ($teacher->teacher_season->season==1)?"checked":null;
      $checked2 = ($teacher->teacher_season->season==2)?"checked":null;
    ?>
    <div class="mb-3">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="season" id="season1" value="1" {{ $checked1 }} disabled>
        <label class="form-check-label" for="season1">
          春季班
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="season" id="season2" value="2" {{ $checked2 }} disabled>
        <label class="form-check-label" for="season2">
          <span class="text-danger">秋季班</span>
        </label>
      </div>
    </div>   

    <div class="mb-3 w-50">
      <label for="name" class="form-label"><span class="text-danger">*</span>姓名</label>
      <input type="text" class="form-control rq" id="name" name="name" required onclick="change_button2()" value="{{ $teacher->name }}">
    </div>

    <div class="mb-3 w-25">
      <label for="sex" class="form-label"><span class="text-danger">*</span>性別</label>
      <input type="text" class="form-control rq" id="sex" name="sex" required onclick="change_button2()" value="{{ $teacher->sex }}">
    </div>

    <div class="mb-3">
      <label for="course_name" class="form-label"><span class="text-danger">*</span>授課課程名稱</label>
      <input type="text" class="form-control rq" id="course_name" name="course_name" required onclick="change_button2()" value="{{ $teacher->course_name }}">
    </div>

    <div class="mb-3">
      <label for="ps" class="form-label"><span class="text-danger">*</span>備註</label>
      <input type="text" class="form-control rq" id="ps" name="ps" required onclick="change_button2()" value="{{ $teacher->ps }}">
    </div>

    <div class="mb-3">
        <a href="#" class="btn btn-secondary" onclick="history.back()">返回</a>
        <button id="submit_button" class="btn btn-primary" onclick="change_button1()">送出</button>
    </div>    
    @include('layouts.change_button')
    
  </form>
<br>
@endsection
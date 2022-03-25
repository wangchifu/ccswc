@extends('layouts.master')

@section('title','修改課程表-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>
    {{ $communities[auth()->user()->code] }} 修改課程表
</h1>
<br>
<br>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">課程表</a></li>
      <li class="breadcrumb-item active" aria-current="page">修改課程表</li>
    </ol>
  </nav>
<form action="{{ route('courses.update_one',$course->id) }}" method="post" id="this_form">
    @csrf
    @method('patch')
    <div class="mb-3 w-25">
        <label for="year" class="form-label"><span class="text-danger">*</span>年度</label>
        <input type="text" class="form-control rq" id="year" name="year" required onclick="change_button2()" value="{{ $course->course_season->year }}" readonly>
    </div> 

    <?php 
      $checked1 = ($course->course_season->season==1)?"checked":null;
      $checked2 = ($course->course_season->season==2)?"checked":null;
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

    <div class="mb-3 w-25">
        <label for="start_date" class="form-label"><span class="text-danger">*</span>開學日期</label>
        <input type="date" class="form-control rq" id="start_date" name="start_date" required onclick="change_button2()" value="{{ $course->course_season->start_date }}" readonly>
    </div>    
    
    <div class="mb-3 w-50">
      <label for="type" class="form-label"><span class="text-danger">*</span>課程類型</label>
      <input type="text" class="form-control rq" id="type" name="type" required onclick="change_button2()" value="{{ $course->type }}">
    </div>

    <div class="mb-3 w-50">
      <label for="name" class="form-label"><span class="text-danger">*</span>課程名稱</label>
      <input type="text" class="form-control rq" id="name" name="name" required onclick="change_button2()" value="{{ $course->name }}">
    </div>

    <div class="mb-3 w-25">
      <label for="place" class="form-label"><span class="text-danger">*</span>上課地點</label>
      <input type="text" class="form-control rq" id="place" name="place" required onclick="change_button2()" value="{{ $course->place }}">
    </div>

    <div class="mb-3 w-25">
      <label for="hour" class="form-label"><span class="text-danger">*</span>學分</label>
      <input type="text" class="form-control rq" id="hour" name="hour" required onclick="change_button2()" value="{{ $course->hour }}">
    </div>

    <div class="mb-3 w-25">
      <label for="teacher" class="form-label"><span class="text-danger">*</span>授課教師</label>
      <input type="text" class="form-control rq" id="teacher" name="teacher" required onclick="change_button2()" value="{{ $course->teacher }}">
    </div>

    <div class="mb-3 w-25">
      <label for="time" class="form-label"><span class="text-danger">*</span>上課時間</label>
      <input type="text" class="form-control rq" id="time" name="time" required onclick="change_button2()" value="{{ $course->time }}">
    </div>

    <div class="mb-3 w-25">
      <label for="students" class="form-label">學員總數</label>
      <input type="text" class="form-control" id="students" name="students" onclick="change_button2()" value="{{ $course->students }}">
    </div>
    <?php 
      $select0 = ($course->situation != 1 and $course->situation != 2)?"selected":null;
      $select1 = ($course->situation==1)?"selected":null;
      $select2 = ($course->situation==2)?"selected":null;
    ?>
    <div class="mb-3 w-25">
      <label for="situation" class="form-label">開課狀態</label>
      <select id="situation" name="situadtion" class="form-control">
        <option value="0" {{ $select0 }}>無資料</option>
        <option value="1" {{ $select1 }}>開課成功</option>
        <option value="2" {{ $select2 }}>開課不成功</option>
      </select>      
    </div>

    <div class="mb-3">
        <a href="#" class="btn btn-secondary" onclick="history.back()">返回</a>
        <button id="submit_button" class="btn btn-primary" onclick="change_button1()">送出</button>
    </div>    
    @include('layouts.change_button')
    
  </form>
<br>
@endsection
@extends('layouts.master')

@section('title','新增課程表-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<script src="{{ asset('gijgo/js/gijgo.min.js') }}" type="text/javascript"></script>
<link href="{{ asset('gijgo/css/gijgo.min.css') }}" rel="stylesheet" type="text/css">
<h1>
    {{ $communities[auth()->user()->code] }} 新增課程表
</h1>
<br>
<br>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">課程表</a></li>
      <li class="breadcrumb-item active" aria-current="page">新增課程表</li>
    </ol>
  </nav>
<form action="{{ route('courses.store') }}" method="post" id="this_form" enctype="multipart/form-data">
    @csrf
    <div class="mb-3 w-25">
        <label for="year" class="form-label"><span class="text-danger">*</span>年度</label>
        <input type="text" class="form-control rq" id="year" name="year" required onclick="change_button2()" value="{{ date('Y') }}">
    </div> 

    <div class="mb-3">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="season" id="season1" value="1" checked>
        <label class="form-check-label" for="season1">
          春季班
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="season" id="season2" value="2">
        <label class="form-check-label" for="season2">
          <span class="text-danger">秋季班</span>
        </label>
      </div>
    </div>   

    <div class="mb-3 w-25">
        <label for="start_date" class="form-label"><span class="text-danger">*</span>開學日期</label>
        <input type="text" width="200" id="start_date" name="start_date" class="form-control rq" required onclick="change_button2()" value="{{ date('Y-m-d') }}"><small class="text-secondary">(請依 YYYY-MM-DD 格式)</small>
          <script src="{{ asset('gijgo/js/messages/messages.zh-TW.js') }}"></script>
          <script>
              $('#start_date').datepicker({
                  format: 'yyyy-mm-dd',
                  locale: 'zh-TW',
              });
          </script>
    </div>
    
    <div class="mb-3 w-25">
      <label for="file" class="form-label"><span class="text-danger">*</span>課程檔案表格</label> <a href="{{ asset('excel/course_sample.xlsx') }}" target="_blank"><i class="fas fa-download"></i> 下載範例檔</a>
      <input class="form-control rq" type="file" id="file" name="file" required onclick="change_button2()">
    </div>

    <div class="mb-3">
        <a href="#" class="btn btn-secondary" onclick="history.back()">返回</a>
        <button id="submit_button" class="btn btn-primary" onclick="change_button1()">送出</button>
    </div>    
    @include('layouts.change_button')
    
  </form>
<br>
@endsection
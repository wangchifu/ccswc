@extends('layouts.master')

@section('title','法令規章-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>
    網路資源
</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('resource.view') }}">網路資源</a></li>
      <li class="breadcrumb-item active" aria-current="page">新增網路資源</li>
    </ol>
</nav>
<form action="{{ route('resource.store') }}" method="post" id="this_form" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="content" class="form-label"><span class="text-danger">*</span>標題</label>
        <input type="text" class="form-control rq" id="content" name="content" required onclick="change_button2()">
    </div>

    <div class="mb-3">
        <label for="resource" class="form-label"><span class="text-danger">*</span>網址(請包含 https://)</label>
        <input type="text" class="form-control rq" id="resource" name="resource" required onclick="change_button2()">
    </div>

    <div class="mb-3">
        <a href="{{ route('resource.view') }}" class="btn btn-secondary">返回</a>
        <button id="submit_button" class="btn btn-primary" onclick="change_button1()">送出</button>
    </div>
    
    @include('layouts.change_button')
</form>
<br>
@endsection
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
    法令規章
</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('law.view') }}">法令規章</a></li>
      <li class="breadcrumb-item active" aria-current="page">修改法令規章</li>
    </ol>
</nav>
<form action="{{ route('law.update',$content->id) }}" method="post" id="this_form" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label for="content" class="form-label"><span class="text-danger">*</span>標題</label>
        <input type="text" class="form-control rq" id="content" name="content" required onclick="change_button2()" value="{{ $content->content }}">
    </div>

    <div class="mb-3">
        <label for="file" class="form-label">附加檔案</label>
        <input class="form-control" type="file" id="file" name="file" required>
      </div>

    <div class="mb-3">
        <a href="{{ route('law.view') }}" class="btn btn-secondary">返回</a>
        <button id="submit_button" class="btn btn-primary" onclick="change_button1()">送出</button>
    </div>
    
    @include('layouts.change_button')
</form>
<br>
@endsection
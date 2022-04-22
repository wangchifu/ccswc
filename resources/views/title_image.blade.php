@extends('layouts.master')

@section('title','首頁圖片-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')

<div class="card">
  <div class="card-header">
    <h1>首頁圖片</h1>
  </div>
  <div class="card-body">
    <form action="{{ route('title_image_store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="files" class="form-label">圖片檔案</label>
        <input class="form-control" type="file" id="file" name="file" required>
      </div>
      <button class="btn btn-success">送出</button>
    </form>
    @if(file_exists(storage_path('app/public/title_image/title_image.jpg')))
    <br>
    
    <img src="{{ asset('storage/title_image/title_image.jpg') }}" class="col-3">
    <a href="{{ route('title_image_delete') }}" onclick="return confirm('確定刪除？')"><i class="fas fa-times-circle text-danger"></i></a>
    
    @endif
  </div>
</div>

<br>
@endsection
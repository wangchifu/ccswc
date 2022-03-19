@extends('layouts.master')

@section('title','社區大學沿革-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>
    社區大學沿革
</h1>
<form action="{{ route('history.store') }}" method="post" id="this_form">
    @csrf
    <div class="mb-3">
        <label for="content" class="form-label"><span class="text-danger">*</span>內容</label>
        <textarea class="form-control" id="content" name="content" rows="3" onclick="change_button2()">{{ $content }}</textarea>
    </div>
  
    <script src="{{ asset('tinymce5/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
        tinyMCE.init({
        selector: "textarea",
        plugins: [
        'advlist autolink link image lists charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
        'table emoticons template paste help code codesample'
        ],
        toolbar: 'code undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
        'bullist numlist outdent indent | link | ' +
        'forecolor backcolor emoticons | preview fullscreen',
        menu: {
        favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons'}
        },
        menubar: false,
        language: 'zh_TW',
    });
    </script>
        <div class="mb-3">
            <a href="{{ route('history.view') }}" class="btn btn-secondary">返回</a>
            <button id="submit_button" class="btn btn-primary" onclick="change_button1()">送出</button>
        </div>
        
        @include('layouts.change_button')
</form>
<br>
@endsection
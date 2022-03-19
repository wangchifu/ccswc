@extends('layouts.master')

@section('title','社區大學一覽表-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>
    社區大學一覽表 - {{ $communities[$code] }}
</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('community.view') }}">社區大學一覽表</a></li>
      <li class="breadcrumb-item active" aria-current="page">編輯 二林社大</li>
    </ol>
</nav>
<form action="{{ route('community.store') }}" method="post" id="this_form">
    @csrf
    <div class="mb-3">
        <label for="school_name" class="form-label">學校全名(簡稱)</label>
        <input type="text" class="form-control" id="school_name" name="school_name" onclick="change_button2()" value="{{ $community_array[$code]['school_name'] }}">
    </div>
    <div class="mb-3">
        <label for="principal_name" class="form-label">校長姓名</label>
        <input type="text" class="form-control" id="principal_name" name="principal_name" onclick="change_button2()" value="{{ $community_array[$code]['principal_name'] }}">
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">主要地址</label>
        <input type="text" class="form-control" id="address" name="address" onclick="change_button2()" value="{{ $community_array[$code]['address'] }}">
    </div>
    <div class="mb-3">
        <label for="telephone_number" class="form-label">主要電話</label>
        <input type="text" class="form-control" id="telephone_number" name="telephone_number" onclick="change_button2()" value="{{ $community_array[$code]['telephone_number'] }}">
    </div>
    <div class="mb-3">
        <label for="fax_number" class="form-label">傳真電話</label>
        <input type="text" class="form-control" id="fax_number" name="fax_number" onclick="change_button2()" value="{{ $community_array[$code]['fax_number'] }}">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">電子信箱</label>
        <input type="text" class="form-control" id="email" name="email" onclick="change_button2()" value="{{ $community_array[$code]['email'] }}">
    </div>
    <div class="mb-3">
        <label for="branch" class="form-label">分部資料</label>
        <input type="text" class="form-control" id="branch" name="branch" onclick="change_button2()" value="{{ $community_array[$code]['branch'] }}">
    </div>
    <div class="mb-3">
        <label for="class_location" class="form-label">上課地點</label>
        <textarea class="form-control" id="class_location" name="class_location" rows="3" onclick="change_button2()">{{ $community_array[$code]['class_location'] }}</textarea>
    </div>
    <div class="mb-3">
        <label for="website" class="form-label">學校網站(請含 https://)</label>
        <input type="text" class="form-control" id="website" name="website" onclick="change_button2()" value="{{ $community_array[$code]['website'] }}">
    </div>
    <div class="mb-3">
        <label for="unit" class="form-label">辦理單位</label>
        <input type="text" class="form-control" id="unit" name="unit" onclick="change_button2()" value="{{ $community_array[$code]['unit'] }}">
    </div>
    <div class="mb-3">
        <label for="introduction" class="form-label">學校簡介</label>
        <textarea class="form-control" id="introduction" name="introduction" rows="3" onclick="change_button2()">{{ $community_array[$code]['introduction'] }}</textarea>
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
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    <input type="hidden" name="code" value="{{ $code }}">
        <div class="mb-3">
            <a href="{{ route('community.view') }}" class="btn btn-secondary">返回</a>
            <button id="submit_button" class="btn btn-primary" onclick="change_button1()">送出</button>
        </div>
        
        @include('layouts.change_button')
</form>
<br>
@endsection
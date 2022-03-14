@extends('layouts.master')

@section('title','新增公告-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>新增公告</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">公告系統</a></li>
      <li class="breadcrumb-item active" aria-current="page">新增公告</li>
    </ol>
  </nav>
  <form action="{{ route('posts.store') }}" method="post" id="this_form" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="category_id" class="form-label"><span class="text-danger">*</span>公告類別</label>
      <select class="form-select" id="category_id" name="category_id" onchange="show()">
        <option value="1" selected>一般公告(公開)</option>
        <option value="2">行政公告</option>
      </select>
    </div>

    <div class="mb-3">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="type" id="type1" value="1" checked>
        <label class="form-check-label" for="type1">
          一般件
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="type" id="type2" value="2">
        <label class="form-check-label" for="type2">
          <span class="text-danger">特急件</span>
        </label>
      </div>
    </div>
    
    <div id="schools" class="mb-3" style="display: none;">
      <label for="category_id" class="form-label"><span class="text-danger">*</span>行政公告對象</label>
      <input type="checkbox" id="all" checked> <label for="all">全選/全不選</label>
      @foreach($communities as $k=>$v)
        <div class="form-check">
          <input class="form-check-input ckb" type="checkbox" value="{{ $k }}" id="id{{ $k }}" name="schools[{{ $k }}]" checked>
          <label class="form-check-label" for="id{{ $k }}">
            {{ $v }}
          </label>
        </div>
      @endforeach
    </div>
    <script>
      $(document).ready(function() {
        $('#all').click(function() {
          $('.ckb').each(function() {
            if(this.checked == false){
              this.checked = true;
            }else{
              this.checked = false;
            }
            
          });
        });
      });

      function show(){
        if($('#category_id').val()==1){
            $("#schools").hide();
          }else{
            $("#schools").show();
          };
      }
      
    </script>
    <div class="mb-3">
        <label for="title" class="form-label"><span class="text-danger">*</span>公告主旨</label>
        <input type="text" class="form-control rq" id="title" name="title" required onclick="change_button2()">
    </div>

    <div class="mb-3">
      <label for="content" class="form-label"><span class="text-danger">*</span>公告內容</label>
      <textarea class="form-control" id="content" name="content" rows="3" onclick="change_button2()"></textarea>
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
      <label for="files" class="form-label">附加檔案</label>
      <input class="form-control" type="file" id="files" name="files[]" multiple>
    </div>

    <div class="mb-3">
        <a href="#" class="btn btn-secondary" onclick="history.back()">返回</a>
        <button id="submit_button" class="btn btn-primary" onclick="change_button1()">送出</button>
    </div>
    
    @include('layouts.change_button')
    
  </form>

<br>
@endsection
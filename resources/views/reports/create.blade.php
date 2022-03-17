@extends('layouts.master')

@section('title','新增填報-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>新增填報</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('reports.index') }}">填報系統</a></li>
      <li class="breadcrumb-item active" aria-current="page">新增填報</li>
    </ol>
</nav>
  <form action="{{ route('reports.store') }}" method="post" id="this_form" enctype="multipart/form-data">
    @csrf
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
    
    <div id="schools" class="mb-3">
      <label for="category_id" class="form-label"><span class="text-danger">*</span>填報對象</label>
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
    </script>
    <div class="mb-3">
        <label for="title" class="form-label"><span class="text-danger">*</span>填報主旨</label>
        <input type="text" class="form-control rq" id="title" name="title" required onclick="change_button2()">
    </div>

    <div class="mb-3">
      <label for="die_date" class="form-label"><span class="text-danger">*</span>截止日期</label>
      <input type="date" class="form-control rq" id="die_date" name="die_date" required onclick="change_button2()">
  </div>

    <div class="mb-3">
      <label for="content" class="form-label"><span class="text-danger">*</span>填報說明</label>
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
    
    <div id="show_question">
      <div class="mb-3" style="border-style:dashed;padding: 10px;margin: 15px;">
        <label for="title1"><strong>題目1*</strong></label>
        <input type="text" class="form-control rq" id="title1" name="question_title[1]" required onclick="change_button2()">
      
        <label for="type1"><strong>題目1-題型*</strong></label>
        <select class="form-control rq" id="question_type1" name="question_type[1]" onclick="change_button2()" onchange="show_type(this,1)">
          <option>--請選擇--</option>
          @foreach($question_types as $k=>$v)
            <option value="{{ $k }}">{{ $v }}</option>
          @endforeach
        </select>
        <div class="form-group" id='show_type1' style="display:none">
          <p>
              <label for='var11'>選項*：</label>
              <input type='text' name='option1[]' id='option1'>
          </p>
          <p>
              <label for='var12'>選項*：</label>
              <input type='text' name='option1[]' id='option1'>
              <i class='fas fa-plus-circle text-success' onclick="add_a(1)"></i>
          </p>
        </div>
      </div>
    </div>

    <div class="mb-3">
      <button type="button" class="btn btn-success btn-sm" onclick="add()">+增題</button>
    </div>
    
    <div class="mb-3">
        <a href="#" class="btn btn-secondary" onclick="history.back()">返回</a>
        <button id="submit_button" class="btn btn-primary" onclick="change_button1()">送出</button>
    </div>
    
    @include('layouts.change_button')
    
  </form>
<script>
    var q = 1;
    function add() {
        var content;
        q++;
        content = "<div class='mb-3' style='border-style:dashed;padding: 10px;margin: 15px;'>" +
            "<label for='title"+q+"'><strong>題目"+q+"*</strong></label>" +
            "<input type='text' name='question_title["+q+"]' id='title"+q+"' class='form-control' required> " +
            "<label for='type"+q+"'><strong>題目"+q+"-題型*</strong></label>" +
            "<select class='form-control rq' name='question_type["+q+"]' id='question_type"+q+"' required onchange='show_type(this,"+q+");'>"+
            "<option value=''>選擇題型</option>"+
            "<option value='radio'>1.單選題</option>"+
            "<option value='checkbox'>2.多選題</option>"+
            "<option value='text'>3.文字題</option>"+
            "<option value='num'>4.數字題</option>"+
            "</select>"+
            "<div class='form-group' id='show_type"+q+"' style='display:none'>"+
            "<p>"+
            "<label for='var"+q+"1'>選項*：</label>"+
            "<input type='text' name='option"+q+"[]' id='option"+q+"'>"+
            "</p>"+
            "<p>"+
            "<label for='var"+q+"2'>選項*：</label>"+
            "<input type='text' name='option"+q+"[]' id='option"+q+"'>"+
            "<i class='fas fa-plus-circle text-success' onclick='add_a("+q+")'></i>"+
            "</p>"+
            "</div>"+
            "<button type='button' class='btn btn-danger btn-sm' onclick='remove(this)'>-刪題</button>"+
            "</div>";
        $("#show_question").append(content);
    }

    function remove(obj) {
        $(obj).parent().remove();
        q--;
    }

    function show_type(G,this_q) {
        if(G.value == 'radio' || G.value == 'checkbox'){
            $("#show_type"+this_q).show();
            $("[id='option"+this_q+"']").attr("required", true);
        } else {
            $("#show_type"+this_q).hide();
            $("[id='option"+this_q+"']").attr("required", false);
        }
    }

    function add_a(this_q) {
        var content;
        content = "<p>" +
            "<label for='var"+this_q+"'>選項*：</label>" +
            "<input type='text' name='option"+this_q+"[]'> " +
            "<i class='fas fa-trash text-danger' onclick='remove_a(this)'></i>" +
            "</p>";
        $("#show_type"+this_q).append(content);
    }

    function remove_a(obj) {
        $(obj).parent().remove();
    }
</script>
<br>
@endsection
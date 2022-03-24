@extends('layouts.master')

@section('title','課程表-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>
    課程表
</h1>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-3">
            <select class="form-control">
                <option value='all'>--全部顯示--</option>
                @foreach($communities as $k=>$v)
                    <option value="{{ $k }}">{{ $v }}</option>
                @endforeach
            </select>
        </div>
        @auth
            @if(auth()->user()->code <> "079999")
            <div class="col-3">
                <a href="{{ route('courses.create') }}" class="btn btn-success btn-sm">新增</a>
            </div>
            @endif
        @endauth
    </div>
</div>
<table class="table table-striped">
    <thead class="table-light">
    <tr>
        <th nowrap>
            社區大學
        </th>
        <th nowrap>
            課程類型
        </th>
        <th nowrap>
            課程名稱
        </th>
        <th nowrap>
            上課地點
        </th>
        <th nowrap>
            學分
        </th>
        <th nowrap>
            授課教師
        </th>        
        <th nowrap>
            上課時間
        </th>
        <th nowrap>
            學員總數
        </th>
        <th nowrap>
            狀態
        </th>
        @auth
        @if(auth()->user()->social_education > 0)
        <th nowrap>
            動作
        </th>
        @endif
        @endauth
    </tr>
    </thead>
    
</table>
<br>
@endsection
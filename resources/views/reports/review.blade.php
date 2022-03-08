@extends('layouts.master')

@section('title','審核公告-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link" aria-current="page" href="{{ route('posts.index') }}">我的公告 ({{ $unpass_posts }})</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" aria-current="page" href="{{ route('reports.index') }}">我的填報</a>
      </li>
    @if(auth()->user()->social_education=="2")
        <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.review') }}">審核公告 ({{ count($posts) }})</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" href="{{ route('reposts.review') }}">審核填報 ()</a>
        </li>
    @endif
</ul>
<br><br>
<table class="table table-striped">
    <thead class="table-light">
    <tr>
        <th nowrap>
            編號
        </th>
        <th nowrap>
            類別
        </th>
        <th nowrap>
            發佈人
        </th>
        <th nowrap>
            主旨
        </th>
        <th nowrap>
            狀態
        </th>
        <th nowrap>
            創建時間
        </th>
        <th nowrap>
            動作
        </th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<br>
<script>
    function check_pass(){
        if(confirm('您確定要通過嗎?')){
            $('#pass_button').hide();
            return true;
        }else{
            return false;
        }
    }
</script>
@endsection
@extends('layouts.master')

@section('title','審核公告-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<div class="btn-group">
    <a href="#" class="btn btn-secondary active" aria-current="page">公告系統</a>
    <a href="#" class="btn btn-secondary">填報系統</a>
</div>
<hr>
<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link" aria-current="page" href="{{ route('posts.index') }}">我的公告</a>
    </li>
    @if(auth()->user()->social_education=="2")
        <li class="nav-item">
        <a class="nav-link active" href="{{ route('posts.review') }}">審核公告 ({{ count($posts) }})</a>
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
    @foreach($posts as $post)
        <tr>
            <td>
                {{ $post->id }}
            </td>
            <td nowrap>
                @if($post->category_id==2)
                <span class="text-danger">
                @else
                <span class="text-dark">
                @endif
                    {{ $categories[$post->category_id] }}
                </span>
            </td>
            <td nowrap>
                {{ $post->user->name }}
            </td>
            <td>
                <a href="{{ route('posts.show',$post->id) }}" class="venobox" data-vbtype="iframe" style="color:darkblue">
                    @if($post->type==1)
                        <span class="text-primary">
                    @elseif($post->type==2)
                        <span class="text-danger">
                    @endif
                    [{{ $types[$post->type] }}]
                    </span>
                    {{ $post->title }}
                </a>
            </td>
            <td>
                {{ $situations[$post->situation] }}
            </td>
            <td class="small">
                {{ $post->created_at }}
            </td>
            <td nowrap>
                <div class="pass_button">
                    <a href="{{ route('posts.pass',$post->id) }}" onclick="return check_pass();"><i class="fas fa-check-circle text-success"></i></a> --        
                    <a href="{{ route('posts.back',$post->id) }}" onclick="return confirm('確定退回？')"><i class="fas fa-chevron-circle-left text-danger"></i></a>
                </div>
            </td>
        </tr>
    @endforeach
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
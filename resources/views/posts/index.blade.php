@extends('layouts.master')

@section('title','公告系統-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="{{ route('posts.index') }}">我的公告 ({{ $unpass_posts }})</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" aria-current="page" href="{{ route('posts.index') }}">我的填報 ({{ $unpass_posts }})</a>
      </li>
    @if(auth()->user()->social_education=="2")
        <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.review') }}">審核公告 ({{ $unsign_posts }})</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.review') }}">審核填報 ({{ $unsign_posts }})</a>
        </li>
    @endif
</ul>
<a href="{{ route('posts.create') }}" class="btn btn-success btn-sm">新增公告</a>
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
            創建時間<br>
            審核時間
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
                    @if($post->situation===3)
                        <span class="text-danger">[作廢]</span>
                        <span style="text-decoration:line-through;">
                    @endif
                    {{ $post->title }}
                    @if($post->situation===3)
                        </span>
                    @endif
                </a>
            </td>
            <td>
                @if($post->situation===0)
                    <span class="text-danger">
                @elseif($post->situation===2)
                    <span class="text-success">
                @elseif($post->situation===3)
                    <span class="text-warning">
                @else
                    <span class="text-dark">   
                @endif
                    {{ $situations[$post->situation] }}
                    </span>
            </td>
            <td class="small">
                {{ $post->created_at }}
                @if($post->situation === 0 or $post->situation ===2)
                <br>
                {{ $post->passed_at }}
                @endif
            </td>
            <td nowrap>
                @if($post->situation=="0" or $post->situation=="1")
                    <a href="{{ route('posts.edit',$post->id) }}"><i class="fas fa-edit text-primary"></i></a> --
                    <a href="{{ route('posts.delete',$post->id) }}" onclick="return confirm('確定刪除？')"><i class="fas fa-times-circle text-danger"></i></a>
                @endif
                @if($post->situation=="2")
                    <a href="{{ route('posts.trash',$post->id) }}" onclick="return confirm('確定作廢？')"><i class="fas fa-trash text-danger"></i></a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
@endsection
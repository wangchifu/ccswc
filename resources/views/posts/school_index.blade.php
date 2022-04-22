@extends('layouts.master')

@section('title','公告簽收-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="{{ route('posts.school_index') }}">我校公告 ({{ $unsign_posts }})</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" aria-current="page" href="{{ route('reports.school_index') }}">我校調查 ({{ $unsign_reports }})</a>
    </li>
</ul>
<table class="table table-striped">
    <thead class="table-light">
    <tr>
        <th nowrap>
            編號
        </th>
        <th nowrap>
            發佈人
        </th>
        <th nowrap>
            主旨
        </th>
        <th nowrap>
            發佈時間<br>
            簽收時間
        </th>
        <th nowrap>
            動作
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($post_schools as $post_school)
        <tr>
            <td>
                {{ $post_school->post_id }}
            </td>
            <td nowrap>
                {{ $post_school->post->user->name }}
            </td>
            <td>
                @if($post_school->post->type==1)
                    <span class="text-primary">
                @elseif($post_school->post->type==2)
                    <span class="text-danger">
                @endif
                [{{ $types[$post_school->post->type] }}]
                </span>
                <a href="{{ route('posts.school_show',$post_school->post_id) }}" class="venobox" data-vbtype="iframe" style="color:darkblue">                                      
                    @if($post_school->post->situation===3)
                        <span class="text-danger">[作廢]</span>
                        <span style="text-decoration:line-through;">
                    @endif
                    {{ $post_school->post->title }}
                    @if($post_school->post->situation===3)
                        </span>
                    @endif
                </a>
            </td>            
            <td class="small">
                {{ $post_school->created_at }}    
                @if(!empty($post_school->signed_at))
                    <br>
                    {{ $post_school->signed_at }}
                @endif
            </td>
            <td nowrap>
                @if(empty($post_school->signed_at))
                    <a href="{{ route('posts.school_sign',$post_school->id) }}" class="btn btn-success btn-sm" onclick="return confirm('確定簽收？')">簽收</a>                    
                @else
                    {{ $post_school->user->name }}
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
@endsection
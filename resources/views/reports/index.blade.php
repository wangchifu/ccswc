@extends('layouts.master')

@section('title','資料填報-')

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
        <a class="nav-link active" aria-current="page" href="{{ route('reports.index') }}">我的填報 ()</a>
      </li>
    @if(auth()->user()->social_education=="2")
        <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.review') }}">審核公告 ({{ $unreview_posts }})</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ route('reports.review') }}">審核填報 ()</a>
        </li>
    @endif
</ul>
<a href="{{ route('reports.create') }}" class="btn btn-success btn-sm">新增填報</a>
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
    @foreach($reports as $report)
        <tr>
            <td>
                {{ $report->id}}
            </td>
            <td>
                {{ $report->user->name}}
            </td>
            <td>
                {{ $report->title}}
            </td>
            <td>
                @if($report->situation===0)
                    <span class="text-danger">
                @elseif($report->situation===2)
                    <span class="text-success">
                @elseif($report->situation===3)
                    <span class="text-warning">
                @else
                    <span class="text-dark">   
                @endif
                    {{ $situations[$report->situation] }}
                    </span>
            </td>
            <td class="small">
                {{ $report->created_at }}
                @if($report->situation === 0 or $report->situation ===2)
                <br>
                {{ $report->passed_at }}
                @endif
            </td>
            <td nowrap>
                @if($report->situation=="0" or $report->situation=="1")
                    <a href="{{ route('reports.edit',$report->id) }}"><i class="fas fa-edit text-primary"></i></a> --
                    <a href="{{ route('reports.delete',$report->id) }}" onclick="return confirm('確定刪除？')"><i class="fas fa-times-circle text-danger"></i></a>
                @endif
                @if($report->situation=="2")
                    <a href="{{ route('reports.trash',$report->id) }}" onclick="return confirm('確定作廢？')"><i class="fas fa-trash text-danger"></i></a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
@endsection
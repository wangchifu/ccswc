@extends('layouts.master')

@section('title','調查填報-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link" aria-current="page" href="{{ route('posts.school_index') }}">我的公告 ({{ $unsign_posts }})</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ route('reports.school_index') }}">我的調查 ({{ $unsign_reports }})</a>
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
            截止日期
        </th>
        <th nowrap>
            主旨
        </th>
        <th nowrap>
            發佈時間<br>
            填報時間
        </th>
        <th nowrap>
            動作
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($report_schools as $report_school)
        <tr>
            <td>
                {{ $report_school->report_id }}
            </td>
            <td nowrap>
                {{ $report_school->report->user->name }}
            </td>
            <td class="small" nowrap>
                {{ $report_school->report->die_date }}
                @if(str_replace('-','',$report_school->report->die_date) < date('Ymd'))
                    
                    <br><span class="text-danger">(已截止)</span>
                @endif
            </td>
            <td>
                @if($report_school->report->type==1)
                    <span class="text-primary">
                @elseif($report_school->report->type==2)
                    <span class="text-danger">
                @endif
                [{{ $types[$report_school->report->type] }}]
                </span>                
                @if($report_school->report->situation===3)
                    <span class="text-danger">[作廢]</span>
                    <span style="text-decoration:line-through;">
                @endif
                {{ $report_school->report->title }}
                @if($report_school->report->situation===3)
                    </span>
                @endif                
            </td>            
            <td class="small">
                {{ $report_school->created_at }}    
                @if(!empty($report_school->signed_at))
                    <br>
                    {{ $report_school->signed_at }}
                @endif
            </td>
            <td nowrap>
                @if(empty($report_school->signed_at))
                <a href="{{ route('reports.school_show',$report_school->report->id) }}" class="venobox btn btn-success btn-sm" data-vbtype="iframe">填報</a>
                <a href="" class="btn btn-danger btn-sm" onclick="return confirm('確定不填報？')">不填報</a>                    
                @else
                    {{ $report_school->user->name }}
                @endif
                @if($report_school->situation=="1" and auth()->user()->school_admin=="1")
                    <a href="" class="btn btn-primary btn-sm" onclick="return confirm('確定通過審核？')">通過</a>
                    <a href="" class="btn btn-dark btn-sm" onclick="return confirm('確定通過審核？')">退回</a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
@endsection
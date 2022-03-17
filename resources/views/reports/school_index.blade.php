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
                @if($report_school->situation === null)
                    @if(str_replace('-','',$report_school->report->die_date) >= date('Ymd'))
                        <a href="{{ route('reports.school_show',$report_school->report->id) }}" class="venobox btn btn-success btn-sm" data-vbtype="iframe">填報</a>
                    @else
                        <span class="text-danger">未填報</span>
                    @endif
                @else
                    <a href="{{ route('reports.school_view',$report_school->report->id) }}" class="venobox btn btn-outline-success btn-sm" data-vbtype="iframe">檢視</a>                        
                @endif               

                @if(($report_school->situation == 1 or $report_school->situation === 0) and $report_school->signed_user_id==auth()->user()->id)
                    @if(str_replace('-','',$report_school->report->die_date) >= date('Ymd'))
                        <a href="{{ route('reports.school_edit',$report_school->report->id) }}" class="venobox btn btn-primary btn-sm" data-vbtype="iframe">編輯</a>                                    
                    @else
                        <span class="text-danger">未通過而逾期</span>
                    @endif
                @endif
                @if($report_school->situation == 1 or $report_school->situation == 2 or $report_school->situation === 0)
                    {{ $report_school->user->name }}
                @endif
                @if($report_school->situation == 2 or $report_school->situation === 0)                        
                    <hr>
                    審：{{ $report_school->review_user->name}}<br>
                    <small>{{ $report_school->updated_at }}</small>
                @endif
                @if($report_school->situation=="1" and auth()->user()->school_admin=="1")
                    @if(str_replace('-','',$report_school->report->die_date) >= date('Ymd'))
                        <hr>                        
                        <a href="{{ route('reports.school_pass',$report_school->id) }}" class="btn btn-outline-primary btn-sm" onclick="return confirm('確定通過審核？')">通過</a>
                        <a href="{{ route('reports.school_back',$report_school->id) }}" class="btn btn-outline-dark btn-sm" onclick="return confirm('確定退回重寫嗎？')">退回</a>
                    @endif
                @endif               
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
@endsection
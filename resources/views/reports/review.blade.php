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
      <a class="nav-link" aria-current="page" href="{{ route('posts.index') }}">我的公告 <i class="fas fa-cog"></i> ({{ $unpass_posts }})</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" aria-current="page" href="{{ route('reports.index') }}">我的填報 <i class="fas fa-pen"></i> ({{ $unpass_reports }})</a>
      </li>
    @if(auth()->user()->social_education=="2")
        <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.review') }}">審核公告 <i class="fas fa-user-cog"></i> ({{ $unreview_posts }})</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" href="{{ route('reports.review') }}">審核填報 <i class="fas fa-user-edit"></i> ({{ $unreview_reports }})</a>
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
        @foreach($reports as $report)
        <tr>
            <td>
                {{ $report->id }}
            </td>            
            <td nowrap>
                {{ $report->user->name }}
            </td>
            <td>
                <a href="{{ route('reports.show',$report->id) }}" class="venobox" data-vbtype="iframe" style="color:darkblue">
                    @if($report->type==1)
                        <span class="text-primary">
                    @elseif($report->type==2)
                        <span class="text-danger">
                    @endif
                    [{{ $types[$report->type] }}]
                    </span>
                    {{ $report->title }}
                </a>
            </td>
            <td>
                {{ $situations[$report->situation] }}
            </td>
            <td class="small">
                {{ $report->created_at }}
            </td>
            <td nowrap>
                <div class="pass_button">
                    <a href="{{ route('reports.pass',$report->id) }}" onclick="return check_pass();"><i class="fas fa-check-circle text-success"></i></a> --        
                    <a href="{{ route('reports.back',$report->id) }}" onclick="return confirm('確定退回？')"><i class="fas fa-chevron-circle-left text-danger"></i></a>
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
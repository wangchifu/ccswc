@extends('layouts.master')

@section('title','填報統計-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('reports.index') }}">填報系統</a></li>
      <li class="breadcrumb-item active" aria-current="page">填報統計</li>
    </ol>
</nav>
<table class="table table-striped">
    <thead class="table-light">
    <tr>
        <th nowrap>
            學校
        </th>
        <th nowrap>
            填報者
        </th>
        @foreach($report->questions as $question)
        <th>
            {{ $question->title }}
        </th>
        @endforeach        
    </tr>
    </thead>
    <tbody>
        @foreach($communities as $k=>$v)
        <tr>
            <td>
                {{ $v }}
            </td>
            <td>                
                @if(isset($report_signed[$k]))
                    {{ $report_signed[$k]['name'] }}<br>
                    <small>{{ $report_signed[$k]['updated_at'] }}</small>
                @endif
            </td>
            @foreach($report->questions as $question)
                <td>
                    @if(isset($all_answers[$k][$question->id]))
                        @if($question->type=="checkbox")
                            @foreach(unserialize($all_answers[$k][$question->id]) as $k1=>$v1)
                                {{ $k1 }},
                            @endforeach
                        @else
                            {{ $all_answers[$k][$question->id] }}
                        @endif                        
                    @endif
                </td>
        @endforeach
        </tr>
        @endforeach     
    </tbody>
</table>
<br>
@endsection
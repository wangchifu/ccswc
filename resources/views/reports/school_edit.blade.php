@extends('layouts.master_clean')

@section('title','填報-')

@section('content')
<div class="card">
    <div class="card-header">
        <h1>調查填報</h1>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th class="text-center" width="20%">
                        主旨
                    </th>
                    <td style="color: #000000">
                        @if($report->type==1)
                        <span class="text-primary">
                        @elseif($report->type==2)
                            <span class="text-danger">
                        @endif
                        [{{ $types[$report->type] }}]
                        </span>
                        @if($report->situation===3)
                        <span class="text-danger">[作廢]</span>
                        <span style="text-decoration:line-through;">
                        @endif
                        {{ $report->title }}
                        @if($report->situation===3)
                        </span>
                        @endif
                    </td>
                </tr>                              
                <tr>
                    <th class="text-center" width="20%">
                        發佈時間
                    </th>
                    <td style="color: #000000">
                        {{ $report->passed_at }}
                    </td>
                </tr>
                <tr>
                    <th class="text-center" width="20%">
                        發佈人
                    </th>
                    <td style="color: #000000">
                        {{ $report->user->name }}
                    </td>
                </tr>
                <tr>
                    <th class="text-center" width="20%">
                        內容
                    </th>
                    <td style="color: #000000;style="word-break: break-all;"">
                        @if($report->situation===3)                        
                        <span style="text-decoration:line-through;">
                        @endif
                        {!! $report->content !!}
                        @if($report->situation===3)
                        </span>
                        @endif
                    </td>
                </tr>
                @if(file_exists(storage_path('app/public/reports/'.$report->id)))
                    @if(count(get_files(storage_path('app/public/reports/'.$report->id)))>0)
                    <tr>
                        <th class="text-center" width="20%">
                            附檔
                        </th>
                        <td style="color: #000000">
                            @foreach(get_files(storage_path('app/public/reports/'.$report->id)) as $k=>$v)
                                <a href="{{ asset('storage/reports/'.$report->id.'/'.$v) }}" target="_blank">{{ $v }}</a><br>
                            @endforeach
                        </td>
                    </tr>
                    @endif
                @endif
                <tr>
                    <th class="text-center" width="20%">
                        題目
                    </th>
                    <td>
                        <form action="{{ route('reports.school_update',$report_school->id) }}" method="post">
                        @csrf
                        <?php  $i=1; ?>
                        @foreach($report->questions as $question)                        
                        <div class="card" style="margin: 5px;">
                            <div class="card-header">
                                題目{{ $i }}：
                                {{ $question->title }}
                            </div>
                            <div class="card-body">
                                @if($question->type=="radio" or $question->type=="checkbox")
                                    <?php $options = unserialize($question->options); ?>
                                        @if($question->type=="radio")
                                            <strong>單選選項：</strong>
                                        @elseif($question->type=="checkbox")
                                            <strong>多選選項：</strong>
                                        @endif
                                        <br>
                                    @foreach($options as $k=>$v)
                                        <span>
                                            @if($question->type=="radio")
                                                <?php $checked=($v==$answer[$question->id])?"checked":""; ?>
                                                <input type="radio" name="answer[{{ $question->id }}]" id="id{{ $question->id }}{{ $k }}" {{ $checked }} value="{{ $v }}" required>
                                            @elseif($question->type=="checkbox")
                                                <?php $checked=(in_array($v,$answer[$question->id]))?"checked":""; ?>
                                                <input type="checkbox" name="answer_checkbox{{ $question->id }}[]" id="id{{ $question->id }}{{ $k }}" value="{{ $v }}" {{ $checked }}>
                                            @endif
                                            <label for="id{{ $question->id }}{{ $k }}">{{ $v }}</label>
                                        </span><br>
                                    @endforeach
                                @elseif($question->type=="text")
                                    <input type="text" name="answer[{{ $question->id }}]" placeholder="填寫文字" value="{{ $answer[$question->id] }}" required>
                                @elseif($question->type=="num")
                                    <input type="number" name="answer[{{ $question->id }}]" placeholder="填寫數字" value="{{ $answer[$question->id] }}" required>
                                @endif
                            </div>
                        </div>
                        <?php $i++; ?>
                        <input type="hidden" name="type[{{ $question->id }}]" value="{{ $question->type }}">
                        @endforeach
                        <button class="btn btn-primary btn-sm" onclick="return confirm('確定資料正確嗎？')">送出</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<br>
@endsection
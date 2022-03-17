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
                        <?php  $i=1; ?>        
                        @foreach($report->questions as $question)                        
                        <div class="card" style="margin: 5px;">
                            <div class="card-header">
                                題目{{ $i }}：
                                {{ $question->title }}
                            </div>
                            <div class="card-body">
                                答：
                                @if($question->type=="checkbox")     
                                <?php $options = unserialize($question->options); ?>                               
                                    @foreach($options as $k=>$v)                                    
                                        @if(in_array($v,$answer[$question->id]))
                                            {{ $v }},
                                        @endif
                                    @endforeach
                                @else
                                    {{ $answer[$question->id] }}
                                @endif
                            </div>
                        </div>           
                        <?php  $i++; ?>             
                        @endforeach                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<br>
@endsection
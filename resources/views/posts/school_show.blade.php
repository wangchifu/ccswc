@extends('layouts.master_clean')

@section('title','公告-')

@section('content')
<div class="card">
    <div class="card-header">
        <h1>檢視公告</h1>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th class="text-center" width="20%">
                        主旨
                    </th>
                    <td style="color: #000000">
                        @if($post->situation===3)
                        <span class="text-danger">[作廢]</span>
                        <span style="text-decoration:line-through;">
                        @endif
                        {{ $post->title }}
                        @if($post->situation===3)
                        </span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="text-center" width="20%">
                        發佈時間
                    </th>
                    <td style="color: #000000">
                        {{ $post->passed_at }}
                    </td>
                </tr>
                <tr>
                    <th class="text-center" width="20%">
                        發佈人
                    </th>
                    <td style="color: #000000">
                        {{ $post->user->name }}
                    </td>
                </tr>
                <tr>
                    <th class="text-center" width="20%">
                        內容
                    </th>
                    <td style="color: #000000;style="word-break: break-all;"">
                        @if($post->situation===3)                        
                        <span style="text-decoration:line-through;">
                        @endif
                        {!! $post->content !!}
                        @if($post->situation===3)
                        </span>
                        @endif
                    </td>
                </tr>
                @if(file_exists(storage_path('app/public/posts/'.$post->id)))
                    @if(count(get_files(storage_path('app/public/posts/'.$post->id)))>0)
                    <tr>
                        <th class="text-center" width="20%">
                            附檔
                        </th>
                        <td style="color: #000000">
                            @foreach(get_files(storage_path('app/public/posts/'.$post->id)) as $k=>$v)
                                <a href="{{ asset('storage/posts/'.$post->id.'/'.$v) }}" target="_blank">{{ $v }}</a><br>
                            @endforeach
                        </td>
                    </tr>
                    @endif
                @endif
            </tbody>
        </table>
    </div>
</div>

<br>
@endsection
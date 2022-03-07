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
                        {{ $post->title }}
                    </td>
                </tr>
                <tr>
                    <th class="text-center" width="20%">
                        發佈對象
                    </th>
                    <td style="color: #000000">
                        @if($post->category_id==1)
                            {{ $for_schools }}
                        @elseif($post->category_id==2)
                            @foreach($for_schools as $k=>$v)
                                {{ $communities[$k] }} ,
                            @endforeach
                        @endif
                    </td>
                </tr>
                @if($post->category_id==2)
                    <tr>
                        <th class="text-center" style="color:red" width="20%">
                            未簽收者
                        </th>
                        <td style="color: #000000">
                            
                        </td>
                    </tr>
                @endif
                <tr>
                    <th class="text-center" width="20%">
                        創建時間
                    </th>
                    <td style="color: #000000">
                        {{ $post->created_at }}
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
                    <td style="color: #000000">
                        {!! $post->content !!}
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
@extends('layouts.master')

@section('title','法令規章-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>
    法令規章
</h1>
@auth
    @if(auth()->user()->social_education > 0)
        <a href="{{ route('law.create') }}" class="btn btn-success btn-sm">新增</a>
    @endif
@endauth
<table class="table table-striped">
    <thead class="table-light">
    <tr>
        <th nowrap>
            序號
        </th>
        <th nowrap>
            標題
        </th>
        <th nowrap>
            刊登者
        </th>
        <th nowrap>
            刊登日期
        </th>
        @auth
        @if(auth()->user()->social_education > 0)
        <th nowrap>
            動作
        </th>
        @endif
        @endauth
    </tr>
    </thead>
    <tbody>
        <?php $i =1; ?>
        @foreach($laws as $law)
            <tr>
                <td>
                    {{ $i }}
                </td>
                <td>
                    <?php 
                        $file = get_files(storage_path('app/public/contents/'.$law->id));    
                        $download = asset('storage/contents/'.$law->id.'/'.$file[0]);
                    ?>
                    <a href="{{ $download }}" target="_blank">
                    {{ $law->content }}
                    </a>
                </td>
                <td>
                    {{ $law->user->name }}
                </td>
                <td>
                    {{ $law->updated_at }}
                </td>
                @auth
                    @if(auth()->user()->social_education > 0)
                        <td>
                            <a href="{{ route('law.edit',$law->id) }}" class="btn btn-primary btn-sm">編輯</a>
                            <a href="{{ route('law.delete',$law->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')">刪除</a>
                        </td>
                    @endif
                @endauth
            </tr>
            <?php $i++; ?>
        @endforeach
    </tbody>
</table>
{{ $laws->links() }}
<br>
@endsection
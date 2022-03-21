@extends('layouts.master')

@section('title','網路資源-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>
    網路資源
</h1>
@auth
    @if(auth()->user()->social_education > 0)
        <a href="{{ route('resource.create') }}" class="btn btn-success btn-sm">新增</a>
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
        @foreach($resources as $resource)
            <tr>
                <td>
                    {{ $i }}
                </td>
                <td>
                    <a href="{{ $resource->resource }}" target="_blank">
                    {{ $resource->content }}
                    </a>
                </td>
                <td>
                    {{ $resource->user->name }}
                </td>
                <td>
                    {{ $resource->updated_at }}
                </td>
                @auth
                    @if(auth()->user()->social_education > 0)
                        <td>
                            <a href="{{ route('resource.edit',$resource->id) }}" class="btn btn-primary btn-sm">編輯</a>
                            <a href="{{ route('resource.delete',$resource->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')">刪除</a>
                        </td>
                    @endif
                @endauth
            </tr>
            <?php $i++; ?>
        @endforeach
    </tbody>
</table>
{{ $resources->links() }}
<br>
@endsection
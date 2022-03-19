@extends('layouts.master')

@section('title','社區大學一覽表-')

@section('banner')
<br>
<br>
<br>
<br>
@endsection

@section('content')
<h1>
    社區大學一覽表
</h1>
<br>
<br>
<table class="table table-striped">
    <thead class="table-light">
    <tr>
        <th nowrap>
            社大名稱
        </th>
        <th nowrap>
            聯絡電話
        </th>
        <th nowrap>
            辦理單位
        </th>
        <th nowrap>
            網站
        </th>
        <th nowrap>
            動作
        </th>
    </tr>
    </thead>
    <tbody>
        @foreach($communities as $k=>$v)
        <tr>
            <td>
                @if(isset($community_array[$k]['school_name']))
                    {{ $community_array[$k]['school_name'] }}
                @else
                    {{ $v }}
                @endif
            </td>
            <td>
                @if(isset($community_array[$k]['telephone_number']))
                    {{ $community_array[$k]['telephone_number'] }}
                @endif
            </td>
            <td>
                @if(isset($community_array[$k]['unit']))
                    {{ $community_array[$k]['unit'] }}
                @endif
            </td>
            <td>
                @if(isset($community_array[$k]['website']))
                    <a href="{{ $community_array[$k]['website'] }}" target="_blank" class="btn btn-warning btn-sm">前往連結</a>
                @endif
            </td>
            <td>
                <a href="{{ route('community.show',$k) }}" class="btn btn-info btn-sm">詳細資料</a>
                @auth
                    @if(auth()->user()->admin == '1' or (auth()->user()->school_admin == '1' and auth()->user()->code==$k))
                        <a href="{{ route('community.edit',$k) }}" class="btn btn-primary btn-sm">編輯</a>
                    @endif
                @endauth
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
@endsection